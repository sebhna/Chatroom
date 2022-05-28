<?php
	session_start();
	require_once 'connection.php';
 
	if(isset($_POST['signup'])){
		if($_POST['uusername'] != "" || $_POST['uname'] != "" || $_POST['usurname'] || $_POST['upass'] != "" || $_POST['uemail']!= ""){
			try{
				$uusername = $_POST['uusername'];
				$uname = $_POST['uname'];
				$usurname = $_POST['usurname'];
				$upass = $_POST['upass'];
				$uemail = $_POST['uemail'];
				
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO users (uusername,uname,usurname,upass,uemail) VALUES ('$uusername', '$uname', '$usurname', '$upass', '$uemail')";
				$conn->exec($sql);
				
		$data = [
                ':uusername' => $uusername,
                ':upass' => $upass
				];
    
            $sql1 = "SELECT uid, uusername, upass FROM users WHERE uusername = :uusername AND upass = :upass LIMIT 1";
            $stmt = $conn->prepare($sql1);
            $stmt->bindParam(':uusername', $uusername, PDO::PARAM_STR, 12);
            $stmt->bindParam(':upass', $upass, PDO::PARAM_STR, 12);
            $stmt->execute();

			$count = $stmt->rowCount();
			$row   = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($count == 1 && !empty($row)) {
				$_SESSION['uid'] = $row['uid'];
				$_SESSION['rid'] = 1;

				$uid = $_SESSION['uid'];
				$sql2= "INSERT INTO members (m_uid,m_rid,mstatus) VALUES ('$uid','1','1')";
				$conn->exec($sql2);
			} else {
                            }
}catch(PDOException $e){
				echo $e->getMessage();
			}
		$conn = null;
			header('location:login.php');
		}

else{
			echo " <script>alert('Please fill up all the required fields')</script>
				<script>window.location = 'signup.php'</script>";
		}
	}
?>





<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="test.css">
</head>


<body>
	<div class="sep left">
    <input type="image" src="logoa.png" align="center" />
</div>
<div class="sep right">

<div class="sFrm">
    <form method="post">
	
	 <h1 class="title">Sign up</h1>
 <div class="inputContainer">
        <input type="text" class="input" placeholder="Enter username" name="uusername" id="uusername">
        <label for="" class="label">Username:</label>
      </div>
		  <div class="inputContainer">
        <input type="text" class="input" placeholder="Enter Name" name="uname" id="uname">
        <label for="" class="label">First Name:</label>
      </div>
        <div class="inputContainer">
        <input type="text" class="input" placeholder="Enter Surname" name="usurname" id="usurname">
        <label for="" class="label">Surname:</label>
      </div>
	      <div class="inputContainer">
        <input type="Password" class="input" placeholder="Enter Password" name="upass" id="upass">
        <label for="" class="label">Password:</label>
      </div>
        <div class="inputContainer">
        <input type="Password" class="input" placeholder="Enter Password again" name="upass" id="upass">
        <label for="" class="label">Confirm Password:</label>
      </div>
         <div class="inputContainer">
        <input type="text" class="input" placeholder="Enter Email" name="uemail" id="uemail">
        <label for="" class="label">Email:</label>
      </div>
  <table>
       <tr><td> <input type="submit" class="submitBtn" name="signup" value="Sign up"></td> 
		<td> <input type="reset" class="rBtn" value="Reset"></td> </tr>
	</table>
	 	<div class="sin">
    <p>Already have an account? <a href="login.php">Log in</a>.</p>
  </div>
    </form>


			
		
	
	
</div>
</div>
</body>
</html>



