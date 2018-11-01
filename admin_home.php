<?php 
echo'
<html>
<head><title>Reviewer_home Page</title>
<link rel="stylesheet" type="text/css" href="reviewer_home.css" />  
<script type = "text/javascript" src = "reviewer1.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>
	
	<div class="back-img">
		<h2 class = " heading"> eventmaster.</h2>
	</div>
	
	<div class="topnav">
 		<a id = "a1" class = "active" href="admin1.php" target = "iframe_a" onclick = "changeColor(1)">CONFERENCES</a>
  		<a id = "a2" href="admin_paper.php" target = "iframe_a" onclick = "changeColor(2)">PAPERS</a>
  		<a id = "a3" href="admin_reviewer.php" target = "iframe_a" onclick = "changeColor(3)">REVIEWERS</a> 
		<a id = "a5" href="admin_approvpaper.php" target = "iframe_a" onclick = "changeColor(5)">PAPERS TO BE APPROVED</a> 
  		<div class="topnav-right">
    			<a id = "a4" href="admin_about.php" target = "iframe_a" onclick = "changeColor(4)">ABOUT</a>
  		</div>
	</div>

	<div class="main">
		<iframe src="admin1.php" name = "iframe_a" scrolling="yes" style="width:100%;height:100%;border:none;"></iframe>
	</div>
</body>
</html>';
?>
