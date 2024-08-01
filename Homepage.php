<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" type="text/css" href="homepagestyle.css">
</head>
<body>
	<div class="wrapper">
	
	<?php
	session_start();
	include("connector.php");
	?>
		<div class="top">
		<h2>Cineplex</h2>
		
		<ul>
	<?php
		if(isset($_SESSION['username'])) {
			echo "<li><a href=bookingstatus.php>Booking Status</a></li>";
			echo "<li><a href=logout.php>Logout</a></li>";
			echo "<li><a href=feedbacksubmit.php>Feedback</a></li>";
			echo "<li><a href=respondview.php>Feedback Responds</a></li>";
			echo "<li>Welcome ".$_SESSION['username']."</li>";
		} else {
			echo "<li><a href=login.html>Login</a></li>";
			echo "<li><a href=signinreg.html>Register</a></li>";	
		}	
	?>
		</ul>
		</div>
		<div class="bottom">
			
	<form action="" method="post">
		<ul>
		<li><label>Select Category:</label></li>
		<li class="select-wrapper"><select name="category">
		<option value="all" <?php if(isset($_POST['category']) && $_POST['category'] == 'all') echo 'selected'; ?>>All</option>
		<option value="English" <?php if(isset($_POST['category']) && $_POST['category'] == 'English') echo 'selected'; ?>>English</option>
		<option value="Sinhala" <?php if(isset($_POST['category']) && $_POST['category'] == 'Sinhala') echo 'selected'; ?>>Sinhala</option>
		<option value="Hindi" <?php if(isset($_POST['category']) && $_POST['category'] == 'Hindi') echo 'selected'; ?>>Hindi</option>
		<option value="Tamil" <?php if(isset($_POST['category']) && $_POST['category'] == 'Tamil') echo 'selected'; ?>>Tamil</option>
		</select></li>
		<li><input type="submit" name="filter" value="Filter" class="button"></li>
		</ul>
	</form>
		
	</div>
	</div>
	<div class="container">
	<?php
		if (isset($_POST['category'])) {
			$category = $_POST['category'];
		} else {
			$category = 'all';
		}
		if($category == 'all') {
			$sql="SELECT * FROM movie";
		}else{
			$sql="SELECT * FROM movie WHERE Category='$category'";
		}
		$result = mysqli_query($conn,$sql);
		while($row= mysqli_fetch_assoc($result)){
			?>
			<div class="movie-card">
			<img src="moviepics/<?php echo $row["Img"]; ?>">
            <div class="movie-info">
                <h3><?php echo $row["MName"]; ?></h3>
                <p><strong>Category : </strong><?php echo $row["Category"]; ?></p>
                <p><strong>Runtime : </strong><?php echo $row["Runtime"]; ?></p>
				<p><strong>Description : </strong><?php echo $row["Description"]; ?></p>
				<?php
				if(isset($_SESSION['username'])) {
					echo"<a href='booking.php?MID=".$row["MID"]."'>Book</a>";
				}
				?>
            </div>
        </div>
	<?php
		}
	?>
</div>
<footer class="footer">
        <button class="about-button" onclick="window.location.href='aboutus.html'">About Us</button>
</footer>
</body>
</html>