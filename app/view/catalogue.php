<?php
require_once '../model/user.php'; // Include the user class definition
session_start();

// Check if the 'user' key is set in the session
if (isset($_SESSION['user'])) {
    // Retrieve the serialized object from the session variable
    $userSerialized = $_SESSION['user'];
    // Deserialize the object
    $user = unserialize($userSerialized);
    // Set the flag to true to enable the reserve button
    $isUserLoggedIn = true;
} else {
    // Set the flag = false to disable the reserve button
    $isUserLoggedIn = false;
    echo '<script>alert("You are currently not logged in. Please log in to reserve a book. \nThe reserve button will be disabled unless logged in.");</script>';
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
  <title>Catalogue</title>
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
						<h1><a href="/about" id="logo">The Useless Library</a></h1>

					<!-- Nav -->
						<nav id="nav">
							<ul>
							<li><a href="/about">Home</a></li>
								
							<li class="current"><a href="/catalogue"> View Book Catalogue</a></li>
								<li><a href="/userprofile"> User's Profile</a></li>
								<li><a href="/login"> Login</a></li>
                                <li><a href="/register"> Register</a></li>
						
							</ul>
						</nav>

                    <h1 class="text-center mb-3">Book catalogue</h1>
                    <br>
                    <div class="table table-responsive">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Reserve</th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider" id="bookTable">


<script>

    function loadBooks() {
        fetch('http://localhost/api/books')
            .then(result => result.json())
            .then((books)=>{
                books.forEach(book => {
                    appendBook(book);
                })
                console.log(books);
            })
    }
    function appendBook(book)
    {

        const newRow = document.createElement("tr");
        const idCol = document.createElement("th");
        const titleCol = document.createElement("td");
        const authorCol = document.createElement("td");
        const availabilityCol = document.createElement("td");
        const reserveButton = document.createElement("button");
        const reserveButtonCol = document.createElement("td");
        const idInput = document.createElement("input");
        const reserveForm = document.createElement("form");

        reserveForm.action = "/reserve";
        reserveForm.method = "post";
        reserveButton.className = "btn btn-warning";
        reserveButton.type = "submit";
        idCol.scope = "row";
        idInput.type = "hidden";

        idInput.name = "id";
        idInput.value = book.id;
        idCol.innerHTML = book.id;
        titleCol.innerHTML = book.title;
        authorCol.innerHTML = book.author;
        if (book.availability) {
            availabilityCol.innerHTML = "Yes";
            if(<?php echo json_encode($isUserLoggedIn); ?>) {
                reserveButton.disabled = false;
            } else {
                reserveButton.disabled = true;
                reserveButton.className = "btn btn-secondary";
            }
        } else {
            availabilityCol.innerHTML = "Unavailable until " + book.returnDate;
            reserveButton.disabled = true;
            reserveButton.className = "btn btn-secondary";
        }
        reserveButton.innerHTML = "Reserve";

        reserveForm.appendChild(idInput);
        reserveButton.appendChild(reserveForm);
        reserveButtonCol.appendChild(reserveButton);

        reserveButton.addEventListener("click", function() {
            if (confirm("Are you sure you want to reserve this book?")) {
                // If the user confirms, submit the form
                reserveForm.submit();
            }
        });

        newRow.appendChild(idCol);
        newRow.appendChild(titleCol);
        newRow.appendChild(authorCol);
        newRow.appendChild(availabilityCol);
        newRow.appendChild(reserveButtonCol);


        const table = document.getElementById("bookTable");
        table.appendChild(newRow);

        reserveForm.style.display = "none";
        document.body.appendChild(reserveForm);

    }
    loadBooks();

  </script>

    </tbody>
  </body>

			

</html>

<?php

?>