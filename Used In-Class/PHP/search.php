<html>
<head>
<title>A Simple Search Form</title>
</head>
<body>
<h1>Library Search</h1>
<p>Search for a book title:</p>

<!--creates a form where the global variable search will be entered
This is a simple text search and the submit button-->
<form method="GET" action="search.php">
<input type="text" size="40" name="search">
<input type="submit" value="submit">
</form>
<?php

//defines the 4 variables needed to create a database link
$host = "localhost";
$user = "librarian";
$password = "cardcatalog";
$database = "library";

//creates a link to the MySQL database through the mysqli_connect command
//mysqli_connect command needs the four inputs of the host, username, password, and database name
$link = mysqli_connect($host, $user, $password, $database);

//sets an if isset loop to check if there is anything present in the text box of the form
if (isset($_GET['search'])) {

  //assigns the variable $search to the global variable search passed from the text box of the form
   $search = $_GET['search'];

  //sanities the search variable
   $search = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search);

  //MySQL SELECT statement that searches the totle column in the Books table where the search variable appears
  //then sorts the books by title
   $searchq = "SELECT * FROM Books WHERE title LIKE '%$search%' GROUP BY
               title";

  //runs the search query against the database using the mysqli_query command
  //mysqli_query command needs the database link and the query that you are using
   $listresult = mysqli_query($link, $searchq);

  //printing the results
   print "<p>Here are the books that match your search:</p>";

  //sets a while loop that sets the variable row to the array of results from the query that was run
   while ($row = mysqli_fetch_array($listresult)) {

      //prints the results as a hyperlink that will push to the moreinfo.php page and auto fill in the book_id of
      //the book into the url and the title as the display of the hyperlink
      print "<a href='moreinfo.php?book=$row[book_id]'>";
      print "$row[title]</a><br />";
   }

  //closes the MySQL link
   mysqli_close($link);
}
?>
</body>
</html>
