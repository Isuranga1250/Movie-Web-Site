<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Booking</title>
<link rel="stylesheet" type="text/css" href="css/bookingstyle.css">
<script type="text/javascript">
function formValidation(){
    var nofseats = document.seats.nofseats;
	var date = document.seats.day;
    if(Emptyfield(nofseats,date))
    {
        if(allnumeric(nofseats)) 
        {
                return true;    
        }
    }
    return false;
}
function Emptyfield(nofseats,date){ 
        var nofseats_len = nofseats.value.length;
		var date_len=date.value.length;
        if (nofseats_len == 0|| date_len==0)
        {
            alert("Fields should not be empty ");
            return false;
        }
        else
        {
            return true;
        }
}   
function allnumeric(nofseats){ 
        var numbers = /^\d+$/;
        if(nofseats.value.match(numbers))
        {
            return true;
        }
        else{
            alert('Please add numbers only');
            nofseats.focus();
            return false;
        }
}
</script>
</head>
<body>
	<form name="seats" class="fbox" method="post" onSubmit="return formValidation();">
    <?php
    session_start();
    include("connector.php");
            $MID=$_GET['MID'];
			$UserID=$_SESSION['UserID'];
            $uname=$_SESSION['username'];
            $sqlm="SELECT * FROM movie WHERE MID='$MID'";
            $resultm = mysqli_query($conn,$sqlm);
            $rowm= mysqli_fetch_assoc($resultm);
            echo '<img src="moviepics/'.$rowm["Img"].'">';
	
            $UserID=$_SESSION['UserID'];
    ?>
    
        <div class="form-group">
            <h3 class="title">Select the Movie Time </h3>
            <label class="customlable">10.00 AM </label><input type="radio" name="showtime" value="10.00 AM" checked>
            <label class="customlable"> 1.00 PM </label><input type="radio" name="showtime" value="1.00 PM">
            <label class="customlable"> 4.00 PM </label><input type="radio" name="showtime" value="4.00 PM">
            <label class="customlable"> 7.00 PM </label><input type="radio" name="showtime" value="7.00 PM">
        </div>
		<div class="form-group">
			<h3 class="title">Select the Date </h3>
			<input type="date" name='day'>
		</div>
        <div class="form-group">
            <h3 class="title">Number of Seats you want to book </h3>
            <input type="text" class="input-box" name="nofseats">
        </div>
        <div class="form-group">
            <h3 class="title">Reserve a parking slot </h3>
            <label class="customlable2">Yes <input type="radio" name="park" value="Yes"></label>
            <label class="customlable2">No <input type="radio" name="park" value="No" checked></label>
        </div>
        <div class="form-group">
            <input type="submit"  name="confirm" value="Confirm Booking" class="btn">
        </div>
    </form>
    </div>
	<?php
		if(isset($_POST['confirm'])){
			$nofseats = $_POST['nofseats'];
			$showtime=$_POST['showtime'];
			$date=date('Y-m-d', strtotime($_POST['day']));
			$parkchoice=$_POST['park'];
			$total=$nofseats*1000;
			if($parkchoice=='Yes'){
				$sqlinsert="INSERT INTO booking (UserID,MID,ShowTime,BookingDate,TotalSeats,TotalPrice,ParkingNeed) 
						VALUES ('$UserID','$MID','$showtime','$date','$nofseats','$total','Yes')";
				$resultinsert=mysqli_query($conn,$sqlinsert);
				if(!$resultinsert){
					die('Booking Failed');
				}else{
					echo "<script> alert('Booking Confirmation is processing!');window.location='Homepage.php';</script>";
				}
			}else{
				$sqlinsert="INSERT INTO booking (UserID,MID,ShowTime,BookingDate,TotalSeats,TotalPrice,ParkingNeed) 
						VALUES ('$UserID','$MID','$showtime','$date','$nofseats','$total','No')";
				$resultinsert=mysqli_query($conn,$sqlinsert);
				if(!$resultinsert){
					die('Booking Failed');
				}else{
					echo "<script> alert('Booking Confirmation is processing!');window.location='Homepage.php';</script>";
				}
			}
		}	
	?>
</body>
</html>