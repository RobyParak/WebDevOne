<?php
// Start or resume the session
session_start();
// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    echo "<script>alert('You were already logged in. Now you have been logged out!');</script>";
    unset($_SESSION['user']);
    session_destroy();
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

    <header id="header">
        <!-- Logo -->
        <h1><a href="/about" id="logo">The Useless Library</a></h1>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a href="/about">Home</a></li>
                <li><a href="/catalogue"> View Book Catalogue</a></li>
                <li><a href="/userprofile"> User's Profile</a></li>
                <li><a href="/login"> Login</a></li>
                <li class="current"><a href="/register"> Register</a></li>
            </ul>
        </nav>
    </header>

    <!-- Registration Form -->
    <div class="login-container" id="centered-form">
        <h2>Register</h2>
        <form action="#" method="post" id="registerForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" oninput="isValidEmail(this)">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="button" id="registerButton" onclick="submitRegistrationForm()">Register</button>
        </form>
    </div>
</div>
</body>

</html>

<script>
    function submitRegistrationForm() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        const formData = {
            name: name,
            email: email,
            password: password
        };

        fetch('http://localhost/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then (() => {
                    alert('Registration successful!\nYou can now log in.');
                    window.location.href = '/login';
            })
            .catch((error) => {
                console.error('Oopsies!', error);
            });
    }

    function isValidEmail(inputElement) {
        const email = inputElement.value;
        const registerButton = document.getElementById('registerButton');
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        registerButton.disabled = !emailRegex.test(email);
    }

</script>
