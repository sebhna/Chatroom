<?php
require_once 'connection.php'; 
session_start();
if(isset($_GET['rid'])){
		
try{
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				 
			$rid =$_GET['rid'];
			$_SESSION['rid']=$rid;
			$uid=$_SESSION['uid'];
			$sql = "SELECT uusername  from members ,users WHERE uid = m_uid AND m_rid='$rid' AND mstatus='1'" ;			
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			$count = $stmt->rowCount();
		
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				 print $row['uusername']."<br>";
}	

		
		}
catch(PDOException $e){
echo $e->getMessage();
		}

}


?>