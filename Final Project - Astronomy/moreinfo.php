<html>
    <head>
        <!-- Using stylesheet with CSS-->
        <link href="style.css" rel="stylesheet" type="text/css" />
        <title>More Information</title>
    </head>

    <body>
                <img src="images/astronaut.png" alt="astronaut_image" align="left" width=20% height=20%/>
                <img src="images/ship.png" alt="ship_image" align="right" width=20% height=20%/>
            <?php
                $host = "localhost";
                $username = "astronomy";
                $password = "inf385";
                $database = "astronomy";
                $link = mysqli_connect($host,$username,$password,$database);

                $planet_id = $_GET['planets_id'];
                $stars_id = $_GET['stars_id'];
                $years_id = $_GET['years_id'];

                if(isset($planet_id)) //if planets moreinfo
                {
                        //sanitize
                    $planet_id = preg_replace("/[^0-9]+/","",$planet_id);

                    $nameQuery_planets =
                        "SELECT *
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
                            WHERE p.planets_id LIKE '$planet_id')
                        AS complete_set";

                   //debug echo "<pre>$nameQuery_planets</pre>";

                    $nameQuery_planetsResult = mysqli_query($link,$nameQuery_planets);
                    while($row = mysqli_fetch_array($nameQuery_planetsResult))
                    {
                        $planetName = $row['planet_name'];
                        printf("<h2>More Information on Planet %s</h2><br><br>",$planetName);

                        //saving database fields from results into variables
                        $planetRadius = $row['planet_radius'];
                        $planetMass = $row['planet_mass'];
                        $planetAltname = $row['alt_name'];
                        $starName = $row['star_name'];
                        $starRadius = $row['star_radius'];
                        $starMass = $row['star_mass'];
                        $starBrightness = $row['brightness'];
                        $starTemperature = $row['temperature'];
                        if ($row['binary_flag'] == 1){
                            $starType="Binary";}
                            else{                                                           $starType="Singular";}
                        $orbitSeperation = $row['seperation'];
                        $orbitPeriod = $row['period'];
                        $systemNumberPlanets = $row['planets_in_system'];
                        $systemYear = $row['year_discovered'];
                        $systemRightAscension = $row['right_ascension'];
                        $systemDeclination = $row['declination'];

                        //displaying planet information using the variables
                        printf("<div class='text'>
                        <b>Planet Name : </b>%s <br>
                        <b>Planet Radius : </b>%s <br>
                        <b>Planet Mass : </b>%s <br>
                        <b>Alternative Planet Name : </b>%s <br>
                        <br>
                        <b>Host Star Name : </b>%s <br>
                        <b>Host Star Radius : </b>%s <br>
                        <b>Host Star Mass : </b>%s <br>
                        <b>Host Star Brightness : </b>%s <br>
                        <b>Host Star Temperature : </b>%s <br>
                        <b>Host Star Type : </b>%s <br>
                        <br>
                        <b>Orbit Seperation : </b>%s <br>
                        <b>Orbit Period : </b>%s <br>
                        <br>
                        <b>Number of Planets in System : </b>%s <br>
                        <b>Year of Discovery of System : </b>%s <br>
                        <b>Right Ascension of System Location : </b>%s <br>
                        <b>Declination of System Locaton : </b>%s <br>
                         </div>",
                         $planetName,
                        $planetRadius,
                        $planetMass,
                        $planetAltname,
                        $starName,
                        $starRadius,
                        $starMass,
                        $starBrightness,
                        $starTemperature,
                        $starType,
                        $orbitSeperation,
                        $orbitPeriod,
                        $systemNumberPlanets,
                        $systemYear,
                        $systemRightAscension,
                        $systemDeclination);
                    }
                }
                elseif(isset($stars_id)) //if stars moreinfo
                {
                        //sanitize
                    $stars_id = preg_replace("/[^0-9]+/","",$_GET['stars_id']);

                    $nameQuery_stars =
                        "SELECT planet_name, star_name, planets_id
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
                            WHERE s.stars_id LIKE '$stars_id')
                        AS complete_set ORDER BY planet_name";

                    //debug echo "<pre>$nameQuery_stars</pre>";

                        //perform query
                    $nameQuery_starsResult = mysqli_query($link,$nameQuery_stars);

                        //make sure heading prints only once
                    $doneFlag = 0;

                    while($row = mysqli_fetch_array($nameQuery_starsResult))
                    {
                            //ensure this only prints the heading once
                        if(!$doneFlag) printf("<h2>Planets of Star %s</h2>\n<br>\n<br>",$row['star_name']);
                        $doneFlag = 1;
                            //print links to planets more info page
                        printf("<div class='text'><a href=moreinfo.php?planets_id=");
                        printf("%s>%s</a>\n<br>\n<br>\n\n</div>",$row['planets_id'],$row['planet_name']);
                    }
                }
                elseif(isset($years_id)) //if more info about year discovered
                {
                        //sanitize
                    $years_id = preg_replace("/[^0-9]+/","",$years_id);

                    $Query_years =
                        "SELECT
                        stars_id, star_name, year_discovered, planet_name, planets_id
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
                            WHERE sd.year_discovered LIKE '$years_id')
                        AS complete_set ORDER BY planet_name";

                    //debug echo "<pre>$Query_years</pre>";

                        //perform query
                    $Query_yearsResult = mysqli_query($link,$Query_years);
                    $yearOfDiscovery = $years_id;
                        //print heading
                    printf("<h2>Planets Discovered in  %s</h2>",$yearOfDiscovery);

                    while($row = mysqli_fetch_array($Query_yearsResult))
                    {
                            //print links to planets moreinfo
                        printf("<div class='text'><a href=moreinfo.php?planets_id=");
                        printf("%s>%s</a>\n</div>\n<br>\n\n",$row['planets_id'],$row['planet_name']);
                    }
                }
                    //close link
                mysqli_close($link);
            ?>
            <div class="stars"></div>
            <div class="twinkling"></div>
            <div class="clouds"></div>
    </body>
</html>
