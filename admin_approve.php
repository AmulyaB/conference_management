<?php
	$value = $_GET['data'];
	$data = $_GET['person'];
	$db = mysql_connect("localhost","root","");
	
	if(!$db)
	    exit("Error - Could not connect to MySQL");

	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");

	

	

	$query8 = "SELECT  MAX(Paper_id) FROM PAPER";	
				$result8 = mysql_query($query8); 			
				if(!$result8){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}	
				$temp = mysql_fetch_row($result8);
				$paperid = (int)$temp[0] + 1;
 

	$query2 = "SELECT * FROM TEMP WHERE Author_pan = '$value'";
	$result2 = mysql_query($query2);
	if(!$result2){
	   		print " Error - the query could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	

	while ($row = mysql_fetch_array($result2, MYSQL_NUM)) {
    		$fname = $row[0];
		$mname = $row[1];
		$lname = $row[2];
		$dob = $row[3];
		$psw = $row[4];
		$phone = $row[5];
		$pan = $row[6];
		$content = $row[7];
		$category = $row[8];
		$title = $row[9];
		$jid = $row[10];
		$topic = $row[11];
		$year = $row[12];
		$authorid = $row[13];

	}
	$query2 = "SELECT Member_id FROM PROGRAMMECOMMITEE WHERE C_name = '$data'";
	$result2 = mysql_query($query2);
	if(!$result2){
	   		print " Error - the query1 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	
	while ($row = mysql_fetch_array($result2, MYSQL_NUM)) {
    		$memberid1 = $row[0];

	}
	$query2 = "SELECT Member_id FROM MEMBERSHIP WHERE C_name = '$data' AND Member_id <> '$memberid1'";
	$result2 = mysql_query($query2);
	if(!$result2){
	   		print " Error - the query2 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	
	$numrows = mysql_num_rows($result2);
	if($numrows == 3){
		while ($row = mysql_fetch_array($result2, MYSQL_NUM)) {
    			$memberid2 = $row[0];
			$memberid3 = $row[1];
			$memberid4 = $row[2];
		}
	}
	else if($numrows == 4){
		while ($row = mysql_fetch_array($result2, MYSQL_NUM)) {
    			$memberid2 = $row[0];
			$memberid3 = $row[1];
			$memberid4 = $row[2];
			$memberid5 = $row[3];
		}	
	}

	$query1 = "INSERT INTO PERSON VALUES('$fname','$mname','$lname','$dob','$pan','$psw')";
	$result1 = mysql_query($query1);
	if(!$result1){
	   		print " Error - the query could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	

	$query3 = "INSERT INTO PAPER VALUES('$paperid','$content','$category','$title','$jid','','$authorid')";
	$result3 = mysql_query($query3);
	if(!$result3){
	   		print " Error - the query3 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	

	$query4 = "INSERT INTO AUTHOR VALUES('$authorid','$pan')";
	$result4 = mysql_query($query4);
	if(!$result4){
	   		print " Error - the query4 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}

	$query5 = "INSERT INTO AUTHORED_BY VALUES('$paperid','$authorid')";
	$result5 = mysql_query($query5);
	if(!$result5){
	   		print " Error - the query5 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}		

	$query6 = "INSERT INTO JOURNAL VALUES('$jid','$year','$topic')";
	$result6 = mysql_query($query6);
	if(!$result6){
	   		print " Error - the query6 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	
	
	$query9 = "INSERT INTO REVIEW VALUES('$paperid','$memberid1','')";
	$result9 = mysql_query($query9);
	if(!$result9){
	   		print " Error - the query7 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	
	
	$query9 = "INSERT INTO REVIEW VALUES('$paperid','$memberid2','')";
	$result9 = mysql_query($query9);
	if(!$result9){
	   		print " Error - the query8 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	

	$query9 = "INSERT INTO REVIEW VALUES('$paperid','$memberid3','')";
	$result9 = mysql_query($query9);
	if(!$result9){
	   		print " Error - the query9 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	

	$query9 = "INSERT INTO REVIEW VALUES('$paperid','$memberid4','')";
	$result9 = mysql_query($query9);
	if(!$result9){
	   		print " Error - the query10 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	

	$query9 = "INSERT INTO REVIEW VALUES('$paperid','$memberid5','')";
	$result9 = mysql_query($query9);
	if(!$result9){
	   		print " Error - the query11 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	

	$query9 = "INSERT INTO PHONE_DETAILS VALUES('$pan','$phone')";
	$result9 = mysql_query($query9);
	if(!$result9){
	   		print " Error - the query12 could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	

	$query10 = "DELETE FROM TEMP WHERE Author_pan = '$value'";
	$result10 = mysql_query($query10);
	if(!$result1){
	   		print " Error - the query delete could not be executed";
	   		$error = mysql_error();
			print "$error";
			exit;
 	}	
	
	
?>
