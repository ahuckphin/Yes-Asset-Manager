<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
	body {
		border-spacing: 10px 0;
		background-color: #F1F1F1;
	}

	html,
	body,
	h1,
	h2,
	h3,
	h4,
	h5 {
		font-family: "Raleway", sans-serif
	}

	table,
	th,
	td,
	tr {
		border: 1px solid black;
		border-collapse: collapse;
		padding: 10px;
	}
	input[type='checkbox'] {

width: 100px;
height: 25px;
}
</style>

<body>




	<!-- Blog entries -->
	<div class="w3-col l12 s12">
		<!-- Blog entry -->
		<div class="w3-card-4 w3-margin w3-white">

			</br>
			<div class="w3-container">
				<a href="index.php">return home </a>
				<br />
				<br />

				<h3><b>Browse All Assets</b></h3>
				 
				<form action="checkout-computer.php" method="post">
					 

					<?php

					  

					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "yesassetmanager";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} else {

						 

						$sql = "SELECT * FROM details  ORDER BY Hostname ASC	 ";
						$result = $conn->query($sql);

						echo "<b>Total Number of Comptuers:</b> " . $result->num_rows;
						echo "</br>";
						echo "</br>";

						echo "<table>";

						echo "<tr>";
						 
						echo "<td> <b>Hostname </b> </td>";
						echo "<td> <b>Make and Model</b> </td>";
						echo "<td> <b>Serial Number</b> </td>";
						echo "<td> <b>Windows Key</b></td>";
						echo "<td> <b>Status</b> </td>";
						echo "</tr>";

						if ($result->num_rows > 0) {

							// output data of each row
							while ($row = $result->fetch_assoc()) {

								echo "<tr>";
								 
								echo "<td>" . $row['Hostname'] . "</td>";
								echo "<td>" . $row['MakeAndModel'] . "</td>";
								echo "<td>" .  $row['SerialNumber'] .  "</td>";
								echo "<td>" . $row['WindowsKey'] . "</td>";
								echo "<td>" . $row['Status'] . "</td>";
							}

							echo "</table>";
						} else {
							echo "0 results";
						}
						
						/*if(isset($_POST['checkout-event'])) {
							echo "Test1";
							echo "</br>";
							$checkboxVariable = $_POST['checkbox']; //checkboxVariable variable is a an array 
							//Warning: Array to string conversio will occur is you echo this array variable
							foreach($checkboxVariable as $id) {
								 
								echo $id;
								echo "</br>";
							}
						}
						*/ //left over code from trying to get checkboxes working 

						$conn->close();
					}



					?></p>

				</form>

				 


</body>

</html>