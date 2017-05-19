<?php require_once("lib.php");
start();
?>
<html>
	<head>
		<?php require_once("generic_head.php"); ?><!--MUST come first!-->
		<title>News from Rockettopia</title>
	</head>
	<body onload="init()">
		<!--More Bootstrap stuff-->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<div id="main">
			<?php require_once("header.php");?>
			<div id="content">
				<!--Content goes here-->
				<div id="calendar-controls">
					<?php createCalendarControls();?>
				</div>
				<div id="calendar-container">
					<?php printCalendar(); ?>
				</div>
				<script>
					calendarRefresh();
				</script>
			</div>
		</div>
		<?php
			require_once "otherstuffbar.php";
			require_once "navbar.php";
		?>
	</body>
</html>