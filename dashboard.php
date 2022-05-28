<?php
			require_once 'connection.php'; 
			session_start();
				
				
	?>

<!DOCTYPE html>
<html>
    <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="settings1.css">
<script>
function dele(rid) {
		
var xmlhttp;
		if (window.XMLHttpRequest) {
			xmlhttp= new XMLHttpRequest();
		}
		else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				//document.getElementById("del").innerHTML = xmlhttp.responseText;
				response= xmlhttp.responseText;
				alert(response);

			}
		}
			xmlhttp.open("GET", "deletechatroom.php?rid=" + rid, true);
			xmlhttp.send();
    }
</script>

<script>
function member(rid) {
		

var xmlhttp;
		if (window.XMLHttpRequest) {
			xmlhttp= new XMLHttpRequest();
		}
		else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("mem").innerHTML = xmlhttp.responseText;
				
			}
		}
			xmlhttp.open("GET", "viewm.php?rid=" + rid, true);
			xmlhttp.send();
    }
</script>

<script>
function deletefromchatroom(rid) {
		
	//document.getElementById("mem").innerHTML = rid;


var xmlhttp;
		if (window.XMLHttpRequest) {
			xmlhttp= new XMLHttpRequest();
		}
		else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				//document.getElementById("del").innerHTML = xmlhttp.responseText;
				response= xmlhttp.responseText;
				alert(response);

			}
		}
			xmlhttp.open("GET", "deletefromchatroom.php?rid=" + rid, true);
			xmlhttp.send();
    }
</script>
<script>


function chat(value){

    var text = document.getElementById("text").value;
    var tod = new Date();
    var date = tod.getFullYear()+'/'+(tod.getMonth()+1)+'/'+tod.getDate();
    var time = tod.getHours() + ":" + tod.getMinutes() + ":" + tod.getSeconds();
    var dateTime = date+' '+time;
    var xmlhttp;
    const node = document.createElement("li");


        if (window.XMLHttpRequest) {
            xmlhttp= new XMLHttpRequest();
        }
        else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                const textnode = document.createTextNode(xmlhttp.responseText);
                node.appendChild(textnode);
                document.getElementById("msg").appendChild(node);
                document.getElementById("text").value = "";
                document.getElementById("text").placeholder = "Type your message here...";
            }
        }

            xmlhttp.open("GET", "chatbox.php?value=" + value + "&text=" + text + "&dateTime=" + dateTime, true);
            xmlhttp.send();

 }

function printMessage(value)
 {
    var text = document.getElementById("text").value;
    var tod = new Date();
    var date = tod.getFullYear()+'/'+(tod.getMonth()+1)+'/'+tod.getDate();
    var time = tod.getHours() + ":" + tod.getMinutes() + ":" + tod.getSeconds();
    var dateTime = date+' '+time;
    var xmlhttp;


        if (window.XMLHttpRequest) {
            xmlhttp= new XMLHttpRequest();
        }
        else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("b").innerHTML = xmlhttp.responseText;
            }
        }

            xmlhttp.open("GET", "print.php?value=" + value + "&text=" + text+ "&dateTime=" + dateTime, true);
            xmlhttp.send();



 }

</script>

</head>

<body>
         
        <div class = "header">
			 <a href="dashboard.php"><input type="image" src="logoa.png"></a>
			 
		</div>

     
<div class = "nav_menu">
<a href="edit.php"></i>Edit profile</a>
<a href="create_new_chatroom.php">Create chatroom</a>

<button onclick="dele('<?php echo $_SESSION['rid']; ?>' )" > Delete chatroom </button>
<a href="registerinroom.php">Register in  room</a>
<button onclick="deletefromchatroom('<?php echo $_SESSION['rid']; ?>' )" > Delete from  chatroom </button>
<a href="login.php">Logout</a>
<a href="editch.php">Edit chatroom</a>
        </div>
		
		<div class="columns">
		<div class="column1">
		<div class="sidebar">
		<h2> Chatrooms </h2>
<div id="chats">
<?php
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$uid=$_SESSION['uid'];
		$sql = "SELECT rid , rname FROM rooms , members  WHERE m_uid='$uid' AND rid=m_rid AND mstatus='1'";
		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->rowCount();
		
	
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
?> <button  onclick="member('<?php echo $row['rid']; ?>' );printMessage('<?php echo $row['rid']; ?>');" > <?php print $row['rname']; ?> </button> <br>
<?php 


} 
	
?>

</div>

		</div>
		</div>
		
		
		
		<div class="columns">
		<div class="column2">
		<h2>Web-Chat</h2>
		<div class="b" id="b">
	          









		</div>
		<div class="footer">
		<form>
	            <input type="text" name="" id="text">
	            <button onclick="chat('<?php echo $_SESSION['rid'];?>')">Send</button>
                </form>
		</div>
		</div>
		
		<div class="columns">
		<div class="column3">
	
		<h2>Members</h2>
		<div id="mem">


</div>

<div id="del">

</div>
		
		
		</div>
		</div>
		</body>
		</html>