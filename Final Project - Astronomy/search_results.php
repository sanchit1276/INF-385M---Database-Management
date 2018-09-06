<html>

    <head>
        <!-- Using stylesheet with CSS-->
        <link href="style.css" rel="stylesheet" type="text/css" />
        <title>Search Results</title>
    </head>

    <body>
            <img src="images/satellite_1.png" alt="sat1_image" align="left" width=30% height=30%/>
            <img src="images/satellite_2.png" alt="sat2_image" align="right" width=30% height=30%/>
        <?php
                //create link for sql connections
            $host = "localhost";
            $username = "astronomy";
            $password = "inf385";
            $database = "astronomy";
            $link = mysqli_connect($host,$username,$password,$database);

                //ensure search query was provided
            if(($_GET['searchQuery'])=="")
            {
                echo "<div class='search'><br><br>Please provide a valid search term!</div>";
            }

            else
            {
                    //get and sanitize search query and search criterion
                $searchQuery_dirty = $_GET['searchQuery'];
                $searchQuery_clean = preg_replace("/[^ .0-9a-zA-Z]+/","",$searchQuery_dirty);
                $searchBy_dirty = $_GET['searchBy'];
                $searchBy_clean = preg_replace("/[^ a-zA-Z]+/","",$searchBy_dirty);


                    //switch for possible search criteria
                switch($searchBy_clean)
                {
                    case "Planet Name": //search by planet name

                            //use sanitized input to search
                        $planetName = $searchQuery_clean;
                            //sql query: get planet id & name for moreinfo.php url

                        printf("<h2>Planet Names matching \"%s\"</h2><br><br>",$planetName);

                        $selectQuery = "SELECT Planets.planets_id, Planets.name
                                        FROM Planets
                                        WHERE Planets.name like '%$planetName%'
                                        ORDER BY Planets.name";

                        $queryResult = mysqli_query($link, $selectQuery);

                        if(!mysqli_fetch_array($queryResult))
                        {
                                //in case no planets found by the name
                            printf("<div class='text'>No planet names matching \"%s\" were found.</div>",$planetName);
                        }
                                //repeat query because above check removed a result from the list
                        $queryResult = mysqli_query($link, $selectQuery);
                        while($row = mysqli_fetch_array($queryResult))
                        {
                                //print formatted link to more-info page
                           printf("<div class='text'>\n<a href=moreinfo.php?planets_id=");
                           printf("%s>%s</a>\n</div>\n\n",$row[0],$row['name']);
                        }
                        break;

                    case "Star Mass":
                            //accept only numbers
                        $starMass = preg_replace("/[^0-9.]+/","",$searchQuery_clean);
                            //sql query get planet id & name for moreinfo.php url

                        printf("<h2>Stars with mass similar to %s</h2><br><br>",$starMass);

                        $selectQuery_mass =
                        "SELECT stars_id, star_name, star_mass, star_radius, brightness, binary_flag, temperature
                        FROM
                          (SELECT DISTINCT
                            s.stars_id,
                            s.name AS star_name,
                            s.mass AS star_mass,
                            s.radius AS star_radius,
                            s.brightness,
                            s.binary_flag,
                            s.temperature,
                            p.planets_id,
                            p.name AS planet_name,
                            p.radius AS planet_radius,
                            p.mass AS planet_mass,
                            p.alt_name,
                            o.seperation,
                            o.period,
                            sd.planets_in_system,
                            sd.year_discovered,
                            sd.right_ascension,
                            sd.declination
                            FROM Planets AS p
                            INNER JOIN Systems AS sy ON p.planets_id = sy.systems_id
                            INNER JOIN Stars AS s ON s.stars_id = sy.stars_id
                            INNER JOIN Orbits AS o ON o.systems_id = sy.systems_id
                            INNER JOIN SystemDetails AS sd ON sd.systems_id = sy.systems_id
                            WHERE s.mass LIKE '$starMass%')
                        AS complete_set
                        ORDER BY complete_set.star_name";

                        //debug echo "<pre>$starMass</pre>";

                        $queryResult_mass = mysqli_query($link, $selectQuery_mass);
                        if(!$row = mysqli_fetch_array($queryResult_mass))
                        {
                            printf("<div class='text'>There are no stars with mass similar to %s.<br></div>",$starMass);
                        }
                        while($row = mysqli_fetch_array($queryResult_mass))
                        {
                                //print formatted link to more-info page
                           printf("<div class='text'>\n<a href=moreinfo.php?stars_id=");
                           printf("%s>Star: %s<br>Mass: %s(Solar Masses)",
                                   $row['stars_id'],$row['star_name'],$row['star_mass']);
                           printf("</a>\n<br>\n<br>\n</div>\n\n");
                        }
                        break;

                    case "Year of Discovery":


                        $yearDiscovered = $searchQuery_clean;
                            //accept only numbers
                        $yearDiscovered = preg_replace("/[^0-9]+/","",$searchQuery_clean);

                        printf("<h2>Planets discovered in %s</h2><br><br>",$yearDiscovered);

                            //sql query get planet id & name for moreinfo.php url
                        $selectQuery_year =
                        "SELECT stars_id, star_name, planets_id, planet_name, year_discovered
                        FROM
                          (SELECT DISTINCT
                            s.stars_id,
                            s.name AS star_name,
                            s.mass AS star_mass,
                            s.radius AS star_radius,
                            s.brightness,
                            s.binary_flag,
                            s.temperature,
                            p.planets_id,
                            p.name AS planet_name,
                            p.radius AS planet_radius,
                            p.mass AS planet_mass,
                            p.alt_name,
                            o.seperation,
                            o.period,
                            sd.planets_in_system,
                            sd.year_discovered,
                            sd.right_ascension,
                            sd.declination
                            FROM Planets AS p
                            INNER JOIN Systems AS sy ON p.planets_id = sy.systems_id
                            INNER JOIN Stars AS s ON s.stars_id = sy.stars_id
                            INNER JOIN Orbits AS o ON o.systems_id = sy.systems_id
                            INNER JOIN SystemDetails AS sd ON sd.systems_id = sy.systems_id
                            WHERE sd.year_discovered LIKE '$yearDiscovered%')
                        AS complete_set
                        ORDER BY complete_set.planet_name";

                        //debug echo "<pre>$starMass</pre>";

                        $queryResult_year = mysqli_query($link, $selectQuery_year);
                        if(!$row = mysqli_fetch_array($queryResult_year))
                        {
                            printf("<div class='text'>There are no planets discovered in %s.<br></div>",$yearDiscovered);
                        }
                        while($row = mysqli_fetch_array($queryResult_year))
                        {
                                //print formatted link to more-info page
                           printf("<div class='text'>\n<a href=moreinfo.php?planets_id=");
                           printf("%s>Planet: %s<br>Year Discovered: %s",
                                   $row['planets_id'],$row['planet_name'],$row['year_discovered']);
                           printf("</a>\n<br>\n<br>\n</div>\n\n");
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
        <div class="stars"></div>
        <div class="twinkling"></div>
        <div class="clouds"></div>
    </body>
</html>
