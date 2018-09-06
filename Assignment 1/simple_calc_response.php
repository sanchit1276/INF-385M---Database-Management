<html>
	<head>
		<!--This is the title of the page -->
		<title>Simple Calculator</title>
	</head>
	<body>
		<h1>Simple Calculator</h1>
		<?php
		//This is where I am getting values from the html form
		//and assigning it to the variables
		$number1 = $_GET['number1'];
		$number2 = $_GET['number2'];
		$operation = $_GET['operation'];
		//calculating answer based on operation
		switch ($operation) {
			case ('Add'):
				$answer = $number1+$number2;
				print $answer;
				break;
			case ('Subtract'):
					$answer = $number1-$number2;
					print $answer;
					break;
			case ('Multiply'):
							$answer = $number1*$number2;
							print $answer;
							break;
			case ('Divide'):
							$answer = $number1/$number2;
							print $answer;
							break;
		}
		?>
	</body>
</html>
