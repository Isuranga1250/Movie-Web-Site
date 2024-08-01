<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Feedbacks</title>
<link rel="stylesheet" href="css/feedbacksubmit.css">
</head>
<script type="text/javascript">
function formValidation(){
    var feedback = document.feedbackform.feedback;

    if(Emptyfield(feedback))
    {
        return true;
    }
    return false;
}
function Emptyfield(feedback){ 
        var feedback_len = feedback.value.length;

        if (feedback_len == 0)
        {
            alert("Fields should not be empty ");
            return false;
        }
        else
        {
            return true;
        }
}   
</script>
<?php
	include("connector.php");
	session_start();
	if(isset($_POST['submit'])){
		$feedback=$_POST['feedback'];
		$userID=$_SESSION['UserID'];
		$sqlInsertFB = "INSERT INTO feedback (UserID, feedback) VALUES ('$userID', '$feedback')";
		$resultInsertFB = mysqli_query($conn, $sqlInsertFB);
		if(!$resultInsertFB){
				die('Could not enter data : '.mysqli_error($conn));
			}
			else{
				echo"<script> alert('Feedback submitted successfully');window.location='Homepage.php';</script>";
			}
	}
	?>
	
<body>
	<form name="feedbackform" class="fbox" method="post" onSubmit="return formValidation();">
    <label class="title">Feedback</label><br>
    <textarea name="feedback" class="input-box" rows="10" cols="50" placeholder="Write your feedback here..." required></textarea><br><br>
    <input type="submit" class="btn" name="submit" value="Submit">
    <input type="reset" class="btn" name="reset" value="Reset">
</form>
</body>
</html>