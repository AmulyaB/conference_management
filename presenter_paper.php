<?php
session_start();
?>
<html>
<head><title>Conferences</title> 
<link rel="stylesheet" type="text/css" href="admin1.css" />
<script type = "text/javascript" src = "reviewer1.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
<?php
	$mem = $_SESSION['member'];
	$db = mysql_connect("localhost","root","");
	
	if(!$db)
	    exit("Error - Could not connect to MySQL");

	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");

	$query1 = "SELECT PAPER.Paper_id AS 'PAPER ID',Content AS CONTENT,Category AS CATEGORY,Title AS TITLE,PAPER.Journal_id AS 'JOURNAL ID',PAPER.C_name AS 'CONFERENCE NAME',Author_id AS 'AUTHOR ID',Year_of_publication AS 'YEAR OF PUBLICATION',Topic AS TOPIC,REVIEW.Result AS RESULT FROM PAPER,JOURNAL,REVIEW,PROGRAMMECOMMITEE WHERE PAPER.Journal_id = JOURNAL.Journal_id AND PAPER.Author_id = '$mem' AND REVIEW.Paper_id = PAPER.Paper_id AND PAPER.C_name = PROGRAMMECOMMITEE.C_name AND PROGRAMMECOMMITEE.Member_id = REVIEW.Member_id"; 
	$result1 = mysql_query($query1);
	if(!$result1){
	   print " Error - the query could not be executed";
	   $error = mysql_error();
	   print "$error";
	   exit;
   	}
   	

?>
<h2 class="section-title" data-ix="page-header-fade-in" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms, transform 500ms;margin-top: 0px;font-family: Montserrat;font-size: 40px;text-transform: uppercase;font-weight: bold;margin-bottom: 10px;position: relative; color: darkslategray;left: 35%;">YOUR PAPERS</h2>
	<div class="section-divider" data-ix="page-header-fade-in-2" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms ease 0s, transform 500ms ease 0s;display: inline-block;width: 100px;height: 3px;margin-top: 4px;margin-bottom: 15px;background-color: #34c48b;line-height: 20px;/*! top: 60px; */position: relative;left: 35%;"></div>
<?php

	print "<table border = '1' style='width: 100%;top:50px; position:relative'>";
	print "<tr align = 'left'>";

	$num_rows = mysql_num_rows($result1);
	$row = mysql_fetch_array($result1);
	$num_fields = mysql_num_fields($result1);
	
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
		$row = mysql_fetch_array($result1);
	}
	print "</table>";
?>
		
</body>
</html>

