<html>
    <head>
        <!-- Using stylesheet with CSS-->
        <link href="style.css" rel="stylesheet" type="text/css" />
        <title>Advanced Search</title>
    </head>
    <body>
        <h1>Search the Sky</h1>
        <br>
        <br>
        <img src="images/telescope.png" alt="telescope_image">
        <br>
        <br>
        <div class="text">
            <form method="GET" action="search_results.php">
            <input name="searchQuery"></input>
                <select name="searchBy">
                    <option>Planet Name</option>
                    <option>Year of Discovery</option>
                    <option>Star Mass</option>
                </select>
            <input type='submit' value="Submit">
        </form></div>
        <div class="stars"></div>
        <div class="twinkling"></div>
        <div class="clouds"></div>
    </body>
</html>
