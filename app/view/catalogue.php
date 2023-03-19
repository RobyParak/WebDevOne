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
                                <th scope="col">Genre</th>
                                <th scope="col">Availability</th>


                            </tr>
                            </thead>
                            <tbody class="table-group-divider" id="bookTable">


<script>

    function loadBooks() {
        fetch('http://localhost/api/books')
            .then(result => result.json())
            .then((books)=>{
                books.forEach(book => {
                    appendRestaurant(book);
                })
                console.log(books);
            })
    }


    function appendRestaurant(book)
    {

        const newRow = document.createElement("tr");
        const idCol = document.createElement("th");
        const titleCol = document.createElement("td");
        const authorCol = document.createElement("td");
        const genreCol = document.createElement("td");
        const availabilityCol = document.createElement("td");
        const reserveButton = document.createElement("button");
        const reserveButtonCol = document.createElement("td");
        const idInput = document.createElement("input");

        reserveButton.className = "btn btn-warning";
        reserveButton.type = "submit";
        reserveButton.setAttribute("book-id", book.id);
        idCol.scope = "row";
        idInput.type = "hidden";

        idInput.name = "id";
        idInput.value = book.id;
        idCol.innerHTML = book.id;
        titleCol.innerHTML = book.title;
        authorCol.innerHTML = book.author;
        genreCol.innerHTML = book.genre;
        availabilityCol.innerHTML = book.availability;
        reserveButton.innerHTML = "Reserve";


        reserveButton.addEventListener('click', function ()
        {
            reserveBook(book.id);
            table.removeChild(newRow);
        })
        reserveButtonCol.appendChild(reserveButton);

        newRow.appendChild(idCol);
        newRow.appendChild(titleCol);
        newRow.appendChild(authorCol);
        newRow.appendChild(genreCol);
        newRow.appendChild(availabilityCol);
        newRow.appendChild(reserveButtonCol);


        const table = document.getElementById("bookTable");
        table.appendChild(newRow);
    }
    loadBooks();

  function reserveBook(e) {
    let bookId = e.target.getAttribute("book-id");
    if (!isset($_SESSION['user'])) {
      alert("You must be logged in to reserve a book");
      return;
    }
    // Make a POST request to the server to reserve the book
    fetch("http://localhost/api/books/reserve", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        bookId: bookId,
        user: user
      })
    })
	  .then(response => {
		if(!response.ok) {
		  throw new Error(response.statusText);
		}
		return response.json();
	  })
	  .then(data => {
		alert("Book reserved successfully");
	  })
	  .catch(error => {
		console.log(error);
	  });
	}

    loadBooks();
  </script>

  </body>

			

</html>

<?php

?>