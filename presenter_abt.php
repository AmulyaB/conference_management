<?php
session_start();
echo'
<html>
<head><title>About Reviewer</title>
<link rel="stylesheet" type="text/css" href="reviewer_abt.css" /> 
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
<br /> <br /> <br /> <br />
<div class="card">
  <div class="container">
	<div class="row">
  		<div class="column1">
    			<img src = "no-img.jpg" alt = "image">
  		</div>
  		<div class="column2">';
  	  		$mem = $_SESSION['member'];
			$db = mysql_connect("localhost","root","");
	
			if(!$db)
	    			exit("Error - Could not connect to MySQL");

			$er = mysql_select_db("conference_management_web");
			if(!$er)
	    			exit("Error - Could not select the database");
			$query = "SELECT DISTINCT Fname,Mname,Lname,DOB,P.Pan_no,Passwd FROM PERSON P,AUTHOR A WHERE P.Pan_no = A.Author_pan AND A.Author_id = '$mem'";
			$result = mysql_query($query);
			if(!$result){
	    			print " Error - the query could not be executed";
	    			$error = mysql_error();
	    			print "$error";
	    			exit;
   			}
			
			print "<table width='70%' height='90%' font-size = 'larger'>";
			print "<h2> Personal Information </h2>";

			while($rs = mysql_fetch_array($result)){ 
				$fname = $rs['Fname'];
				$mname = $rs['Mname'];
				$lname =$rs['Lname'];
				$dob = $rs['DOB'];
				$pan = $rs['Pan_no'];
				$password = $rs['Passwd'];
		       }

                       print "<tr align = 'center'>";
		       print "<th align = 'left'>Member ID : </th>";
		       print "<td align = 'left'>". "$mem"."</td>";
		       print "</tr>"; 
		     
		       print "<tr align = 'center'>";
		       print "<th align = 'left'>First name : </th>";
		       print "<td align = 'left'>". "$fname"."</td>";
		       print "</tr>"; 
			
		       print "<tr align = 'center'>";
		       print "<th align = 'left'>Middle name : </th>";
		       print "<td align = 'left'>". "$mname"."</td>";
		       print "</tr>"; 
		      
	               print "<tr align = 'center'>";
		       print "<th align = 'left'>Last name : </th>";
		       print "<td align = 'left'>". "$lname"."</td>";
		       print "</tr>";
			
 		       print "<tr align = 'center'>";
		       print "<th align = 'left'>Date of birth : </th>";
		       print "<td align = 'left'>". "$dob"."</td>";
		       print "</tr>"; 

                       print "<tr align = 'center'>";
		       print "<th align = 'left'>Pan number : </th>";
		       print "<td align = 'left'>". "$pan"."</td>";
		       print "</tr>"; 

		       print "<tr align = 'center'>";
		       print "<th align = 'left'>Username : </th>";
		       print "<td align = 'left'>". "$mem"."</td>";
		       print "</tr>"; 

		       print "<tr align = 'center'>";
		       print "<th align = 'left'>Password : </th>";
		       print "<td align = 'left'>". "$password"."</td>";
		       print "</tr>"; 

		       print "</table>";
		echo'	
  		</div>
  	</div>

  </div>
</div>

</body>
</html>';
?>




