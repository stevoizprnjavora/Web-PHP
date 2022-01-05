<?php 
	print '
	<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="Projekt">
	<meta name="keywords" content="Home, html, News, Gallery">
	<meta name="author" content="Zvonimir Ćosić">
	<meta itemprop="name" content="Hello Example">
	<meta itemprop="description" content="Some description">
	<meta itemprop="image" content="Your URL">
	<meta property="og:title" content="Hello Example">
	<meta property="og:type" content="article">
	<meta property="og:url" content="Your URL">
	<meta property="og:image" content="Your URL">
	<meta property="og:description" content="Some description">
	<meta property="article:tag" content="keyword 1, keyword 2, keyword 3, keyword 4, ...">
	<meta name="twitter:title" content="Hello Example">
	<meta name="twitter:description" content="Some description">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<title>Zvonimir Ćosić</title>
</head>
<body>
        <header>
            <div class="logo">
                <img src="gallery/logo.png">
            </div>
            <nav> ';
                include("menu.php");
            print '
            </nav>
        </header>
        <main>
            <h2>PHOTOGRAPHER BASED IN ZAGREB</h2>
            <h3>Login</h3>
	<div  id="contact">';
	
	
	$action = ( array_key_exists( 'action', $_POST) ? $_POST['action'] : "" );
	if ($action == FALSE) {
		print '
		<form action="http://work2.eburza.hr/pwa/responzive-page/send-contact.php" id="contact_form" name="contact_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
	</div>

			<label for="username">Korisničko ime : * <small></small></label>
			<input type="text" id="username" name="username" pattern=".{5,10}" placeholder="Vaše korisničko ime ..." required>
			<br>
									
			<label for="username">Lozinka : * <small></small></label>
			<input type="text" id="username" name="username" pattern=".{4,100}" placeholder="Vaša lozinka..." required>
			<br>
									
			<br><br><input type="submit" value="Submit">
		</form>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if (password_verify($_POST['password'], $row['password'])) {
			#password_verify https://secure.php.net/manual/en/function.password-verify.php
			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['id'];
			$_SESSION['user']['firstname'] = $row['firstname'];
			$_SESSION['user']['lastname'] = $row['lastname'];
			$_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
			# Redirect to admin website
			header("Location: index.php?menu=7");
		}
		
		# Bad username or password
		else {
			unset($_SESSION['user']);
			$_SESSION['message'] = '<p>You entered wrong email or password!</p>';
			header("Location: index.php?menu=6");
		}
	}
	print '
	<footer>
        <div class="footer">
            <p>Social media:<br>
                <a href="https://www.linkedin.com/company/ifixit" target="_blank"><img src="dr_mreze/linkedin.svg"
                        alt="Linkedin" title="Linkedin" ></a>
                <a href="https://twitter.com/ifixit" target="_blank"><img src="dr_mreze/twitter.svg" alt="Twitter"
                        title="Twitter" ></a>
                <a href="https://plus.google.com/113372414904624897851" target="_blank"><img src="dr_mreze/google.svg"
                        alt="Google+" title="Google+"></a>
            </p> 
            <p>Copyright &copy; 2021. Zvonimir Cosic. <a href="https://google.hr"><svg width="10" height="22"
                        viewBox="0 0 118 36" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false"></svg>
        </div>
    </footer>';
?>