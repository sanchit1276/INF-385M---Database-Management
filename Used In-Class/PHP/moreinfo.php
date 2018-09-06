<html>
<head>
<title>Search Result</title>
</head>
<body>
<h1>Your search result:</h1>
<?php

//defines the 4 variables needed to create a database link
$host = "localhost";
$user = "librarian";
$password = "cardcatalog";
$database = "library";

//creates a link to the MySQL database through the mysqli_connect command
//mysqli_connect command needs the four inputs of the host, username, password, and database name
$link = mysqli_connect($host, $user, $password, $database);

//defines the variable book as the global variable book that is taken from the url
//this variable was passed from the search page as the filled in book_id in the url
$book = $_GET['book'];

//sanitizes the variable book
$book = preg_replace("/[^ 0-9]+/", "", $book);

//MySQL SELECT statement which takes the column title from the table Books
//and takes the columns first_name and last_name from the table Authors and concatinates them together
//separated by a space and renames the variable author which is its callable name
//also creates the relationship between the Books, Book_Authors, and Authors tables by linking id numbers
$searchq = "SELECT title, CONCAT_WS(' ', first_name, last_name)
            AS Author FROM Books, Book_author, Authors
            WHERE Books.book_id = $book
            AND Books.book_id = Book_Author.book_id
            AND Book_Author.author_id = Authors.id";

//creates the query and link relationship that will be passed through
$listresult = mysqli_query($link, $searchq);

//creates the variable row and assigns it to the array formed from the MySQL query
$row = mysqli_fetch_array($listresult);

//prints the title and author associated with the book_id
print "The book you selected, $row[title] ";
print "was written by $row[author].";

//closes the MySQL link
mysqli_close($link);
?>
</body>
</html>
