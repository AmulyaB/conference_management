<?php
session_start();
echo'
<html>
<head><title>About Reviewer</title> 
<link rel="stylesheet" type="text/css" href="reviewer_abt.css" />
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>';

	$date = date("Y-m-d");
	$mem = $_SESSION['member'];
	$db = mysql_connect("localhost","root","");
	
	if(!$db)
	    exit("Error - Could not connect to MySQL");

	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");

	$query1 = "SELECT * FROM CONFERENCE C,MEMBERSHIP M WHERE Date > '$date' AND C.C_name = M.C_name AND M.Member_id = '$mem'"; 
	$result1 = mysql_query($query1);
	if(!$result1){
	   print " Error - the query could not be executed";
	   $error = mysql_error();
	   print "$error";
	   exit;
   	}

	$num_rows = mysql_num_rows($result1); 
		
	if($num_rows == 0){
		print "There are no upcoming conferences";
		exit;
	}
	else{
		$query2 = "SELECT DISTINCT C.C_name AS 'CONFERENCE NAME',Date AS DATE,Place AS PLACE,Topic AS TOPIC,P.Author_id AS 'AUTHOR ID',P.Paper_id AS 'PAPER ID',P.Content AS CONTENT,P.Category AS CATEGORY,P.Title AS TITLE,P.Journal_id AS 'JOURNAL ID' FROM CONFERENCE C,MEMBERSHIP M,PC_CHAIRMAN PC,REVIEWER_PAN R,PAPER P WHERE Date > '$date' AND M.member_id = '$mem' AND C.C_name = M.C_name AND ((M.Member_id = PC.Member_id) OR (M.Member_id = R.Member_id)) AND M.C_name = P.C_name";
		
		$result2 = mysql_query($query2);
		if(!$result2){
	   		print " Error - the query could not be executed";
	   		$error = mysql_error();
	   		print "$error";
	   		exit;
   		}
	}
?>
<h2 class="section-title" data-ix="page-header-fade-in" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms, transform 500ms;margin-top: 0px;font-family: Montserrat;font-size: 40px;text-transform: uppercase;font-weight: bold;margin-bottom: 10px;position: relative; color: darkslategray;left: 35%;">Upcoming Conferences</h2>
	<div class="section-divider" data-ix="page-header-fade-in-2" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms ease 0s, transform 500ms ease 0s;display: inline-block;width: 70px;height: 3px;margin-top: 4px;margin-bottom: 15px;background-color: #34c48b;line-height: 20px;/*! top: 60px; */position: relative;left: 35%;"></div>
<?php
	print "<table border = '1' style='width: 100%;height: 15%; position:relative; top:50px; '>";
	print "<tr align = 'left'>";
	$num_rows = mysql_num_rows($result2);
	$row = mysql_fetch_array($result2);
	$num_fields = mysql_num_fields($result2);
	
	$keys = array_keys($row);
	for ($index = 0;$index < $num_fields;$index++)
		print "<th>".$keys[2*$index+1]."</th>";
	print "</tr>";

	for ($row_num = 0;$row_num < $num_rows;$row_num++){
		print "<tr align = 'left'>";
		$values = array_values($row);
		for ($index = 0;$index < $num_fields;$index++){
			$value = htmlspecialchars($values[2*$index+1]);
			print "<th>" . $value . "</th>";
		}
		print "</tr>";
		$row = mysql_fetch_array($result2);
	}
	print "</table>";
	
?>
	
</body>
</html>
