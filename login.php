<?php
 
require_once 'connection.php';
session_start();


$msg = ""; 
if(isset($_POST['submitBtn'])) {
  $uusername = trim($_POST['uusername']);
  $upass = trim($_POST['upass']);
  if(isset($uusername) != "" && isset($upass) != "") {

    try {
  $sql = "SELECT uid, uusername, upass FROM users WHERE uusername = :uusername AND upass = :upass LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':uusername', $uusername, PDO::PARAM_STR);
      $stmt->bindValue(':upass', $upass, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
          $_SESSION['uid'] = $row['uid'];
				
	header("location: dashboard.php");       
      } else {
        $msg = "Invalid username or password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
   echo "Both fields are required!";
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


     <h1 class="title">Log in</h1>

         <div class="inputContainer">
        <input type="text" class="input" placeholder=" Enter Username" name="uusername" id="uusername" >
        <label for="" class="label">Username:</label>
      </div>

          <div class="inputContainer">
        <input type="Password" class="input" placeholder="Enter Password" name="upass" id="upass" >
        <label for="" class="label">Password:</label>
      </div>
      <table>
       <tr><td> <input type="submit" class="submitBtn" name="submitBtn" id="submitBtn" value="Log in" ></td> 
	<td> <input type="reset" class="rBtn" name="rBtn" id="rBtn" value="Reset"></td> </tr>
	</table>
        <div class="sin">
    <p>Create an account <a href="signup.php">Sign up</a>.</p>
  </div>
  </form>



</div>
</div>
</body>
</html>