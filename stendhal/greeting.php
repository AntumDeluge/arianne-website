<?php

if ($_REQUEST['product'] != 'stendhal') {
	header('HTTP/1.0 404 No found', true, 404);
	echo 'No greeting define for this project.';
	return;
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- <meta http-equiv="refresh" content="30; url=https://arianne-project.org"> -->
<title>Stendhal</title>
<style type="text/css">
body {
	font-family: Arial, Helvetica, "Liberation Sans", "Lucida Sans", Sans-serif;
	font-size: 14pt;
	width: 600px;
	color: #000000;
	background-repeat: no-repeat;
	background-image: url("/images/stendhal_header_background.jpg");
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
<?php
if ($_REQUEST['from'] == 'null') {
	echo '<h1 style="padding:0em">Downloading Stendhal... </h1>';
	echo '<p> Please be patient. A whole new world awaits...</p>';
} else {
	echo '<h1 style="padding:0em">Updating Stendhal... </h1>';
	echo '<p> Please be patient...</p>';
}
?>
</div>
</body>
</html>
<?php
