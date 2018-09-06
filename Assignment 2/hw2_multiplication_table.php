<html>
	<head>
		<title>Mutltiplication Tables</title>
	</head>
	<body>
		<h1>Multiplication Tables of 1 through 10</h1>
	<?php
		//Here I am defining the first  multiplier starting from 0 and
		//Initiating the first loop to go till 10
		echo 'table';
		for ($first_mult=0; $first_mult <=10 ; $first_mult++) {
			echo '<tr>';
			//Defing the second multiplier and Initiating second loop
			for ($second_mult=0; $second_mult <=10 ; $second_mult++) {
				//calculate product inside the nested loop
				$product = $first_mult * $second_mult;
				//print answer and breaking to new line for each product
				echo '<td>'$first_mult '</td>''<td>'$second_mult '</td>''<td>'$product'</td>'<br />;
				echo '</tr>';
				}

			//adding a break for each outer loop
			print "<br />";
			echo '</table>';
		}
	?>
	</body>
</html>
