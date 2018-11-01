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

	$query1 = "SELECT Paper_id AS 'PAPER ID',Content AS CONTENT,Category AS CATEGORY,Title AS TITLE,PAPER.Journal_id AS 'JOURNAL ID',C_name AS 'CONFERENCE NAME',Author_id AS 'AUTHOR ID',Year_of_publication AS 'YEAR OF PUBLICATION',Topic AS TOPIC FROM PAPER,JOURNAL WHERE PAPER.Journal_id = JOURNAL.Journal_id"; 
	$result1 = mysql_query($query1);
	if(!$result1){
	   print " Error - the query could not be executed";
	   $error = mysql_error();
	   print "$error";
	   exit;
   	}
?>
	<h2 class="section-title" data-ix="page-header-fade-in" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms, transform 500ms;margin-top: 0px;font-family: Montserrat;font-size: 40px;text-transform: uppercase;font-weight: bold;margin-bottom: 10px;position: relative; color: darkslategray;left: 35%;">Papers</h2>
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

		<button class="open-button" onclick="openForm()">ADD A PAPER</button>

		<div class="form-popup" id="myForm" style="height: 100%;overflow: auto;">	
  		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-container" method = "post">
    		<h1>ADD PAPER DETAILS</h1>

    		<!-- <label for="Member_id"><b>Paper ID</b></label>
    		<input type="text" placeholder="Enter Paper ID" name="paperid" required> -->

    		<label for="First name"><b>Content</b></label>
    		<input type="text" placeholder="Enter Content" name="content" required>

		<label for="First name"><b>Category</b></label>
    		<input type="text" placeholder="Enter Category" name="category" required>

		<label for="First name"><b>Title</b></label>
    		<input type="text" placeholder="Enter Title" name="title" required>

		<label for="First name"><b>Journal ID</b></label>
    		<input type="text" placeholder="Enter Journal ID" name="journalid" required>

		<label for="First name"><b>Conference name</b></label>
    		<input type="text" placeholder="Enter Conference name" name="cname" required>

		<label for="Phone"><b>Year of publication</b></label>
    		<input type="text" placeholder="Enter Year of publication" name="year" required>

		<label for="subject"><b>Topic</b></label>
    		<input type="text" placeholder="Enter Topic" name="topic" required>
		
		<label for="subject"><b>AUTHOR ID 1</b></label>
    		<input type="text" placeholder="Enter Author ID" name="author1" required>
		
		<label for="subject"><b>AUTHOR1 PAN</b></label>
    		<input type="text" placeholder="Enter Author1 PAN" name="pan" required>

		<label for="subject"><b>AUTHOR ID 2</b></label>
    		<input type="text" placeholder="Enter Author ID" name="author2" >
		
		<label for="subject"><b>AUTHOR ID 3</b></label>
    		<input type="text" placeholder="Enter Author ID" name="author3" >

    		<input type="submit" name = "submit" class="btn" value = "Submit" onclick = "myFunction()"></input>
    		<button type="button" class="btn cancel" onclick="closeForm()">Close</button>

  		</form>
		</div>

		<?php	
				
				if (isset($_POST['submit'])) {
					
					if (isset($_POST['content'])) {
						$content = $_POST['content'];
					}
					if (isset($_POST['category'])) {	
						$category = $_POST['category'];
					}
					if (isset($_POST['title'])) {
						$title = $_POST['title'];
					}
					if (isset($_POST['journalid'])) {	
						$journalid = $_POST['journalid'];
					}
					if (isset($_POST['cname'])) {
						$cname = $_POST['cname'];
					}
					if (isset($_POST['year'])) {	
						$year = $_POST['year'];
					}
					if (isset($_POST['topic'])) {
						$topic = $_POST['topic'];
					}
					if (isset($_POST['author1'])) {
						$author1 = $_POST['author1'];
					}
					if (isset($_POST['pan'])) {
						$pan = $_POST['pan'];
					}
					if (isset($_POST['author2'])) {
						$author2 = $_POST['author2'];
					}
					if (isset($_POST['author3'])) {
						$author3 = $_POST['author3'];
					}
				}
				
		if(array_key_exists('submit',$_POST)){
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
 
				$query2 = "INSERT INTO PAPER VALUES('$paperid','$content','$category','$title','$journalid','$cname','$author1')";
				$result2 = mysql_query($query2);
				if(!$result2){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}

				$query3 = "INSERT INTO JOURNAL VALUES('$journalid','$year','$topic')";
				$result3 = mysql_query($query3);
				if(!$result3){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}
				
				$query4 = "INSERT INTO AUTHOR VALUES('$author1','$pan')";
				$result4 = mysql_query($query4);
				if(!$result4){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}

				$query5 = "INSERT INTO AUTHORED_BY VALUES('$paperid','$author1')";
				$result5 = mysql_query($query5);
				if(!$result5){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}			
			
				if(isset($_POST['author2'])){
					$query7 = "INSERT INTO AUTHORED_BY VALUES('$paperid','$author2')";
				$result7 = mysql_query($query7);
				if(!$result7){	  
					print "Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}
				}
		
				if(isset($_POST['author3'])){
					$query8 = "INSERT INTO AUTHORED_BY VALUES('$paperid','$author3')";
					$result8 = mysql_query($query8);
					if(!$result8){	  
						print "Error - the query could not be executed";
	   					$error = mysql_error();
	   					print "$error";
	   					exit;
   					}
				}
			}
		?>
</body>
</html>

