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

		border-collapse: collapse;
		padding: 10px;
	}

	.mainTable .mainTable th,
	.mainTable td,
	.mainTable tr {
		border: 1px solid black;
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

				<h3><b>Browse and Checkout Assets for Individual</b></h3>

			<b>	Please fill up particulars as you wish. </b>

				

				<form action="asset-for-individual.php" method="post">

					</p>


					 
					<table>
						<tr>
							<td>Individual Name: </td>
							<td><input type="text" name="text-name" value=""></td>
						</tr>
						<tr>
							<td>Remarks: </td>
							<td><input type="text" name="text-remarks" value=""></td>
						</tr>
					</table>
					</br>

					<input type="submit" name="checkout-individual" id="checkout-individual" value="Checkout selected asset(s) for individual" />

</br>
</br>
					<b> Only asset(s) available for check out is shown below. </b>

					</br>

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

						echo "</br>";



						if (isset($_POST['checkout-individual'])) { //checkout-individual must match with name/ID from button on previous page.

							echo "</br>";
							$checkboxVariable = $_POST['checkbox']; //checkboxVariable variable is a an array 
							//Warning: Array to string conversio will occur is you echo this array variable
							foreach ($checkboxVariable as $hostname) {

								//declaration and assignment needs to put here else hostname and remarks will be blank 
								$Name = $_POST['text-name'];
								$PIC = $_POST['text-pic'];
								$Remarks  = $_POST['text-remarks'];

								$Destination = "Individual";
								$TotalRemarks = "individual name: " . $Name .  ". Remarks: " . $Remarks;

								$Sql = "INSERT INTO MovementLog (Hostname,Destination,Remarks) VALUES ('$hostname','$Destination','$TotalRemarks' )";
								if ($conn->query($Sql) === TRUE) {


									echo '<span style="color:Green;"><b>"A new movement record created successfully"</b></span>';
									echo "</br>";
									echo "</br>";

									$Sql = "UPDATE `details` SET `Status` = 'Checked out for individual' WHERE `details`.`Hostname` = '$hostname'";
									if ($conn->query($Sql) === TRUE) {


										echo '<span style="color:Green;"><b>"Status of an asset updated successfully"</b></span>';
										echo "</br>";
										echo "</br>";
									} else {



										echo "Error: " . $sql . "<br>" . $conn->error;
										echo "</br>";
										echo "</br>";
									}
								} else {



									echo "Error: " . $sql . "<br>" . $conn->error;
									echo "</br>";
									echo "</br>";
								}
							}
						}

						//code to generate and populate table placed at the end so that after clicking on button, table will be refreshed.

						$sql = "SELECT * FROM details WHERE Status = 'Ready for Checkout' ORDER BY Hostname ASC	 ";
						$result = $conn->query($sql);

						echo "<table class='mainTable'>";

						echo "<tr>";
						echo "<td> <b>Checkbox </b> </td>";
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
								echo "<td><input type='checkbox' name='checkbox[]' value='" . $row['Hostname'] . "'></td>";
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



						$conn->close();
					}

					?>



				</form>



				<br />

</body>

</html>