<?php
session_start();
echo'
<html>
<head><title>Reviewer_home Page</title>
<link rel="stylesheet" type="text/css" href="reviewer1.css" />  
<script type = "text/javascript" src = "reviewer1.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>

<div class="container_top" style="color:black;">
  <img src="globe.jpg" alt="Snow" style="width:100%;height: 45%;">
<div class="top-right">Confal</div>
<div class="conf_alerts">CONFERENCE ALERTS</div>
<hr style="position: absolute;width: 240px;top: 175px;left: 900px;color: red;"/>
<div class="top-left" style="position: absolute;top: 8px;left: 16px;">';
		
	$db = mysql_connect("localhost","root","");
	
	if(!$db)
	    exit("Error - Could not connect to MySQL");

	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");

	$member_id = $_POST["mem_id"];
	trim($member_id);
	$member_id = stripslashes($member_id);
	$_SESSION['member'] = $member_id;
echo'
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="reviewer_abt.php" >About</a><br />
  <a href="#">Live Conferences</a><br />
  <a href="#">Upcoming Conferences</a>
</div>

<span class = "icon" onclick="openNav()" style="font-size: 45px; position:relative;">&#9776;</span>
<div style="font-size: 21px;position: relative;top: -36px;left: 52px;"> MENU </div>

</div>
</div>

<br /><br /><br /><br/>
<div class="card1">
  <p class = "p1"><b>Number of papers reviewed</b></p>
  <div class="container">';
  
	
	$query = "SELECT COUNT(*) FROM REVIEW WHERE Member_id = '$member_id'";
	$result = mysql_query($query);
	if(!$result){
	    print " Error - the query could not be executed";
	    $error = mysql_error();
	    print "$error";
	    exit;
   	}

	while($row = mysql_fetch_array($result)) {
    		echo $row['COUNT(*)'];
    
	}


echo'
  </div>
</div>

<div class="card2">
  <p class = "p2"><b>Number of conferences headed</b></p>
  <div class="container">';
	$query = "SELECT No_of_conf_headed FROM PC_CHAIRMAN WHERE Member_id = '$member_id'";
	$result = mysql_query($query);
    	if(!$result){
	    print " Error - the query could not be executed";
	    $error = mysql_error();
	    print "$error";
	    exit;
   	}

	while($row = mysql_fetch_array($result)) {
    		echo $row['No_of_conf_headed'];
    
	}
echo'
  </div>
</div>

<div class="card3">
  <p class = p3><b>Number of papers approved</b></p>
  <div class="container">';
  	$query = "SELECT COUNT(*) FROM REVIEW WHERE Member_id = '$member_id' AND Result = 'Accepted'";
	$result = mysql_query($query);
    	if(!$result){
	    print " Error - the query could not be executed";
	    $error = mysql_error();
	    print "$error";
	    exit;
   	}

	while($row = mysql_fetch_array($result)) {
    		echo $row['COUNT(*)'];
    
	}  
echo'
  </div>
</div>


</body>
</html>';
?>
