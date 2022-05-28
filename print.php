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

            $sql = "SELECT users.uusername, messages.mstext, messages.msdatetime FROM users, messages, rooms WHERE rooms.rid = '$rid' AND users.uid = messages.ms_uid AND messages.ms_rid = '$rid' ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $count = $stmt->rowCount();

            while($row   = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo $row['msdatetime']." from ".$row['uusername']."--> ". $row['mstext'];
                echo "<br>";
echo "<br>";
            }



        }catch(PDOException $e){
                echo $e->getMessage();
        }

}


?>