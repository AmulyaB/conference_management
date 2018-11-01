<html>
<head><title>Conferences</title> 
<link rel="stylesheet" type="text/css" href="admin1.css" />
<script type = "text/javascript" src = "reviewer1.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
<?php
	$vdate = date("Y/m/d");
	$db = mysql_connect("localhost","root","");
	
	if(!$db)
	    exit("Error - Could not connect to MySQL");

	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");

	$query1 = "SELECT C_name AS 'CONFERENCE NAME',Date AS DATE,Place AS PLACE,Topic AS TOPIC FROM CONFERENCE"; 
	$result1 = mysql_query($query1);
	if(!$result1){
	   print " Error - the query could not be executed";
	   $error = mysql_error();
	   print "$error";
	   exit;
   	}
?>
	</div>
	<h2 class="section-title" data-ix="page-header-fade-in" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms, transform 500ms;margin-top: 0px;font-family: Montserrat;font-size: 40px;text-transform: uppercase;font-weight: bold;margin-bottom: 10px;position: relative; color: darkslategray;left: 35%;">Conferences</h2>
	<div class="section-divider" data-ix="page-header-fade-in-2" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms ease 0s, transform 500ms ease 0s;display: inline-block;width: 100px;height: 3px;margin-top: 4px;margin-bottom: 15px;background-color: #34c48b;line-height: 20px;/*! top: 60px; */position: relative;left: 35%;"></div>
<?php
	print "<table border = '1' style='width: 100%;height: 70%; '>";
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
		<br /><br />

		<button class="open-button" onclick="openForm()">ADD A CONFERENCE</button>

		<div class="form-popup" id="myForm">	
  		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-container" method = "post">
    		<h1>ADD CONFERENCE DETAILS</h1>

    		<label for="Member_id"><b>Conference name</b></label>
    		<input type="text" placeholder="Enter Conference name" name="cname" required>

    		<label for="First name"><b>Date</b></label>
    		<input type="text" placeholder="Enter Date" name="date" required>

		<label for="First name"><b>Place</b></label>
    		<input type="text" placeholder="Enter Place" name="place" required>

		<label for="First name"><b>Topic</b></label>
    		<input type="text" placeholder="Enter Topic" name="topic" required>

		<label for="First name"><b>Chairman ID</b></label>
    		<input type="text" placeholder="Enter Date of birth" name="chairman" required>

		<label for="First name"><b>Member ID 1</b></label>
    		<input type="text" placeholder="Enter Member ID" name="member1" required>

		<label for="Phone"><b>Member ID 2</b></label>
    		<input type="text" placeholder="Enter Member ID" name="member2" required>

		<label for="subject"><b>Member ID 3</b></label>
    		<input type="text" placeholder="Enter Member ID" name="member3" required>
		
		<label for="subject"><b>Member ID 4</b></label>
    		<input type="text" placeholder="Enter Member ID" name="member4">

    		<input type="submit" name = "submit" class="btn" value = "Submit"></input>
    		<button type="button" class="btn cancel" onclick="closeForm()">Close</button>

  		</form>
		</div>

		<?php	
				
				if (isset($_POST['submit'])) {
					if (isset($_POST['cname'])) {	
						$cname = $_POST['cname'];
						
					}
					if (isset($_POST['date'])) {
						$date1 = $_POST['date'];
						$date = $_POST['date'];
					
						$date1 = date_create($date1);
						if(date_diff($vdate,$date1) <= 0){
							echo'<script type = "text/javascript">alert("Enter a valid date");</script>';
							exit;
						}
					
					}
					if (isset($_POST['place'])) {	
						$place = $_POST['place'];
					}
					if (isset($_POST['topic'])) {
						$topic = $_POST['topic'];
					}
					if (isset($_POST['chairman'])) {	
						$chairman = $_POST['chairman'];
					}
					if (isset($_POST['chairman'])) {
						$pan = $_POST['chairman'];
					}
					if (isset($_POST['member1'])) {	
						$member1 = $_POST['member1'];
					}
					if (isset($_POST['member2'])) {
						$member2 = $_POST['member2'];
					}
					if (isset($_POST['member3'])) {
						$member3 = $_POST['member3'];
					}
					if (isset($_POST['member4'])) {
						$member4 = $_POST['member4'];
					}
				}
				
		if(array_key_exists('submit',$_POST)){
				
				$query2 = "INSERT INTO CONFERENCE VALUES('$cname','$date','$place','$topic')";
				$result2 = mysql_query($query2);
				if(!$result2){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}

				$query3 = "INSERT INTO MEMBERSHIP VALUES('$cname','$chairman')";
				$result3 = mysql_query($query3);
				if(!$result3){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}

				$query8 = "UPDATE PC_CHAIRMAN SET No_of_conf_headed = No_of_conf_headed + 1 WHERE PC_CHAIRMAN.Member_id = '$chairman'";
				$result8 = mysql_query($query8);
				if(!$result8){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}
				
				$query4 = "INSERT INTO MEMBERSHIP VALUES('$cname','$member1')";
				$result4 = mysql_query($query4);
				if(!$result4){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}

				$query5 = "INSERT INTO MEMBERSHIP VALUES('$cname','$member2')";
				$result5 = mysql_query($query5);
				if(!$result5){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}

				$query6 = "INSERT INTO MEMBERSHIP VALUES('$cname','$member3')";
				$result6 = mysql_query($query6);	
				if(!$result6){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}				
			
				if(isset($_POST['member4'])){
					$query7 = "INSERT INTO MEMBERSHIP VALUES('$cname','$member4')";
					$result7 = mysql_query($query7);
				if(!$result7){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;

				}
					$query9 = "INSERT INTO PROGRAMMECOMMITTEE VALUES('$cname','$chairman','5')";
					$result9 = mysql_query($query9);
					if(!$result9){
	   					print " Error - the query could not be executed";
	   					$error = mysql_error();
	   					print "$error";
	   					exit;
   					}
				}
				else{
					$query9 = "INSERT INTO PROGRAMMECOMMITTEE VALUES('$cname','$chairman','4')";
					$result9 = mysql_query($query9);
					if(!$result9){
	   					print " Error - the query could not be executed";
	   					$error = mysql_error();
	   					print "$error";
	   					exit;
   					}
			       }
		
				
		}
			
		?>
</body>
</html>

