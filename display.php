<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_POST["submit"]))
{
	$new_date = date('y-m-d', strtotime($_POST['day']));
	
echo "Date is ".$new_date;

$new_date = date('d/m/Y', strtotime($_POST['day']));
echo "<br> ";
echo "Date is ".$new_date;

$new_date= date('d.M.Y/D', strtotime ($_POST['day']));
echo "<br> ";
echo "Date is ".$new_date;

$currentDate = date ('Y-M-D H:i:s');
echo "Current date and time: $currentDate";
}
?>


<form action=""method="POST">

<input type="date" name='day' value="">

<p>Select your birth day </p>

<button type="submit" name="submit">Print birth day</button>
</body>
</html>
