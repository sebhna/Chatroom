<?php
require_once 'connection.php'; 
session_start();
?>

<html>
<head>
<script>

function rooms(rid)
{


var xmlhttp;
		if (window.XMLHttpRequest) {
			xmlhttp= new XMLHttpRequest();
		}
		else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("room").innerHTML = xmlhttp.responseText;
				
			}
		}
			xmlhttp.open("GET", "rooms.php?rid=" + rid, true);
			xmlhttp.send();
    }

</script>

</head>
<body>
<h1>Register to room</h1>

<?php
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				 
$uid=$_SESSION['uid'];
$sql = "SELECT rid, rname from rooms where rooms.rname not in ( SELECT rooms.rname from members, rooms WHERE members.m_uid = '$uid' AND rooms.rid=members.m_rid)";
$stmt = $conn->prepare($sql);	
			$stmt->execute();
			$count = $stmt->rowCount();
		
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

		
?>

<button  onclick="rooms('<?php echo $row['rid']; ?>' , '<?php echo $row['rname']; ?>')"><?php print $row['rname']; ?> </button>
<?php
}	


?>
<div id="room">


</div>
<a href="dashboard.php">Back to home</a>
</body>
</html>