<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete User</title>
<link rel="stylesheet" href="css/tables.css">
</head>

<body>
<div class="menu-box">
<form id="form1" name="form1" method="post">
  <p>
    <label>Enter User ID:</label>
    <input type="text" name="UID">
  </p>
  <p>
    <input class="btn" type="submit" name="search">
  </p>
</form>
	<?php
		include('connector.php');
		if(isset($_POST['search'])){
			$UID=$_POST['UID'];
			$sql="SELECT * FROM user WHERE UserID='$UID'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('Search failed');window.location='deleteuserdetails.php';</script>";
			}
			else{
				
				echo "<table border='1' size='200'>
				<tr>
				<th>User ID</th>
				<th>User Name</th>
				<th>Password</th>
				<th>Action</th>
				</tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['UserID']  . "</td>";
					echo "<td>" . $row['UserName'] . "</td>";
					echo "<td>" . $row['Password']  . "</td>";
					echo "<td>";
					echo "<form method='post'>
						  <input type='hidden' name='UID' value='" . $row['UserID'] . "'>
						  <input type='submit' class='btndel' name='delete' value='Delete'>
						  </form>";
					echo "</td>";
					echo "</tr>";
					echo "</table>";
				}
				
			}
		}
	?>
	<?php
		if(isset($_POST['delete'])){
			$UID=$_POST['UID'];
			$sqldelseat = "DELETE FROM bookedseats WHERE BID IN (SELECT BID FROM booking WHERE UserID = '$UID')";
			$resultdelseat = mysqli_query($conn,$sqldelseat);
			if(!$resultdelseat) {
				echo "<script> alert('Failed to delete booked seats');window.location='deleteuserdetails.php'; </script>";
			}
			else{
				$sqldeletebooking = "DELETE FROM booking WHERE UserID = '$UID'";
				$resultdeletebooking = mysqli_query($conn, $sqldeletebooking);
				if(!$resultdeletebooking) {
					echo "<script> alert('Failed to delete bookings');window.location='deleteuserdetails.php'; </script>";
				}
				else{
					$sqldel = "DELETE FROM user WHERE UserID = '$UID'";
					$resultdel = mysqli_query($conn, $sqldel);
					if(!$resultdel) {
						echo "<script> alert('Failed to delete user');window.location='deleteuserdetails.php'; </script>";
					}
					else{
						echo"<script> alert('Delete Successful');window.location='deleteuserdetails.php';</script>";
					}
				}
			}
		}
	?>
	</div>
</body>
</html>