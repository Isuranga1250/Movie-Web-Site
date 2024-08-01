<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Bookings</title>
<link rel="stylesheet" href="css/tables.css">
</head>
	<?php
		include('connector.php');
	?>
<body>
	<div class="menu-box">
	<?php
		$sql=	"SELECT * FROM booking WHERE Status ='pending'";
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
		<th>Action</th>
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
			echo "<td>";
			echo "<form method='post'>
				  <input type='hidden' name='BID' value='" . $row['BID'] . "'>
				  <input type='hidden' name='UserID' value='" . $row['UserID'] . "'>
				  <input type='hidden' name='MID' value='" . $row['MID'] . "'>
				  <input type='hidden' name='ShowTime' value='" . $row['ShowTime'] . "'>
				  <input type='hidden' name='Date' value='" . $row['BookingDate'] . "'>
				  <input type='hidden' name='NofSeats' value='" . $row['TotalSeats'] . "'>
				  <input type='hidden' name='PNeed' value='" . $row['ParkingNeed'] . "'>
				  <input type='submit' class='btndel' name='confirm' value='confirm'>
				  <input type='submit' class='btndel' name='decline' value='decline'>
			      </form>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	 ?>
	<?php
		if(isset($_POST['confirm'])){
			$BID=$_POST['BID'];
			$MID=$_POST['MID'];
			$nofseats = $_POST['NofSeats'];
			$showtime=$_POST['ShowTime'];
			$date=$_POST['Date'];
			$parkchoice=$_POST['PNeed'];
			$sql = "SELECT s.SeatID
					FROM seat s
					WHERE s.SeatID NOT IN (
						SELECT bs.SeatID
						FROM bookedseats bs
						JOIN booking b ON bs.BID = b.BID
						WHERE b.MID = $MID
						AND b.ShowTime = '$showtime'
						AND b.BookingDate = '$date'
						AND b.Status = 'confirmed'
					)
					LIMIT $nofseats";
			$resultseats=mysqli_query($conn,$sql);
			if(mysqli_num_rows($resultseats)==$nofseats) {
				if($parkchoice =="Yes"){
					$sqlparkcheck = "SELECT p.ParkID 
							FROM parking p 
							WHERE NOT EXISTS (
								SELECT 1 
								FROM booking b 
								WHERE b.ParkID = p.ParkID
								AND b.ShowTime = '$showtime'
								AND b.BookingDate = '$date'
								AND b.Status='confirmed'
							) 
							LIMIT 1";
					$resultpark=mysqli_query($conn,$sqlparkcheck);
					
					if(mysqli_num_rows($resultpark) > 0){
						$rowpark=mysqli_fetch_assoc($resultpark);
						$parkID = $rowpark['ParkID'];
						$sqlupdate  = "UPDATE booking SET Status = 'confirmed', ParkID = '$parkID' WHERE BID = '$BID'";
						$resultupdate = mysqli_query($conn,$sqlupdate);
						if(!$resultupdate){
							die('Error confirming booking!');
						}else{
							while($rowseats= mysqli_fetch_assoc($resultseats)) {
								$seatid = $rowseats['SeatID'];
								$sqlinseretbseat = "INSERT INTO bookedseats (BID,SeatID) VALUES ('$BID','$seatid')";
								$resultinsertbseat=mysqli_query($conn,$sqlinseretbseat);
								if(!$resultinsertbseat){
									die('Could not enter data : '.mysqli_error($conn));
								}
							}
							echo "<script> alert('Booking Confirmed!');window.location='managebookings.php';</script>";
						}
					}else{
						echo "<script> alert('Sorry! No available parking slots');window.location='managebookings.php';</script>";
					}
				}else{
					$sqlupdate  = "UPDATE booking SET Status = 'confirmed' WHERE BID = '$BID'";
					$resultupdate = mysqli_query($conn,$sqlupdate);
					if(!$resultupdate){
						die('Could not enter data : '.mysqli_error($conn));
					}
					else{
						while($rowseats= mysqli_fetch_assoc($resultseats)) {
							$seatid = $rowseats['SeatID'];
							$sqlinseretbseat = "INSERT INTO bookedseats (BID,SeatID) VALUES ($BID,$seatid)";
							$resultinsertbseat=mysqli_query($conn,$sqlinseretbseat);
							if(!$resultinsertbseat){
								die('Could not enter data : '.mysqli_error($conn));
							}
						}
						echo "<script> alert('Booking Confirmed!');window.location='managebookings.php';</script>";
					}
				}
			} else {
				echo "<script> alert('Sorry! No available seats');window.location='managebookings.php';</script>";
			}
		}
		
		if(isset($_POST['decline'])){
			$BID=$_POST['BID'];
			$sqlupdate="UPDATE booking SET Status = 'declined' WHERE BID = '$BID';";
			$resultupdate=mysqli_query($conn,$sqlupdate);
			if(!$resultupdate){
				die('Failed');
			}else{
				echo "<script> alert('Booking Declined!');window.location='managebookings.php';</script>";
			}
		}
	?>
</div>
</body>
</html>