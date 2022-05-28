<?php
require_once 'connection.php'; 
session_start();
if(isset($_GET['rid'])){
	
try{
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				 
			$rid =$_GET['rid'];
			$_SESSION['rid']=$rid;
			$uid=$_SESSION['uid'];

			$sql = "INSERT INTO members (m_uid, m_rid, mstatus) VALUES ('$uid', '$rid', '0')";			
			$stmt = $conn->prepare($sql);
			$stmt->execute();		
			print "Successful request";
	

		
		}
catch(PDOException $e){
echo $e->getMessage();
	}	
}


?>