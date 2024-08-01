<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Status</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
	<div class="menu-box">
	<?php
	session_start();
	$UID=$_SESSION['UserID'];
	include('connector.php');
		$sql=	"SELECT * FROM booking WHERE UserID='$UID'";
		$result = mysqli_query($conn,$sql);

		echo "<table border='1' size='200'>
		<tr>
		<th>Booking ID</th>
		<th>User ID</th>
		<th>Movie ID</th>
		<th>Show Time</th>
		<th>Booking Date</th>
		<th>Total Seats</th>
		<th>Total Price</th>
		<th>Parking Need</th>
		<th>Park ID</th>
		<th>Status</th>
		</tr>";
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['BID'] . "</td>";
			echo "<td>" . $row['UserID']  . "</td>";
			echo "<td>" . $row['MID'] . "</td>";
			echo "<td>" . $row['ShowTime']  . "</td>";
			echo "<td>" . $row['BookingDate'] . "</td>";
			echo "<td>" . $row['TotalSeats']  . "</td>";
			echo "<td>" . $row['TotalPrice'] . "</td>";
			echo "<td>" . $row['ParkingNeed'] . "</td>";
			echo "<td>" . $row['ParkID']  . "</td>";
			echo "<td>" . $row['Status']  . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	?>
</body>
</html>