<html>

    <head>
        <title>Search Results</title>
    </head>

    <body>

        <?php
                //create link for sql connections
            $host = "localhost";
            $username = "astronomy";
            $password = "inf385";
            $database = "astronomy";
            $link = mysqli_connect($host,$username,$password,$database);

                //ensure search query was provided
            if(!isset($_GET['searchQuery']))
            {
                echo "<h3 align='center'>Please provide a valid search term!</h3>";
            }

            else
            {
                    //get and sanitize search query and search criterion
                $searchQuery_dirty = $_GET['searchQuery'];
                $searchQuery_clean = preg_replace("/[^ 0-9a-zA-Z]+/","",$searchQuery_dirty);
                $searchBy = $_GET['searchBy'];

                    //switch for possible search criteria
                switch($searchBy)
                {
                    case "Planet Name": //search by planet name

                            //use sanitized input to search
                        $planetName = $searchQuery_clean;
                            //sql query
                        $selectQuery = "SELECT planets_id, planet_name, planet_radius, planet_mass, alt_name FROM
                        (SELECT DISTINCT s.stars_id, s.name as star_name, s.mass as star_mass, s.radius as star_radius, s.brightness, s.binary_flag, s.temperature, p.planets_id, p.name as planet_name, p.radius as planet_radius, p.mass as planet_mass, p.alt_name, o.seperation, o.period, sd.planets_in_system, sd.year_discovered, sd.right_ascension, sd.declination
                        FROM Planets AS p
                        INNER JOIN Systems AS sy ON p.planets_id = sy.systems_id
                        INNER JOIN Stars AS s ON s.stars_id = sy.stars_id
                        INNER JOIN Orbits AS o ON o.systems_id = sy.systems_id
                        INNER JOIN SystemDetails AS sd ON sd.systems_id = sy.systems_id
                        WHERE p.name like '%$planetName%') AS complete_set";
                        $queryResult = mysqli_query($link, $selectQuery);

                        if(!mysqli_fetch_array($queryResult))
                        {
                                //in case no planets found by the name
                            printf("Sorry, no planets named \"%s\" were found.",$planetName);
                        }
                                //repeat query because above check removed a result from the list
                        $queryResult = mysqli_query($link, $selectQuery);
                        while($row = mysqli_fetch_array($queryResult))
                        {
                                //print formatted link to more-info page
                           printf("<div align='center'><a href=moreinfo.php?planets_id=");
                           printf("%s>%s</a></div>",$row[0],$row['planet_name']);
                        }
                        break;

                    case "Star Mass":
                        //use sanitized input to search
                        $starMass = $searchQuery_clean;
                        //sql query
                        $selectQuery = "SELECT stars_id, star_name, star_mass, star_radius, brightness, binary_flag, temperature FROM
                        (SELECT DISTINCT s.stars_id, s.name as star_name, s.mass as star_mass, s.radius as star_radius, s.brightness, s.binary_flag, s.temperature, p.planets_id, p.name as planet_name, p.radius as planet_radius, p.mass as planet_mass, p.alt_name, o.seperation, o.period, sd.planets_in_system, sd.year_discovered, sd.right_ascension, sd.declination
                        FROM Planets AS p
                        INNER JOIN Systems AS sy ON p.planets_id = sy.systems_id
                        INNER JOIN Stars AS s ON s.stars_id = sy.stars_id
                        INNER JOIN Orbits AS o ON o.systems_id = sy.systems_id
                        INNER JOIN SystemDetails AS sd ON sd.systems_id = sy.systems_id
                        WHERE s.mass like '$starMass%') AS complete_set";
                    $queryResult = mysqli_query($link, $selectQuery);

                    if(!mysqli_fetch_array($queryResult))
                    {
                            //in case no planets found by the name
                        printf("Sorry, no stars with \"%s\" mass were found.",$starMass);
                    }
                            //repeat query because above check removed a result from the list
                    $queryResult = mysqli_query($link, $selectQuery);
                    while($row = mysqli_fetch_array($queryResult))
                    {
                            //print formatted link to more-info page
                       printf("<div align='center'><a href=moreinfo.php?planets_id=");
                       printf("%s>%s</a></div>",$row[0],$row['name']);
                    }
                    break;

                    case "Year of Discovery":
                        //use sanitized input to search
                        $yearDiscovered = $searchQuery_clean;
                        //sql query
                    $selectQuery = "SELECT year_discovered, planets_in_system, seperation, period, right_ascension, declination FROM
                    (SELECT DISTINCT s.stars_id, s.name as star_name, s.mass as star_mass, s.radius as star_radius, s.brightness, s.binary_flag, s.temperature, p.planets_id, p.name as planet_name, p.radius as planet_radius, p.mass as planet_mass, p.alt_name, o.seperation, o.period, sd.planets_in_system, sd.year_discovered, sd.right_ascension, sd.declination
                    FROM Planets AS p
                    INNER JOIN Systems AS sy ON p.planets_id = sy.systems_id
                    INNER JOIN Stars AS s ON s.stars_id = sy.stars_id
                    INNER JOIN Orbits AS o ON o.systems_id = sy.systems_id
                    INNER JOIN SystemDetails AS sd ON sd.systems_id = sy.systems_id
                    WHERE sd.year_discovered like '$yearDiscovered') AS complete_set";
                    $queryResult = mysqli_query($link, $selectQuery);

                    if(!mysqli_fetch_array($queryResult))
                    {
                            //in case no planets found by the name
                        printf("Sorry, no systems were discovered in \"%s\" ",$yearDiscovered);
                    }
                            //repeat query because above check removed a result from the list
                    $queryResult = mysqli_query($link, $selectQuery);
                    while($row = mysqli_fetch_array($queryResult))
                    {
                            //print formatted link to more-info page
                       printf("<div align='center'><a href=moreinfo.php?planets_id=");
                       printf("%s>%s</a></div>",$row[0],$row['name']);
                    }
                    break;
                }

            } /*
                echo"<form method='GET' action='tables.php'>";
                echo "<select name='table_selected'>";

                $listResult = mysqli_query($link,"SHOW TABLES");

                while($row = mysqli_fetch_array($listResult))
                {
                   echo "<option>$row[0]</option>";
                }

                echo "</select><input type='submit' value='Submit'></form>";
            }
            else
            {
                $table_selected = $_GET['table_selected'];
                $tabSel_result = mysqli_query($link,"SELECT * FROM $table_selected");

                while($row = mysqli_fetch_array($tabSel_result))
                {
                    printf("<pre>%s</pre>",print_r($row, true));
                }
            }
                */
            mysqli_close($link);
        ?>

    </body>
</html>
