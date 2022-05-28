<?php
require_once 'connection.php'; 
session_start();
if(isset($_GET['rid'])){

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				 
		$rid =$_GET['rid'];
		$uid=$_SESSION['uid'];
if($rid != 1){
	$sql = "SELECT rooms.rid, rooms.rowner FROM rooms WHERE rooms.rid = '$rid' AND rooms.rowner = '$uid'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
			
	$count = $stmt->rowCount();
	$row   = $stmt->fetch(PDO::FETCH_ASSOC);
			
if($count == 1 && !empty($row)) {
	$sql1 = "SELECT members.m_rid, members.mid FROM rooms , members WHERE rooms.rid = '$rid' AND members.m_rid = '$rid' AND members.mstatus='1'";
	$stmt = $conn->prepare($sql1);
	$stmt->execute();			
				
	$count = $stmt->rowCount();
	$row   = $stmt->fetch(PDO::FETCH_ASSOC);
				
if($count == 1 && !empty($row)) {
				
	$sql2 = "DELETE FROM members WHERE members.m_rid = '$rid'";
	$stmt = $conn->prepare($sql2);
	$stmt->execute();
					
	$sql3 = "DELETE FROM rooms WHERE rid = '$rid'";
	$stmt = $conn->prepare($sql3);
	$stmt->execute();
	echo "You have succesfully delete this chatroom";
				}
			}
			
		
		}
		
}


?>
