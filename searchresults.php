<?php require_once("lib.php");?>

<html>
	<head>
		<?php require_once("generic_head.php"); ?><!--MUST come first!-->
		<title>Search results for "<?php echo $_GET['query'];?>"</title>
	</head>
	<body onload="init()">
		<?php include_once("analyticstracking.php");?>
		<div id="main">
			<div id="header">
				<img src="images/banner.png" id="banner"/>
			</div>
			<div id="content">
				<!--Content goes here-->
				<h2 style="text-align:center;">Search results for "<?php echo $_GET['query'];?>":</h2>
				<?php
					start();
					$query = $_GET['query'];
					$results = array();
					foreach(getArticles() as $article)
					{
						for ($tag = 0; $tag < $article->getNumTags(); $tag++)
						{
							if (substr_count(strtolower($query), strtolower($article->getTag($tag))) > 0)
							{
								array_push($results, $article);
								break;
							}
						}
					}
					foreach ($results as $result)
					{
						echo $result;
					}
				?>
			</div>
		</div>
		<?php
			include "otherstuffbar.php";
			include "navbar.php";
		?>
	</body>
</html>