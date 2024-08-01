<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add seats</title>
<link rel="stylesheet" href="css/tables.css">
</head>
<script type="text/javascript">
	function formValidation(){
		var Seats = document.Seat.Seats;

		if(Emptyfield(Slots))
		{
			if(allnumeric(Seats)) 
			{
					return true;    
			}
		}
		return false;
	}
	function Emptyfield(Seats){ 
			var Seats_len = Seats.value.length;

			if (Seats_len == 0)
			{
				alert("Fields should not be empty ");
				return false;
			}
			else
			{
				return true;
			}
	}   
	function allnumeric(Seats){ 
			var numbers = /^\d+$/;
			if(Seats.value.match(numbers))
			{
				return true;
			}
			else{
				alert('Please add numbers only');
				Slots.focus();
				return false;
			}
	}
</script>
	<?php
		include("connector.php");
		$sqlseat = "SELECT COUNT(*) AS SeatID FROM seat";
		$resultseat = mysqli_query($conn, $sqlseat);
		$rowseat = mysqli_fetch_assoc($resultseat);
		$total_seats = $rowseat['SeatID'];
	?>
	
<body>
	<div class="menu-box">
	<p>Total Seats :  <?php echo $total_seats; ?></p><br>
	<form name="seat" method="post" onSubmit="return formValidation();">
		<label>Seat Numbers : <input type="text" name="Seats"></label> <br>
		<button type="submit" class="btn" name="add_seats">Add Seats</button>  
  	</form>
	<?php
		if(isset($_POST['add_seats'])){
			$seats= $_POST['Seats'];
			if(400>=$total_seats+$seats){
				for($i=1;$i<=$seats;$i++){
					$sqlinsertseat = "INSERT INTO seat (SeatID) VALUES (NULL) ";
					$resultinsertseat = mysqli_query($conn, $sqlinsertseat);
					if(!$resultinsertseat){
						die('Could not enter data : '.mysqli_error($conn));
					}
				}
				echo"<script> alert('added successfuly.');window.location='manageseats.php';</script>";
			}else{
				echo"<script> alert('Cant Add more Slots.');window.location='manageseats.php'</script>";
			}

		}
	?>
	</div>
</body>
</html>