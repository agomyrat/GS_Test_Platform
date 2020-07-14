<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="source/css/default.css">
	<script src="public/js/jquery-3.4.1.min.js"></script>
	<?php if(isset($this->js)){
		foreach ($this->js as $js){
		echo '<script src="'.URL.'views/'.$js.'"></script>';
		}
	}?>
	<script type="text/javascript">
		$(document).ready(function(){});
	</script>
</head>
<body>

<div id="header">
	header
	<hr>
	<a href="index">Index</a>
	<a href="help">Help</a>
	<?php if (Session::get('loggedIn')==true){?>
	<a href="dashboard/logout">Logout</a>
	<?php }else{ ?>
	<a href="login">Login</a>
    <a href="signup">Sign Up</a>
	<?php } ?>
</div>

<div id="content">
<?php require 'views/'.$name.'.php';?>
</div>
<div id="footer"> (C)Footer</div>
</body>
</html>