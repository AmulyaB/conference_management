<?php

	$role = $_POST['role'];
	$id = $_POST['mem_id'];
	$pswd = $_POST['psw'];
	trim($role);
	trim($id);
	trim($pswd);
	$role = stripslashes($role);
	$id = stripslashes($id);
	$pswd = stripslashes($pswd);
	$db = mysql_connect("localhost","root","");
	if(!$db)
	    exit("Error - Could not connect to MySQL");

	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");

	if($role == "Reviewer"){
		$query1 = "SELECT DISTINCT Member_id FROM MEMBERSHIP WHERE Member_id = '$id'";
		$result1 = mysql_query($query1);
		if(!$result1){
			 print " Error - the query could not be executed";
	   	       	$error = mysql_error();
	   		print "$error";
	   		exit;
		}
		if(mysql_num_rows($result1) > 0 ){
			$query2 = "SELECT DISTINCT Passwd FROM PERSON P,REVIEWER_PAN R,PC_CHAIRMAN C WHERE ((C.Pan_no = P.Pan_no AND C.Member_id = '$id') OR (R.Pan_no = 						P.Pan_no AND R.Member_id = '$id')) AND Passwd = '$pswd'";
			$result2 = mysql_query($query2); 
			if(!$result2){
				 print " Error - the query could not be executed";
	   	       		$error = mysql_error();
	   			print "$error";
	   			exit;
			}
			if(mysql_num_rows($result2 ) > 0){
				include 'reviewer_home.php';	
			}
			else{
				echo'<script> alert("Enter a valid password")</script>';
				include 'trial.html';
			}		
		}
		else{
			echo'<script> alert("Enter a valid Username"); </script>';
			include 'trial.html';
		}	
	}

	elseif($role == 'Admin'){
		
		if($id == 'Admin1'){
			$query4 = "SELECT Passwd FROM PERSON WHERE Fname = 'Admin' AND Passwd = '$pswd'";
			$result4 = mysql_query($query4);
			if(!$result4){
			 print " Error - the query could not be executed";
	   	       	$error = mysql_error();
	   		print "$error";
	   		exit;
			}
			if(mysql_num_rows($result4) > 0 ){
				include 'admin_home.php';	
			}
			else{
				echo'<script> alert("Enter a valid password")</script>';
				include 'trial.html';
			}
		}
		else{
			echo'<script> alert("Enter a valid Username"); </script>';
			include 'trial.html';
		}	
	}
	else{
		$query3 = "SELECT DISTINCT Author_id FROM AUTHOR A WHERE A.Author_id = '$id'";
		$result3 = mysql_query($query3);
		if(!$result3){
			 print " Error - the query could not be executed";
	   	       	$error = mysql_error();
	   		print "$error";
	   		exit;
		}
		if(mysql_num_rows($result3) > 0 ){
			$query3 = "SELECT DISTINCT Passwd FROM PERSON P,AUTHOR A WHERE P.Pan_no = A.Author_pan AND A.Author_id = '$id' AND Passwd = '$pswd'";
			$result3 = mysql_query($query3);
			if(!$result3){
				 print " Error - the query could not be executed";
	   	       		$error = mysql_error();
	   			print "$error";
	   			exit;
			}
			if(mysql_num_rows($result3 ) > 0){
				include 'presenter_home.php';	
			}
			else{
				echo'<script> alert("Enter a valid password")</script>';
				include 'trial.html';
			}		
		}
		else{
			$query3 = "SELECT DISTINCT Author_id FROM TEMP T WHERE T.Author_id  = '$id'";
			$result3 = mysql_query($query3);
			if(!$result3){
				 print " Error - the query could not be executed";
	   	       		 $error = mysql_error();
	   			 print "$error";
	   			 exit;
			}
			if(mysql_num_rows($result3 ) > 0){
				$query3 = "SELECT DISTINCT Passwd FROM TEMP WHERE Author_id = '$id' AND Passwd = '$pswd'";
				$result3 = mysql_query($query3);
				if(!$result3){
					 print " Error - the query could not be executed";
	   	       			$error = mysql_error();
	   				print "$error";
	   				exit;
				}
				if(mysql_num_rows($result3 ) > 0){
					echo '<script>alert("Your paper is not yet approved");</script>';
					include 'trial.html';	
				}
				else{
					echo'<script> alert("Enter a valid password")</script>';
					include 'trial.html';
				}		
			}
			else{
				echo'<script> alert("Enter a valid Username"); </script>';
				include 'trial.html';
			}	
		}
	}
		
?>

