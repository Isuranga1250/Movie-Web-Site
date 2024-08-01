<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Movies</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
	<div class="menu-box">
	<?php
		include('connector.php');
		$sql="SELECT * FROM movie ";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==0){
			echo"<script> alert('Error');window.location='viewmovies.php';</script>";
		}
		else{
			echo "<table border='1' size='200'>
			<tr>
			<th>Movie ID</th>
			<th>Movie Name</th>
			<th>Category</th>
			<th>Runtime</th>
			<th>Description</th>
			</tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>" . $row['MID'] . "</td>";
				echo "<td>" . $row['MName']  . "</td>";
				echo "<td>" . $row['Category'] . "</td>";
				echo "<td>" . $row['Runtime']  . "</td>";
				echo "<td>" . $row['Description'] . "</td>";
			}

			echo "</tr>";
			echo "</table>";
		}
	?>
	</div>
</body>
</html>