<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Movies</title>
<link rel="stylesheet" href="css/tables.css">
</head>
<body>
	<div class="menu-box">
	<form id="form1" name="form1" method="post">
  <p>
    <label>Enter Movie ID:</label>
    <input type="text" name="MID">
  </p>
  <p>
    <input type="submit" class="btn" name="search" value="search">
  </p>
</form>
	<?php
		include('connector.php');
		if(isset($_POST['search'])){
			$MID=$_POST['MID'];
			$sql="SELECT * FROM movie WHERE MID='$MID'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo"<script> alert('Invalid search');window.location='moviedelete.php';</script>";
			}
			else{
				echo "<table border='1' size='200'>
				<tr>
				<th>Movie ID</th>
				<th>Movie Name</th>
				<th>Category</th>
				<th>Runtime</th>
				<th>Description</th>
				<th>Action</th>
				</tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['MID'] . "</td>";
					echo "<td>" . $row['MName']  . "</td>";
					echo "<td>" . $row['Category'] . "</td>";
					echo "<td>" . $row['Runtime']  . "</td>";
					echo "<td>" . $row['Description'] . "</td>";
					echo "<td>";
					echo "<form method='post'>
						  <input type='hidden' name='MID' value='" . $row['MID'] . "'>
						  <input type='submit' class='btndel' name='delete' value='delete'>
						  </form>";
					echo "</td>";
				}
					
				echo "</tr>";
				echo "</table>";
			}
		}
	?>
	<?php
		if(isset($_POST['delete'])){
			$MID=$_POST['MID'];
			$sqldel="DELETE FROM movie WHERE MID = '$MID'";
			$resultdel=mysqli_query($conn,$sqldel);
			if(!$resultdel){
				echo"<script> alert('Delete failed');window.location='moviedelete.php';</script>";
			}
			else{
				echo"<script> alert('Movie deleted succesfully');window.location='moviedelete.php';</script>";
				
			}
		}
	?>
</div>
</body>
</html>