<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
	
	if(isset($_POST['submit'])){
		include ("connector.php");
		$name = $_POST['uname'];
		$password = $_POST['pass'];
		
		$sqlsearch = "SELECT * FROM user WHERE UserName = '$name'";
		$result1=mysqli_query($conn,$sqlsearch);
		if(mysqli_num_rows($result1)>0){
			echo"<script> alert('Username already exist');window.location='signinreg.html';</script>";
		}else{
			$sqlinsert  = "INSERT INTO user "."(UserName,Password)"."VALUES('$name','$password')";
			$result = mysqli_query($conn,$sqlinsert);
			if(!$result){
				die('Could not enter data : '.mysqli_error($conn));
			}
			else{
				echo"<script> alert('Registered Successfully');window.location='login.html';</script>";
			}
		}
	}else{
		echo"Your form is not submitted yet please fill the form and visit again";
	}
?>
<body>
</body>
</html>