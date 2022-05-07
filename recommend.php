<?php 

include 'php/dbhandler.php';

if (isset($_POST['amr_round'])) 
{

	$amr_round	= $_POST['amr_round'];
	
	echo "

	<script>  

		document.getElementById('displayResults'); 
		$('#header_texts').html('Calculated calories needed: ' + $amr_round + ' </br> </br> Below is the recommended diet with almost same calorie amount ' )

	</script>

	";

	// get the calories of the desired

	$select_cal1	= "SELECT * FROM foodproducts WHERE calories > '$amr_round' ORDER BY calories ASC LIMIT 1";

	$select_cal2	= $conn->query($select_cal1);

	$select_cal3	= $select_cal2->num_rows;

	if ($select_cal3 > 0) 
	{

		echo 
		"
		<div>

		";
		
		while ($select_cal = $select_cal2->fetch_assoc()) 
		{

			$image		= $select_cal['product_img'];
			$name		= $select_cal['product_name'];
			$calories		= $select_cal['calories'];
			$id			= $select_cal['id'];
			$calories	= $select_cal['calories'];


			//

			echo 
			"

           		<img src='$image' id='recommend_img'>
            	<p id='recommend_tit'><b> $name <br> Calories: $calories</p><br>
			

           	</div>

			";
		}
	}
	else
	{

		//

		echo "Error processing request try again later";
		
	}
}
else
{

	echo "Error processing request";
}






?>