<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_POST['submit']))
{ include "connection.php";


  $Pname = $_POST['Pname'];
  $description = $_POST['description'];
  $imgName = $_FILES['image']['name'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];

//print_r($_FILES);

 $target = "upload/".basename($imgName);

$sql = "insert into products
  (Pname, description,imgName, price, Quantity)
  values ('$Pname', '$description', '$imgName', $price,$qty)";
	
	$results = mysqli_query($conn, $sql);
            
            if(!$results) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
			else
			{
            echo "Entered data successfully\n";
			}	
						
	  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
   				 echo "Image uploaded successfully";
				 //print_r($_FILES);
   				}else{
   					echo"Failed to upload image";
   					}
  		   }  
?>
<!---Multipart form data: The ENCTYPE attribute of <form> tag specifies the method of encoding for the form data.-->   
<form action="" method="post" enctype="multipart/form-data"  name="form1" id="form1">
  <table width="367" border="2" cellspacing="3" cellpadding="2">
    <tr>
      <th width="174" scope="row"><label for="Pname2">Product Name</label></th>
      <td width="168"><input type="text" name="Pname" id="Pname2" /></td>
    </tr>
    <tr>
      <th scope="row">Description</th>
      <td><label for="des"></label>
      <textarea name="description" id="des" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <th scope="row">Image</th>
      <td><p>
        <label for="img"></label>
        <label for="imgName"></label>
        <label for="img2"></label>
        <input type="hidden" name="size" value="1000000">
        <input type="file" name="image" id="img2" />
      </p></td>
    </tr>
    <tr>
      <th scope="row">Price</th>
      <td><label for="price"></label>
      <input type="text" name="price" id="price" /></td>
    </tr>
    <tr>
      <th scope="row">Quantity</th>
      <td><label for="qty"></label>
      <input type="text" name="qty" id="qty" /></td>
    </tr>
    <tr>
      <th scope="row"><input type="submit" name="submit" id="submit" value="Submit" /></th>
      <td><input type="reset" name="cancle" id="cancle" value="Reset" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>