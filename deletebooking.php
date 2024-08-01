<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete bookings</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
<div class="menu-box">
<form id="form1" name="form1" method="post">
  <p>
    <label>Enter Booking ID:</label>
    <input type="text" name="BID">
  </p>
  <p>
    <input class="btn" type="submit" name="search" value="search">
  </p>
</form>
	<?php
		include('connector.php');
		if(isset($_POST['search'])){
			$BID=$_POST['BID'];
			$sql="SELECT * FROM booking WHERE BID='$BID' AND Status IN ('confirmed','declined')";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('Invalid search or pending booking');window.location='deletebooking.php';</script>";
			}
			else{
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
				<th>Action</th>
				</tr>";
				while($row = mysqli_fetch_assoc($result)){
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
					echo "<td>";
					echo "<form method='post'>
						  <input type='hidden' name='BID' value='" . $row['BID'] . "'>
						  <input  class='btndel' type='submit' name='delete' value='delete'>
						  </form>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		}
	?>
	<?php
		if(isset($_POST['delete'])){
			$BID=$_POST['BID'];
			$sqldel="DELETE FROM booking WHERE BID = '$BID'";
			$resultdel=mysqli_query($conn,$sqldel);
			if(!$resultdel){
				echo"<script> alert('Delete failed');window.location='deletebooking.php';</script>";
			}
			else{
				$sqldelseat="DELETE FROM bookedseats WHERE BID = '$BID'";
				$resultdelseat=mysqli_query($conn,$sqldelseat);
				if(!$resultdelseat){
					echo"<script> alert('Delete failed');window.location='deletebooking.php';</script>";
				}else{
					echo"<script> alert('record deleted succesfully');window.location='deletebooking.php';</script>";
				}
			}
		}
	?>
</div>
</body>
</html>