<?php require_once("lib.php");
/*if ($_POST['commentor_name'] != null)
{
	addComment($_GET['article'], $_POST['commentor_name'], $_POST['comment_text']);
}*/?>
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
		<?php //include_once("analyticstracking.php");?>
		<div id="main">
			<div id="header">
				<img src="images/banner.png" id="banner"/>
			</div>
			<div id="content">
				<!--Content goes here-->
				<?php
					start();
					$topic = getTopic($_GET['topic']);
				?>
				<div class="standard-box">
					<h1 style="margin-left:16px; text-align:center;"><?php echo $topic->getName();?></h1>
					<div class="row" style="padding: 4px 4px 4px 4px;">
						<div class="col-sm-3">
							<ul class="nav nav-pills nav-stacked" style="font-size:24;">
							<?php
								foreach ($topic->getSubtopics() as $subtopic)
								{
									echo "<li><a href=\"topic.php?topic=".$subtopic->getKey()."\">".$subtopic->getName()."</a></li>\n";
								}
							?>
							</ul>
						</div>
						<div class="col-sm-9" style="font-size:16">
							<?php
								echo $topic->getDescription();
							?>
						</div>
					</div>
				</div>
				<div>
					<?php 
						foreach (getArticles() as $article)
						{
							if ($topic->includesArticle($article->getKey()))
								printArticle($article->getKey(), true);
						}
					?>
				</div>
			</div>
		</div>
		<?php
			include "otherstuffbar.php";
			include "navbar.php";
		?>
	</body>
</html>