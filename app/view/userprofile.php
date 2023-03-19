<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$user = $_SESSION['user'];
if ($user == null) {
	header("Location: login");
	exit();
}
?>

<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="en">

  <head>
  <title>Profile</title>
        <meta charset="utf-8" />        
		<meta name = "keywords" content="student, library, books, lending, reading" />
		<meta name = "description" content="assignment, travel destinations" />
		<meta name = "author" content="IT2B - Student Number: 677676" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<?php include_once 'css/main.php'; ?>
		
    </head>

	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<h1><a href="index.html" id="logo">The Useless Library</a></h1>

					<!-- Nav -->
						<nav id="nav">
							<ul>
							<li><a href="about">Home</a></li>
								
							  <li><a href="catalogue"> View Book Catalogue</a></li>
								<li class="current"><a href="userprofile"> User's Profile</a></li>
								<li><a href="login"> Login</a></li>
						
							</ul>
						</nav>

				</div>

        
<body>
<div class="profile-container">
  <h2>User Profile</h2>
  <div class="profile-info">
    <p>Name: <span id="name"><?php echo $user->name ; ?></span></p>
    <p>Email: <span id="email"><?php echo $user->email; ?></span></p>
    <p>Outstanding Balance: <span id="balance">$<?php echo $user->outstanding_balance; ?></span></p>
  </div>
  <div class="borrowed-books">
  <h3>Borrowed Books</h3>
  <ul>
    <?php foreach ($user->borrowed_books as $book): ?>
      <li>
        <p>Title: <?php echo $book->title; ?></p>
        <p>Author: <?php echo $book->author; ?></p>
        <p>Lending Date: <?php echo $book->lendingdate; ?></p>
        <p>Return Date: <?php echo $book->returndate; ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

  <button id="delete-user" onclick="confirmDelete()">Delete User</button>

<script>
  function confirmDelete() {
    if (confirm("Are you sure you want to delete your account?")) {
      document.getElementById("delete-user-form").submit();
    }
  }
</script>

<form id="delete-user-form" action="user.php" method="post">
  <input type="hidden" name="delete-user" value="true">
</form>
  <button id="update-user">Update User</button>
</div>
</body>
</html>

<?php

//TODO ask about this, should I move everything to the controller?
if (isset($_POST['delete-user-true'])) {
	$controller->deleteUser($user);
	session_destroy();
	header("Location: login");
}
if (isset($_POST['update-user'])) {
	$user->$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$user->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$controller->updateUser($user);
	header("Location: userprofile");
}

?>

