<?php
 
 session_start();
 require_once 'connection.php';
 
 if(isset($_POST['edit'])){
                
    	$uid=$_SESSION['uid'];
	$uusername = $_POST['uusername'];
	$uname = $_POST['uname'];
	$usurname = $_POST['usurname'];
	$upass = $_POST['upass'];	
	
	$select= "select * from users where uid='$uid'";
    	$sql = mysqli_query($conn,$select);
    	$row = mysqli_fetch_assoc($sql);
    	$res= $row['uid'];
    if($res === $uid)
    {
			
	$sql2 = "UPDATE users SET uusername='$uusername',uname='$uname',usurname='$usurname',upass='$upass' WHERE uid='$uid'";
	$sql2=mysqli_query($conn,$sql2);
	


if($sql2)
       { 
          
           header('location:dashboard.php');
       }
       else
       {
           
           header('location:error.php');
       }
    }
    else
    {
              header('location:error.php');
    }
 }	
  
?>



<html>
<head>
    <link rel="stylesheet" type="text/css" href="test.css">

</head>

<body>
<div class="sep left">
    <input type="image" src="logoa.png" align="center" />
</div>
	<div class="sep left">
<div class="sFrm">
    <form method="post">


     <h1 class="title">Edit Profile</h1>


         <div class="inputContainer">
        <input type="text" class="input" placeholder="Change Username" name="uusername" id="uusername">
        <label for="" class="label">Username:</label>
      </div>

          <div class="inputContainer">
        <input type="text" class="input" placeholder="Change name" name="uname" id="uname">
        <label for="" class="label">First Name:</label>
      </div>
	  
	  
          <div class="inputContainer">
        <input type="text" class="input" placeholder="Change surname" name="usurname" id="usurname">
        <label for="" class="label">Surname:</label>
      </div>
	  
	       <div class="inputContainer">
        <input type="password" class="input" placeholder="Change password" name="upass" id="upass">
        <label for="" class="label">Confirmation:</label>
      </div>
          <div class="inputContainer">
        <input type="password" class="input" placeholder="Confirm password" name="upass" id="upass">
        <label for="" class="label">Confirmation:</label>
      </div>
    <table>
       <tr><td> <input type="submit" class="submitBtn" name="edit" id="edit" value="Edit"></td> 
		<td> <input type="reset" class="rBtn" name="Reset" id="Reset" value="Reset"></td> </tr>
	</table>
	 	<div class="sin">
		<p align="left"><a href="dashboard.php">Back to home</a></p>
    
  </div>
    

  </form>
</div>
</div>
</body>
</html>