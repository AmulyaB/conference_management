<?php
session_start();
?>

<html>
<head><title>Reviewer_home Page</title>
<link rel="stylesheet" type="text/css" href="reviewer1.css" />  
<script type = "text/javascript" src = "reviewer1.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>

<?php		
	$member_id = $_SESSION['member'];
?>


<div class="card1" style="position: relative;top: 150px;">
  <p class = "p1"><b>Number of papers reviewed</b></p>
  <div class="container">
  
<?php	
	$db = mysql_connect("localhost","root","");
	if(!$db)
	    exit("Error - Could not connect to MySQL");
	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");
	
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

?>
  </div>
</div>

<div class="card2" style="position: relative;top: 150px;">
  <p class = "p2"><b>Number of conferences headed</b></p>
  <div class="container">
<?php
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
?>

  </div>
</div>

<div class="card3" style="position: relative;top: 150px;">
  <p class = p3><b>Number of papers approved</b></p>
  <div class="container">
<?php
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
?>
  </div>
</div>


</body>
</html>

