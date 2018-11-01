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

	$query1 = "SELECT Content AS CONTENT,Category AS CATEGORY,Title AS TITLE,Journal_id AS 'JOURNAL ID',Year_of_publication AS 'YEAR OF PUBLICATION',Topic AS TOPIC,Author_pan AS 'AUTHOR PAN' FROM TEMP"; 
	$result1 = mysql_query($query1);
	if(!$result1){
	   print " Error - the query could not be executed";
	   $error = mysql_error();
	   print "$error";
	   exit;
   	}
?>
	<h2 class="section-title" data-ix="page-header-fade-in" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms, transform 500ms;margin-top: 0px;font-family: Montserrat;font-size: 40px;text-transform: uppercase;font-weight: bold;margin-bottom: 10px;position: relative; color: darkslategray;left: 35%;">papers to be approved</h2>
	<div class="section-divider" data-ix="page-header-fade-in-2" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 500ms ease 0s, transform 500ms ease 0s;display: inline-block;width: 100px;height: 3px;margin-top: 4px;margin-bottom: 15px;background-color: #34c48b;line-height: 20px;/*! top: 60px; */position: relative;left: 35%;"></div>

	<table border='1' cellspacing='0' width='612' id='yourTbl'>
  <tr>
    <th ><center>CONTENT</th>
    <th ><center>CATEGORY</center></th>
    <th ><center>TITLE</center></th>
    <th><center>JOURNAL ID</center></th>
    <th ><center>YEAR OF PUBLICATION</center></th>
    <th><center>TOPIC</center></th>
    <th ><center>AUTHOR PAN</center></th>
    <th></th>
  </tr>
  <?php
      $i = 0;
      $number = 0;
      while($row = mysql_fetch_array($result1,MYSQL_NUM))
      {
 
        $number++; 
        $i++;
        if($i%2)
        {
            $bg_color = "#EEEEEE";
        }
        else 
        {
             $bg_color = "white";
        }   
   ?>
	<form id="form" name="form" method="post" action = "">
        <tr bgcolor=<?php echo $bg_color; ?>>  
            <th><center><?php echo $row[0]; ?></center></th>
            <th><center><?php echo $row[1]; ?></center></th>
            <th><center><?php echo $row[2]; ?></center></th>
            <th><center><?php echo $row[3]; ?></center></th>
	    <th><center><?php echo $row[4]; ?></center></th>
	    <th><center><?php echo $row[5]; ?></center></th>
	    <th><center><?php echo $row[6]; ?></center></th>
            <th><input name="btn" type="button" class = "button2" id="<?php echo $row[0]; ?>" value="Approve" onclick="yourEvent(this)">&nbsp;</center></th>
        </tr>
<?php 
      } 
 ?>
</table>
</form>
<script type="text/javascript">
function yourEvent(btnClick)
{

   var table = document.getElementById('yourTbl');
   var rowCount = table.rows.length; 
   var data = 1;
   for(var i=0; i<rowCount; i++) 
   {
		 var row = table.rows[i];
		 
		 //var cell = table.rows[0].cells.length;
		 //alert(cell);
		 var chkbox = row.cells[7].childNodes[0];
		 
		 if(chkbox == btnClick)
                 {
			
		       data = table.rows[i].cells[6].innerHTML;	
                       break;
                 }
   } 
   data = data.toString();
   data = data.replace(/<[^>]*>/g, '');


		    var person = window.prompt("Enter the name of the conference for which the paper is to be assigned","");
		    if (person != null) {
        		window.location.href="admin_approve.php?person="+person;
    		    }	
		    else{
			alert("Please fill in the box!!");
		    }
   window.location.href="admin_approve.php?data="+data;
}

</script>
</body>
</html>
