<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="source/css/default.css">
</head>
<body>

<div id="header">
	header
	<hr>
	<a href="#">Home</a>
	<a href="#">About</a>
</div>

<div id="content">
<?php require 'views/'.$content.'.php';?>
</div>
<div id="footer"> (C)Footer</div>

<script src="public/js/jquery-3.4.1.min.js"></script>
</body>
</html>