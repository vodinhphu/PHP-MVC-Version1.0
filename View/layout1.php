<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		ul li img{
			width: 200px;
			height: 200px;
		}
		ul#item li{
			display: inline-block;
		}
	</style>
</head>
<body>
	<h1>SMARTOSC GAME STORE</h1>
	<ul id="item">
	<?php include ROOT . "/View/subview/$subview" ;?>
	</ul>
</body>
</html>