<?php
require_once 'connection.php'; 
session_start();
?>
<html>
<head>
<script>
function dtmem(uid,rid) {
		

var xmlhttp;
		if (window.XMLHttpRequest) {
			xmlhttp= new XMLHttpRequest();
		}
		else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				
				response= xmlhttp.responseText;
				alert(response);

			}
		}
			xmlhttp.open("GET", "deletemem.php?uid=" + uid, "&rid=" + rid true);
			xmlhttp.send();
    }


</script>

<script>
function acceptmem(uid,rid) {
		
	//document.getElementById("del").innerHTML = "pp";

var xmlhttp;
		if (window.XMLHttpRequest) {
			xmlhttp= new XMLHttpRequest();
		}
		else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				
				response= xmlhttp.responseText;
			alert(response);

			}
		}
			xmlhttp.open("GET", "acceptmem.php?uid=" + uid, "&rid=" + rid true);
			xmlhttp.send();
    }


</script>
</head>
<div id="delE">


</div>

<?php
echo "Members";
echo "<br>"; 
$rid=$_SESSION['rid'];
			$sql = "SELECT users.uusername, users.uid FROM users, members WHERE members.mstatus = '1' AND members.m_rid = '$rid' AND users.uid = members.m_uid";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			$count = $stmt->rowCount();
			while($row   = $stmt->fetch(PDO::FETCH_ASSOC)){ 
?>
			
			<button onclick="dtmem('<?php echo $row['uid']; ?>','<?php echo $_SESSION['rid']; ?>' );" > <?php echo $row['uusername'];?> </button>
 <?php
        		
    echo "<br>";          
}   
echo "Waiting for response";
echo "<br>"; 
			$sql = "SELECT users.uusername, users.uid FROM users, members WHERE members.mstatus = '0' AND members.m_rid = '$rid' AND users.uid = members.m_uid";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			$count = $stmt->rowCount();
while($row   = $stmt->fetch(PDO::FETCH_ASSOC)){?>
			
			<button onclick="acceptmem('<?php echo $row['uid']; ?>','<?php echo $_SESSION['rid'];?>' )" > <?php echo $row['uusername'];?> </button>
<?php
 echo "<br>"; 

	}




?>
<a href="dashboard.php">Back to home</a>


</html>


