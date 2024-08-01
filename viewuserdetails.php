<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View User details</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
	<div class="menu-box">
	<?php
		include('connector.php');
		$sql=	"SELECT * FROM user";
		$result = mysqli_query($conn,$sql);

		echo "<table border='1' size='200'>
		<tr>
		<th>User ID</th>
		<th>User Name</th>
		<th>Password</th>
		</tr>";
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['UserID']  . "</td>";
			echo "<td>" . $row['UserName'] . "</td>";
			echo "<td>" . $row['Password']  . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	 ?>
	</div>
</body>
</html>