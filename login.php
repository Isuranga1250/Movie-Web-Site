<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>testlogin</title>
</head>
<?php
	session_start();
	if(isset($_POST['submit'])){
		include ("connector.php");
		$name = $_POST['uname'];
		$password = $_POST['pass'];
		if($name=='Admin'&&$password=='12345'){
			echo"<script> alert('Welcome to The Admin Menu');window.location='adminmenu.html';</script>";
		}elseif($name=='Staff'&&$password=='12345'){
			echo"<script> alert('Welcome to The Staff Menu');window.location='staffmenu.html';</script>";
		}else{
			$sqlsearch = "SELECT * FROM user WHERE UserName ='$name' AND Password='$password'";
			$result=mysqli_query($conn,$sqlsearch);
			$row=mysqli_fetch_assoc($result);
			if(mysqli_num_rows($result)>0){
				session_start();
				$_SESSION['username']=$name;
				$_SESSION['UserID']=$row['UserID'];
				echo"<script> alert('Welcome');window.location='Homepage.php';</script>";
			}else{
				echo"<script> alert('Invalid username and password');window.location='login.html';</script>";
			}
		}
		
	}else{
		echo"Your form is not submitted yet please fill the form and visit again";
	}
?>
<body>
	
</body>
</html>