<?php

    print '
    <ul>
        <li><a href="photography.php">PORTRAITS</a></li>
        <li><a href="cars.php">CARS</a></li>
        <li><a href="gear.php">GEAR I USE</a></li>
        <li><a href="partnerships.php">PARTNERSHIPS</a></li>
        <li><a href="aboutme.php">ABOUT ME</a></li>
        <li><a href="https://www.instagram.com/cosic_zvonimir/">INSTAGRAM</a></li>
        <li><a href="contact.php">CONTACT</a></li>
        ';
        if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
            print '
            <li><a href="register.php?menu=6">Registracija</a></li>
            <li><a href="signin.php?menu=7">Prijava</a></li>';
        }
        else if ($_SESSION['user']['valid'] == 'true') {
            print '
            <li><a href="index.php?menu=8">Admin</a></li>
            <li><a href="signout.php">Sign Out</a></li>';
        }
        print '
    </ul>';
?>




