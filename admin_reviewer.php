<html>
<head><title>Conferences</title> 
<link rel="stylesheet" type="text/css" href="admin1.css" />
<script type = "text/javascript" src = "reviewer1.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
<?php
	$db = mysql_connect("localhost","root","");
	
	if(!$db)
	    exit("Error - Could not connect to MySQL");

	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");

	$query1 = "SELECT DISTINCT RP.Member_id AS 'MEMBER ID',P.Fname AS 'FIRST NAME',P.Lname AS 'LAST NAME',P.DOB AS 'DATE OF BIRTH',P.Pan_no AS 'PAN NUMBER' FROM PERSON P,REVIEWER_EXPERTISE RE,REVIEWER_PAN RP WHERE RP.Member_id = RE.Member_id AND RP.Pan_no = P.Pan_no"; 
	$result1 = mysql_query($query1);
	if(!$result1){
	   print " Error - the query could not be executed";
	   $error = mysql_error();
	   print "$error";
	   exit;
   	}
?>
<h2 class="section-title" data-ix="page-header-fade-in" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms, transform 500ms;margin-top: 0px;font-family: Montserrat;font-size: 40px;text-transform: uppercase;font-weight: bold;margin-bottom: 10px;position: relative; color: darkslategray;left: 35%;">Reviewers</h2>
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

		<button class="open-button" onclick="openForm()" style="bottom: 5%;">ADD A REVIEWER</button>

		<div class="form-popup" id="myForm">	
  		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-container" method = "post">
    		<h1>ADD REVIEWER DETAILS</h1>

    		<label for="Member_id"><b>Member ID</b></label>
    		<input type="text" placeholder="Enter Member ID" name="id" required>

    		<label for="First name"><b>First Name</b></label>
    		<input type="text" placeholder="Enter First Name" name="fname" required>

		<label for="First name"><b>Middle Name</b></label>
    		<input type="text" placeholder="Enter Middle Name" name="mname" required>

		<label for="First name"><b>Last Name</b></label>
    		<input type="text" placeholder="Enter Last Name" name="lname" required>

		<label for="First name"><b>Date of birth</b></label>
    		<input type="text" placeholder="Enter Date of birth" name="dob" required>

		<label for="First name"><b>Pan number</b></label>
    		<input type="text" placeholder="Enter Pan number" name="pan" required>

		<label for="Phone"><b>Contact number</b></label>
    		<input type="text" placeholder="Enter First Name" name="phone" required>

		<label for="subject"><b>Subject of expertise</b></label>
    		<input type="text" placeholder="Enter Subject of expertise" name="sub" required>

    		<input type="submit" name = "submit" class="btn" value = "Submit" onclick = "myFunction()"></input>
    		<button type="button" class="btn cancel" onclick="closeForm()">Close</button>

  		</form>
		</div>

		<?php	
				
				if (isset($_POST['submit'])) {
					if (isset($_POST['id'])) {	
						$id = $_POST['id'];
						
					}
					if (isset($_POST['fname'])) {
						$fname = $_POST['fname'];
					}
					if (isset($_POST['mname'])) {	
						$mname = $_POST['mname'];
					}
					if (isset($_POST['lname'])) {
						$lname = $_POST['lname'];
					}
					if (isset($_POST['dob'])) {	
						$dob = $_POST['dob'];
					}
					if (isset($_POST['pan'])) {
						$pan = $_POST['pan'];
					}
					if (isset($_POST['phone'])) {	
						$phone = $_POST['phone'];
					}
					if (isset($_POST['sub'])) {
						$sub = $_POST['sub'];
					}
				}
				
		if(array_key_exists('submit',$_POST)){
				
				$query2 = "INSERT INTO PERSON VALUES('$fname','$mname','$lname','$dob','$pan','')";
				$result2 = mysql_query($query2);
				if(!$result2){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}
				
				$query5 = "INSERT INTO PHONE_DETAILS VALUES('$pan','$phone')";
				$result5 = mysql_query($query5);
				if(!$result5){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}

				$query3 = "INSERT INTO REVIEWER_PAN VALUES('$id','$pan')";
				$result3 = mysql_query($query3);
				if(!$result3){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}
		
				$query4 = "INSERT INTO REVIEWER_EXPERTISE VALUES('$id','$sub')";
				$result4 = mysql_query($query4); 	
				if(!$result4){	   
					print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}
		}
			
		?>
</body>
</html>

