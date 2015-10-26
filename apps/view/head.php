<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title;?></title>
	<!-- meta starts--> 
<?php

if(isset($meta))
	foreach ($meta as $key => $value) 
		echo "\t<meta $key $value>\n";

	?>
	<!-- meta ends-->
	<!-- css starts -->
<?php 
if(isset($css))
	foreach ($css as $key => $value) 
		echo "\t<link rel='stylesheet' type='text/css' href='$value'>\n";

?>
	<!-- css ends -->
	<!-- js starts -->
<?php 
if(isset($js))
	foreach ($js as $key => $value) 
		echo "\t<script src='$value'></script>\n";

?>
	<!-- js ends -->
</head>
<body>
<!--content starts-->
<div id="content"> 
