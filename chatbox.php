<?php
require_once 'connection.php'; 
session_start();
if(isset($_GET['value']) && isset($_GET['text']) && isset($_GET['dateTime'])){

try{
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				 
			$rid =$_GET['value'];
			$datet =$_GET['dateTime'];
			$msg =$_GET['text'];
			$_SESSION['rid']=$_GET['value'];
			$uid=$_SESSION['uid'];
			
			$sql = "INSERT INTO messages(ms_uid,ms_rid,msdatetime,mstext) VALUES ('$uid', '$rid', '$datet', '$msg')";	
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			
			$sql1 = "SELECT users.uusername, messages.mstext, messages.msdatetime FROM users, messages WHERE users.uid = '$uid' AND ms_uid ='$uid' AND ms_rid = '$rid' AND msdatetime = '$datet' AND mstext='$msg'";
			$stmt = $conn->prepare($sql1);
			$stmt->execute();
			
			$count = $stmt->rowCount();
		
			$row   = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $row['msdatetime']." from ".$row['uusername'].": ". $row['mstext'];
			
			

		}catch(PDOException $e){
				echo $e->getMessage();
		}

}


?>
