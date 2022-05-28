<?php
require_once 'connection.php';
session_start();
if(isset($_GET['rid'])){

    try{
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $rid =$_GET['rid'];
        $uid=$_SESSION['uid'];

	if($rid!=1){

        $sql = "SELECT rooms.rid, rooms.rowner FROM rooms WHERE rooms.rid = '$rid' AND rooms.rowner = '$uid'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);

   if($count == 0 && empty($row)) {

  $sql1 = "DELETE FROM members  WHERE members.m_rid = '$rid' AND members.m_uid='$uid'";
  $stmt = $conn->prepare($sql1);
  $stmt->execute();          

            echo "You have succesfully deleted from this chatroom!.";
        }
}
    }catch(PDOException $e){
        echo $e->getMessage();
    }

}


?>




