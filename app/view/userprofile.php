<?php
require_once '../Model/user.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    // Retrieve the serialized object from the session variable
    $userSerialized = $_SESSION['user'];
    // Deserialize the object
    $user = unserialize($userSerialized);
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
    <meta charset="utf-8"/>
    <meta name="keywords" content="student, library, books, lending, reading"/>
    <meta name="description" content="assignment, travel destinations"/>
    <meta name="author" content="IT2B - Student Number: 677676"/>
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <?php include_once 'css/main.php'; ?>

</head>

<body class="is-preload">
<div id="page-wrapper">

    <!-- Header -->
    <div id="header">

        <!-- Logo -->
        <h1><a href="/index.html" id="logo">The Useless Library</a></h1>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a href="/about">Home</a></li>

                <li><a href="/catalogue"> View Book Catalogue</a></li>
                <li class="current"><a href="/userprofile"> User's Profile</a></li>
                <li><a href="/login"> Login</a></li>
                <li><a href="/register"> Register</a></li>

            </ul>
        </nav>

    </div>


    <label id="welcomeLabel"><?php echo "Log in was successful, welcome " . $user->name; ?></label>

    <div class="profile-container">
        <h2>User Profile</h2>
        <div class="profile-info">
            <p>Name: <span id="name"><?php echo $user->name; ?></span></p>
            <p>Email: <span id="email"><?php echo $user->email; ?></span></p>
            <p>Outstanding Balance: <span id="balance">$<?php echo $user->balance; ?></span></p>
        </div>
        <div class="borrowed-books">
            <h3>Borrowed Books</h3>
            <?php if (!empty($user->borrowed_books)): ?>
                <ul>
                    <?php foreach ($user->borrowed_books as $book): ?>
                        <li>
                            <p>Title: <?php echo $book->title; ?></p>
                            <p>Author: <?php echo $book->author ?></p>
                            <p>Lending Date: <?php echo $book->lendingdate ?></p>
                            <p>Return Date: <?php echo $book->returndate ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form id="delete-user-form" action="/catalogue" method="post">
                <input type="hidden" name="catalogue" value="true">
                <button id="catalogue">Reserve a book now</button>
            </form>

        </div>

    </div>

    <br>

    <button id="delete-user" onclick="confirmDelete()">Delete User</button>

    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete your account?")) {
                deleteUserAPI(<?php echo $user->id; ?>);
            }
        }

        function deleteUserAPI(userId) {
            fetch('http://localhost/api/deleteUser', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ userId: userId })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    window.location.href = "/login";
                })
                .catch(error => {
                    console.error('Oopsies:', error);
                });
        }
    </script>

    <form id="delete-user-form" action="/deleteUser" method="post">
        <input type="hidden" name="deleteUser" value="true">
    </form>

</body>

</html>


