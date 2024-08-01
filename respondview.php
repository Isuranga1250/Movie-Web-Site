<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>feedbacks</title>
<link rel="stylesheet" href="css/tables.css">
</head>
	
<body>
	<div class="menu-box">
	<?php
		include('connector.php');
			session_start();
			$UID=$_SESSION['UserID'];
			$sql="SELECT FID,feedback,reply FROM feedback WHERE UserID='$UID' AND reply IS NOT NULL ";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('No responds for your feedback');window.location='Homepage.php';</script>";
			}
			else{
				echo "<table>
				<tr>
				<th>Feedback ID</th>
				<th>Feedback</th>
				<th>Reply</th>
				
				</tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['FID'] . "</td>";
					echo "<td>" . $row['feedback'] . "</td>";
					echo "<td>" . $row['reply'] . "</td>";
					echo "</tr>";
				}
				
				echo "</table>";
			}
	?>
	</div>
</body>
</html>