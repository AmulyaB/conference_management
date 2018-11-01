<?php
	session_start();
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
?>
<html>
<head><title>Reviewer_home Page</title>
<link rel="stylesheet" type="text/css" href="reviewer_home.css" />  
<script type = "text/javascript" src = "reviewer1.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>
	<div class="back-img">
		<h2 class = " heading"> eventmaster.</h2>
	</div>
	
	<div class="topnav">
 		<a id = "a1" class = "active" href="presenter1.php" target = "iframe_a" onclick = "changeColor(1)">LIVE CONFERENCES</a>
  		<a id = "a2" href="presenter_upcoming.php" target = "iframe_a" onclick = "changeColor(2)">UPCOMING CONFERENCES</a>
  		<a id = "a3" href="presenter_paper.php" target = "iframe_a" onclick = "changeColor(3)" >PAPERS PRESENTED</a> 
  		<div class="topnav-right">
    			<a id = "a4" href="presenter_abt.php" target = "iframe_a" onclick = "changeColor(4)">ABOUT</a>
  		</div>
	</div>

	<div class="main">
		<iframe src="presenter1.php" name = "iframe_a" style="width:100%;height:100%;border:none;"></iframe>
	</div>
</body>
</html>
