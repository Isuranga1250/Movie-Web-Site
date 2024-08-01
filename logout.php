<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>logout</title>
</head>

<body>
<?php
	session_start();
	if(session_destroy()) {
		echo"<script> alert('Logged Out succesfully');window.location='homepage.php';</script>";
	}
?>
</body>
</html>