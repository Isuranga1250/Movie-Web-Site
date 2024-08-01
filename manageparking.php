<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Parking</title>
<link rel="stylesheet" href="css/tables.css">
</head>
<script type="text/javascript">
function formValidation(){
    var Slots = document.park.Slots;

    if(Emptyfield(Slots))
    {
        if(allnumeric(Slots)) 
        {
                return true;    
        }
    }
    return false;
}
function Emptyfield(Slots){ 
        var Slots_len = Slots.value.length;

        if (Slots_len == 0)
        {
            alert("Fields should not be empty ");
            return false;
        }
        else
        {
            return true;
        }
}   
function allnumeric(Slots){ 
        var numbers = /^\d+$/;
        if(Slots.value.match(numbers))
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
		session_start();
		include("connector.php");
		$sqlslot = "SELECT COUNT(*) AS ParkIDS FROM parking";
		$resultslot = mysqli_query($conn, $sqlslot);
		$rowslot = mysqli_fetch_assoc($resultslot);
		$total_slots = $rowslot['ParkIDS'];
	?>
<body>
	<div class="menu-box">
	<p>Total Parking Slots :  <?php echo $total_slots; ?></p> <br>
	<form name="park" method="post" onSubmit="return formValidation();">
		<label>Slot Numbers : <input type="text" name="Slots"></label> <br>
		<button type="submit" class="btn" name="add_slots">Add Slots</button>  
  	</form>
	<?php
		if(isset($_POST['add_slots'])){
			$slots= $_POST['Slots'];
			if(100>=$total_slots+$slots){
				for($i=1;$i<=$slots;$i++){
					$sqlinsertslot = "INSERT INTO parking (ParkID) VALUES (NULL) ";
					$resultinsertslot = mysqli_query($conn, $sqlinsertslot);
					if(!$resultinsertslot){
						die('Could not enter data : '.mysqli_error($conn));
					}
				}
				echo"<script> alert('Slots Added successfuly');window.location='manageparking.php';</script>";
			}else{
				echo"<script> alert('Cant Add more Slots.');window.location='manageparking.php';</script>";
			}

		}
	?>
</div>
</body>
</html>