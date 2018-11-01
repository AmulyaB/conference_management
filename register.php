<?php
	$db = mysql_connect("localhost","root","");
	if(!$db)
	    exit("Error - Could not connect to MySQL");

	$er = mysql_select_db("conference_management_web");
	if(!$er)
	    exit("Error - Could not select the database");

	if (isset($_POST['submit'])) {
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
					if (isset($_POST['content'])) {
						$content = $_POST['content'];
					}
					if (isset($_POST['category'])) {	
						$category = $_POST['category'];
					}
					if (isset($_POST['title'])) {
						$title = $_POST['title'];
					}
					if (isset($_POST['j_id'])) {	
						$jid = $_POST['j_id'];
					}
					if (isset($_POST['year'])) {	
						$year = $_POST['year'];
					}
					if (isset($_POST['topic'])) {	
						$topic = $_POST['topic'];
					}
					if (isset($_POST['psw'])) {
						$psw = $_POST['psw'];
					}
	}
	if(array_key_exists('submit',$_POST)){
				$query8 = "SELECT  MAX(Author_id) FROM AUTHORED_BY";	
				$result8 = mysql_query($query8); 			
				if(!$result8){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}	
				
				$temp = mysql_fetch_row($result8);
				$curauthorid = $temp[0];
				$str = (string)$curauthorid;
				preg_match_all('!\d+!', $str, $matches);
				$authorid = (int)$matches[0][0] + 1;
				$authorid1 = trim($authorid);
				$authorid1 = "A"."$authorid1";
				
				$query2 = "INSERT INTO TEMP VALUES('$fname','$mname','$lname','$dob','$psw','$phone','$pan','$content','$category','$title','$jid','$topic','$year','$authorid1')";
				$result2 = mysql_query($query2);
				if(!$result2){
	   				print " Error - the query could not be executed";
	   				$error = mysql_error();
	   				print "$error";
	   				exit;
   				}
	}
?>
	<script> var val = " <?php echo $authorid ?> ";</script>
	<script> var val = val.trim();</script>
	<script>alert("Thank you for registering with us!! Your login ID is A"+val+". Login after a few days to see if your paper is selected")</script>
<?php
	include 'trial.html';	
?>
