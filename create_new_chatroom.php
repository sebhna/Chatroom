
<?php
	session_start();
	require_once 'connection.php';
	
	if(isset($_POST['Save'])){
		if($_POST['rname'] != "" ){
try{
$rname = $_POST['rname'];
$rowner = $_SESSION['uid'];
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO rooms (rname,rowner) VALUES ('$rname', '$rowner')";
$conn->exec($sql);
				
				
				$sql1 = "SELECT rid FROM rooms WHERE rname = '$rname'";
				$stmt = $conn->prepare($query);
				$stmt->execute();

				$count = $stmt->rowCount();
				$row   = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($count == 1 && !empty($row)) {
				$rid = $row['rid'];
				$sql1 = "INSERT INTO members (m_uid,m_rid,mstatus) VALUES ('$rowner','$rid','1')";
				$conn->exec($sql1);
			}else{
				
			}
}catch(PDOException $e){
				
echo $e->getMessage();
}
		
			$conn = null;
			header('location:dashboard.php');
		}else{
			echo "
				<script>alert('Please fill up all the required field!')</script>
				<script>window.location = 'create_new_chatroom.php'</script>
			";
		}
	}
?>


<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>


<body>
<div class="sep left">
    <input type="image" src="logoa.png" align="center" />
</div>
<div class="sep right">
<div class="sFrm">
    <form method="post">


     <h1 class="title">New chatroom</h1>
          <div class="inputContainer">
        <input type="text" class="input" placeholder="Enter the name of the chatroom" name="rname" id="rname">
        <label for="" class="label">Name of chatroom:</label>
      </div>
	  
	<table>
<tr><td> <input type="submit" class="submitBtn" name="Save" id="Save" value="Save"></td> 
		<td><input type="reset" class="rBtn" value="Reset"></td> </tr>
	</table>
	 	<div class="sin">
<p align="left"><a href="dashboard.php">Back to home</a></p>
  </div>
  </div>
  </form>

</div>

</body>
</html>