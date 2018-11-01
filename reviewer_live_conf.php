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
?>

	<h2 class="section-title" data-ix="page-header-fade-in" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms, transform 500ms;margin-top: 0px;font-family: Montserrat;font-size: 40px;text-transform: uppercase;font-weight: bold;margin-bottom: 10px;position: relative; color: darkslategray;left: 35%;">Live Conferences</h2>
	<div class="section-divider" data-ix="page-header-fade-in-2" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms ease 0s, transform 500ms ease 0s;display: inline-block;width: 70px;height: 3px;margin-top: 4px;margin-bottom: 15px;background-color: #34c48b;line-height: 20px;/*! top: 60px; */position: relative;left: 35%;"></div>
<?php

	$query1 = "SELECT * FROM CONFERENCE C,MEMBERSHIP M WHERE Date = '$date' AND C.C_name = M.C_name AND M.Member_id = '$mem'"; 
	$result1 = mysql_query($query1);
	if(!$result1){
	   print " Error - the query could not be executed";
	   $error = mysql_error();
	   print "$error";
	   exit;
   	}

	$num_rows = mysql_num_rows($result1); 
		
	if($num_rows == 0){
		print "There are no conferences going on currently";
		exit;
	}
	else{
		$query2 = "SELECT DISTINCT C.C_name,Date,Place,Topic,M.Member_id,P.Fname FROM CONFERENCE C,PERSON P,MEMBERSHIP M,PC_CHAIRMAN PC,REVIEWER_PAN R WHERE Date = '$date' AND C.C_name = M.C_name 				   AND ((M.Member_id = PC.Member_id AND PC.Pan_no = P.Pan_no) OR (M.Member_id = R.Member_id AND R.Pan_no = P.Pan_no))";
		
		$result2 = mysql_query($query2);
		if(!$result2){
	   		print " Error - the query could not be executed";
	   		$error = mysql_error();
	   		print "$error";
	   		exit;
   		}
	}

	print "<table font-size = 'larger' style='position: relative;left: 30px;width: 20%;'>";
	
	while( $rs = mysql_fetch_assoc( $result2 )){ 
				$cname = $rs['C_name'];
				$Date = $rs['Date'];
				$place =$rs['Place'];
				$topic = $rs['Topic'];
	}
	print "<tr align = 'center'>";
	print "<th align = 'left'>Cname : </th>";
	print "<td align = 'center'>". "$cname"."</td>";
	print "</tr>"; 
	print "<tr>";
	print "<td height = '30px'>";
	print "</td>";
	print "</tr>";

	print "<tr align = 'center'>";
	print "<th align = 'left'>Date : </th>";
	print "<td align = 'center'>". "$Date"."</td>";
	print "</tr>"; 
	print "<tr>";
	print "<td height = '30px'>";
	print "</td>";
	print "</tr>";


	print "<tr align = 'center'>";
	print "<th align = 'left'>Place : </th>";
	print "<td align = 'center'>". "$place"."</td>";
	print "</tr>"; 
	print "<tr>";
	print "<td height = '30px'>";
	print "</td>";
	print "</tr>";

             
        print "<tr align = 'center'>";
	print "<th align = 'left'>Topic : </th>";
	print "<td align = 'center'>". "$topic"."</td>";
	print "</tr>"; 
	print "<tr>";
	print "<td height = '30px'>";
	print "</td>";
	print "</tr>";
	print "</table>";
	print "<br />";
	print "<br />";

	print "<table style='width: 20%;left: 30px;position:relative; top:50px;'>";
	print"<h2> Fellow reviewers </h2>"; 
	$result3 = mysql_query($query2);
	while( $rs = mysql_fetch_assoc( $result3 )){ 
				$id = $rs['Member_id'];
				$fname = $rs['Fname'];
				if($id == $mem){
					continue;
				}
		              
      				print "<tr align = 'center'>";
		 	        print "<th align = 'left'>Member ID : </th>";
			        print "<td align = 'center'>". "$id"."</td>";
			        print "</tr>"; 

		       		print "<tr align = 'center'>";
		       		print "<th align = 'left'>Name : </th>";
		       		print "<td align = 'center'>". "$fname"."</td>";
		       		print "</tr>";
				print "<tr>";
				print "<td height = '30px'>";
				print "</td>";
				print "</tr>";
			
	}
				print "</table>";

	
	$query3 = "SELECT DISTINCT Author_id,Paper_id,Content,Category,Title,Journal_id FROM PAPER WHERE C_name = '$cname'";
	$result4 = mysql_query($query3);
	while( $rs = mysql_fetch_assoc( $result4 )){ 
				print "<table style='width: 30%;left: 30px;position: relative;'>";
				print"<h2> Papers presented </h2>";
				$author = $rs['Author_id'];
				$paper = $rs['Paper_id'];
				$content = $rs['Content'];
				$category = $rs['Category'];
				$title = $rs['Title'];
				$journal = $rs['Journal_id'];
				
		              
      				print "<tr align = 'center'>";
		 	        print "<th align = 'left'>Author ID : </th>";
			        print "<td align = 'center'>". "$author"."</td>";
			        print "</tr>"; 
				print "<tr>";
				print "<td height = '30px'>";
				print "</td>";
				print "</tr>";

		       		print "<tr align = 'center'>";
		       		print "<th align = 'left'>Paper ID : </th>";
		       		print "<td align = 'center'>". "$paper"."</td>";
		       		print "</tr>";
				print "<tr>";
				print "<td height = '30px'>";
				print "</td>";
				print "</tr>";

		       		print "<tr align = 'center'>";
		       		print "<th align = 'left'>Content : </th>";
		       		print "<td align = 'center'>". "$content"."</td>";
		       		print "</tr>";
				print "<tr>";
				print "<td height = '30px'>";
				print "</td>";
				print "</tr>";
				
				print "<tr align = 'center'>";
		 	        print "<th align = 'left'>Category : </th>";
			        print "<td align = 'center'>". "$category"."</td>";
			        print "</tr>"; 
				print "<tr>";
				print "<td height = '30px'>";
				print "</td>";
				print "</tr>";

		       		print "<tr align = 'center'>";
		       		print "<th align = 'left'>Title : </th>";
		       		print "<td align = 'center'>". "$title"."</td>";
		       		print "</tr>";
				print "<tr>";
				print "<td height = '30px'>";
				print "</td>";
				print "</tr>";

				print "<tr align = 'center'>";
		 	        print "<th align = 'left'>Journal ID : </th>";
			        print "<td align = 'center'>". "$journal"."</td>";
			        print "</tr>"; 
				print "<tr>";
				print "<td height = '30px'>";
				print "</td>";
				print "</tr>";	
				print "</table>";
				
				print "<h2>Add a review</h2>";

				?>
				    <form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
					<label class="container">Accepted
				  	 <input type="radio" checked="checked" name="radio" value = "Accepted">
  					 <span class="checkmark"></span>
					</label>
					<label class="container">Rejected
 				 	  <input type="radio" name="radio" value = "Rejected">
					  <span class="checkmark"></span>
					</label>
					<input type = "submit" name = "submit" class="button" onclick = "myFunction()" value ="Submit Review"></input>
				    </form>
				
				<script>
					function myFunction() {
					    alert("Review submitted successfully");
					}
				</script>
				
				<?php	
				$result = "1";
				if (isset($_POST['submit'])) {
					if (isset($_POST['radio'])) {	
						$result = $_POST['radio'];
					}
				}

				$query3 = "UPDATE PAPER SET Result = '$result' WHERE Paper_id = '$paper' AND Member_id = '$mem'";
				$result5 = mysql_query($query3);
				
						
	}
	?>			



		

</body>
</html>


