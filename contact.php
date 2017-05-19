<?php require_once("lib.php");?>

<html>
	<head>
		<?php require_once("generic_head.php"); ?><!--MUST come first!-->
		<title>News from Rockettopia - Contact</title>
	</head>
	<body onload="init()">
		<!--More Bootstrap stuff-->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<?php //include_once("analyticstracking.php");?>
		<div id="main">
			<div id="header">
				<img src="images/banner.png" id="banner"/>
			</div>
			<div id="content">
				<!--Content goes here-->
				<?php
					start();
				?>
				<div class="standard-box" vocab="http://schema.org/" typeof="Person">
					You're welcome to try. I'm anonymous, but the Internet trail is pretty easy to follow if you want to take a shot. No, seriously, it should take you five minutes, tops.
					Or, if you're lazy, <a href="mailto:jeditor@rockettopia.com">email me</a>, <a href="https://www.facebook.com/Rockettopia">message me on Facebook</a>, or
					<a href="https://twitter.com/Rockettopia">tweet at me</a>
				</div>
			</div>
		</div>
			<?php
				include "otherstuffbar.php";
				include "navbar.php";
			?>
		</div>
	</body>
</html>