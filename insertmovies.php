<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	if(isset($_POST['submit'])){
		include "connector.php";
		$Mname = $_POST['Mname'];
		$description = $_POST['description'];
		$imgName = $_FILES['image']['name'];
		$category = $_POST['categories'];
		$duration = $_POST['duration'];

		$sqlsearch = "SELECT * FROM movie WHERE MName = '$Mname'";
		$result1=mysqli_query($conn,$sqlsearch);

		if(mysqli_num_rows($result1)>0){
				die('Movie already exist');
		}
		else{
			$target = "moviepics/".basename($imgName);

			$sql = "INSERT INTO movie (MName, description,Img, category, runtime) VALUES ('$Mname','$description','$imgName', '$category' ,'$duration')";
			$results = mysqli_query($conn, $sql);

			if(!$results) {
				die('Could not enter data: ' . mysqli_error($conn));
			}
			else{
				echo "<script> alert('Entered details successfully');</script>";
			}								  		
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
				echo "<script> alert('Image Uploaded successfully');</script>";
			}
			else{
				echo "<script> alert('Image upload failed!');</script>";				
			}
		}
	 } else{
		echo "<script> alert('Your form is not submitted yet please fill the form and visit again');</script>";
	} 
?>	

</body>
</html>