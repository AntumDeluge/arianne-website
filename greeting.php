<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
<?php

if ($_REQUEST['product'] != 'stendhal') {
	header('HTTP/1.0 404 No found', true, 404);
	echo 'No greeting define for this project.';
	return;
}




if ($_REQUEST['from'] == 'null') {



?>
<!-- <meta http-equiv="refresh" content="30; url=http://arianne.sf.net/"> --> 
<title>Stendhal</title>
<style type="text/css">
body {
	font-family: Arial, Helvetica, "Liberation Sans", "Lucida Sans", Sans-serif;
	font-size: 14pt;
	width: 600px;
	color: #000000;
	background-repeat: no-repeat;
	background-image: url("http://stendhalgame.org/images/header_background.jpg");
	overflow:hidden;
}
img.news_image {
	border: 1px solid black;
	clear: right;
	display: block;
	float: right;
	margin: 10px 0 10px 10px;
	padding: 0;
	position: relative;
}
img {
	border: 1px solid black;
}
</style>
</head>
<body>
<div style="margin-top: 200px; margin-left:100px">
<h1 style="padding:0em">Downloading Stendhal... </h1>


<p> Please be patient. A whole new world awaits...</p>

</div>


</body>
</html>

<?php 







} else {






?>
<title>Stendhal</title>
<style type="text/css">
body {
	font-family: Arial, Helvetica, "Liberation Sans", "Lucida Sans", Sans-serif;
	font-size: 14pt;
	width: 600px;
	color: #000000;
	background-repeat: no-repeat;
	background-image: url("http://stendhalgame.org/images/header_background.jpg");
	overflow:hidden;
}
img.news_image {
	border: 1px solid black;
	clear: right;
	display: block;
	float: right;
	margin: 10px 0 10px 10px;
	padding: 0;
	position: relative;
}
img {
	border: 1px solid black;
}
</style>
</head>
<body>
<div style="margin-top: 200px; margin-left:100px">
<h1 style="padding:0em">Updating Stendhal... </h1>


<p> Please be patient...</p>

</div>

</body>
</html>



<?php }