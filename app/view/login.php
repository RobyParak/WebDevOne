<?php
?>
<!-- login page -->

<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="en">

  <head>
	  <br>
  <title>Login</title>
        <meta charset="utf-8" />        
		<meta name = "keywords" content="student, library, books, lending, reading" />
		<meta name = "description" content="assignment, travel destinations" />
		<meta name = "author" content="IT2B - Student Number: 677676" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<?php include_once 'css/main.php'; ?>
		
    </head>

	<body class="is-preload">
		<h id="page-wrapper">

			<!-- Header -->
            <header id="header">
                <!-- Logo -->
                <h1><a href="/about" id="logo">The Useless Library</a></h1>

					<!-- Nav -->
						<nav id="nav">
							<ul>
							<li><a href="/about">Home</a></li>
								
							  <li><a href="/catalogue"> View Book Catalogue</a></li>
								<li><a href="/userprofile"> User's Profile</a></li>
								<li class="current"><a href="/login"> Login</a></li>
                                <li><a href="/register"> Register</a></li>
						
							</ul>
						</nav>

            </header>

        
<body>
<div class="login-container" id="centered-form">
<form method="post" action="/login" >

    <h2>Login</h2>
    <label for="username">Email Address:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" value="Submit">
  </form>
</div>
</body>
</html>




