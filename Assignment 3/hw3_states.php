<html>
    <head>
        <!-- title of page -->
        <title>US States</title>
    </head>
    <body>
        <!-- creating a header for page -->
        <h1>US States and Their Capitals</h1>
        <!-- creating an html form for user to select the state they are interested in -->
        <form name="hw3_states.php" method="GET">
            <select name="select_state">
                <!-- creating a default option in form to always revert back to -->
                <option selected>Select State</option>
                <!-- all of these states will be options the user can choose from -->
                <option>Alabama</option>
                <option>Alaska</option>
                <option>Arizona</option>
                <option>Arkansas</option>
                <option>California</option>
                <option>Colorado</option>
                <option>Connecticut</option>
                <option>Deleware</option>
                <option>Florida</option>
                <option>Georgia</option>
                <option>Hawaii</option>
                <option>Idaho</option>
                <option>Illinois</option>
                <option>Indiana</option>
                <option>Iowa</option>
                <option>Kansas</option>
                <option>Kentucky</option>
                <option>Louisana</option>
                <option>Maine</option>
                <option>Maryland</option>
                <option>Massachusetts</option>
                <option>Michigan</option>
                <option>Minnesota</option>
                <option>Mississippi</option>
                <option>Missouri</option>
                <option>Montana</option>
                <option>Nebraska</option>
                <option>Nevada</option>
                <option>New Hampshire</option>
                <option>New Jersey</option>
                <option>New Mexico</option>
                <option>New York</option>
                <option>North Carolina</option>
                <option>North Dakota</option>
                <option>Ohio</option>
                <option>Oklahoma</option>
                <option>Oregon</option>
                <option>Pennsylvania</option>
                <option>Rhode Island</option>
                <option>South Carolina</option>
                <option>South Dakota</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Utah</option>
                <option>Vermont</option>
                <option>Virginia</option>
                <option>Washington</option>
                <option>West Virginia</option>
                <option>Wisconsin</option>
                <option>Wyoming</option>
            </select>
        <!-- asubmitting the option selected by user -->
        <input type="submit" value="Find Capital">
        </form>
        <?php
        // creating an associative array for states and their capitals in php
            $state_capitals=array
            (
                "Alabama" => "Montgomery",
                "Alaska" => "Juneau",
                "Arizona" => "Phoenix",
                "Arkansas" => "Little Rock",
                "California" => "Sacramento",
                "Colorado" => "Denver",
                "Connecticut" => "Hartford",
                "Delaware" => "Dover",
                "Florida" => "Tallahassee",
                "Georgia" => "Atlanta",
                "Hawaii" => "Honolulu",
                "Idaho" => "Boise",
                "Illinois" => "Springfield",
                "Indiana" => "Indianapolis",
                "Iowa" => "Des Moines",
                "Kansas" => "Topeka",
                "Kentucky" => "Frankfort",
                "Louisiana" => "Baton Rouge",
                "Maine" => "Augusta",
                "Maryland" => "Annapolis",
                "Massachusetts" => "Boston",
                "Michigan" => "Lansing",
                "Minnesota" => "Saint Paul",
                "Missouri" => "Jefferson City",
                "Montana" => "Helena",
                "Mississippi" => "Jackson",
                "Nebraska" => "Lincoln",
                "Nevada" => "Carson City",
                "New Hampshire" => "Concord",
                "New Jersey" => "Trenton",
                "New Mexico" => "Santa Fe",
                "New York" => "Albany",
                "North Carolina" => "Raleigh",
                "North Dakota" => "Bismarck",
                "Ohio" => "Columbus",
                "Oklahoma" => "Oklahoma City",
                "Oregon" => "Salem",
                "Pennsylvania" => "Harrisburg",
                "Rhode Island" => "Providence",
                "South Carolina" => "Columbia",
                "South Dakota" => "Pierre",
                "Tennessee" => "Nashville",
                "Texas" => "Austin",
                "Utah" => "Salt Lake City",
                "Vermont" => "Montpelier",
                "Virginia" => "Richmond",
                "Washington" => "Olympia",
                "West Virginia" => "Charleston",
                "Wisconsin" => "Madison",
                "Wyoming" => "Cheyenne"
            );
        //populating variable for state based on selection from user
        $state=$_GET['select_state'];
        //populating variable for capital from array based on variable for state
        $capital=$state_capitals[$state];
        //only printing capital if user has submited the form and selected a state
        if ($capital != '')
            {
                Print "The Capital of $state is $capital.";
            }
        ?>
    </body>
</html>
