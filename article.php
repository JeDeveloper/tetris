<?php require_once("lib.php");
if ($_POST)
{
	if ($_POST['commentor_name'] && $_POST['is_not_robot'] && !($_POST['is_robot']) && $_POST['comment_text'])
	{
		addComment($_GET['article'], $_POST['commentor_name'], $_POST['comment_text']);
	}
}
?>

<html>
	<head>
		<?php require_once("generic_head.php"); ?><!--MUST come first!-->
		<?php start(); echo "<title>" . strip_tags(getArticleTitle($_GET['article'])) . "</title>"; ?>
	</head>
	<body onload="init()">
		<!--More Bootstrap stuff-->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<div id="main" class="container">
			<div id="header">
				<img src="images/banner.png" id="banner"/>
			</div>
			<div id="content">
				<!--Content goes here-->
				<?php
					printArticle($_GET['article'], true);
				?>
			</div>
		</div>
		<?php
		include "otherstuffbar.php";
		include "navbar.php";
		?>		
	</body>
</html>