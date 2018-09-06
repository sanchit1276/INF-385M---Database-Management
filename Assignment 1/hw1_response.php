<html>
	<head>
		<!--This is the title of the page -->
		<title>Graduation Certificate</title>
	</head>
	<body>
		<h1>Graduation Certificate</h1>
		<?php
		//This is where I am getting values from the html form
		//and assigning it to the variables
		$name = $_GET['name'];
		$class = $_GET['class'];
		$date = $_GET['date'];
		//finally I am printing the sectance using the variables
		print "This certificate confirms $name completed $class on $date.";
		?>
	</body>
</html>
