<?php require_once("lib.php");?>

<html>
	<head>
		<?php require_once("generic_head.php"); ?><!--MUST come first!-->
		<title>Frequently Asked Questions</title>
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
				<div class="standard-box">
					<ul>
						<li>
							Q. Isn't News from Rockettopia powered by Blogger?<br/>
							A. It used to be, but as of May 2014, we have our own website. The blogger site redirects here now.
						</li>
						<li>
							Q. Where is Rockettopia?<br/>
							A. Somewhere in the Orion Arm of the Milky Way.
						</li>
						<li>
							Q. One of your posts offends me.<br/>
							A. That's not a question.
						</li>
						<li>
							Q. What should I do if one of your posts offends me?<br/>
							A. Stay off the Internet and try to move on with life. There are a lot of things on the web much more 
							offensive than what I write, so if my writing offends you a lot, you might want to avoid computers.
						</li>
						<li>
							Q. I have a story to write! Can you publish it?<br/>
							A. It would be amazing to have more contributors! Anyone who wants to literally make the news <a href="contact.php">
							contact me</a>.
						</li>
						<li>
							Q. Do you have any suggestions for similar news sources?<br/>
							A. What you're essentially saying is "Can you recommend any of your competitors that I might like?" That being said, YES!
							Most people are familiar with <a href="http://www.theonion.com/">The Onion</a>, but if you haven't read it, go do so now.
							The Onion's affiliate site <a href="http://www.clickhole.com/">Clickhole</a> is a great source of interesting information,
							just like Buzzfeed and Upworthy! <a href="http://www.newslo.com/">The Newslo</a> is also worth checking out - they're the
							inspiration for the Show/Hide facts button, which I should really ditch already. Also check out 
							<a href="http://www.freewoodpost.com/">The Free Wood Post</a>.<br/>
							Finally, I have to give a huge endorsement to <a href="http://commonplacebooks.com/">Welcome to Night Vale</a>, the best
							podcast ever made. Subscribe and weep.
						</li>
						<li>
							Q. Do you sell merchandise?
							A. No, because no one has ever requested any. If you're interested in News from Rockettopia merchandise, <a href="contact.php">
							CONTACT ME! PLEASE!</a>
						</li>
						<li>
							Q. I want to be a News from Rockettopia informant!
							A. That's not a question - I just wrote that because I need <del>informants</del> reporters. For those interested in anonymously
							betraying everyone who trusted you, <a href="contact.php">contact me</a>.
						</li>
					</ul>
					If you have more questions, <a href="contact.php">contact me</a>.
				</div>
			</div>
		</div>
		<?php
			include "otherstuffbar.php";
			include "navbar.php";
		?>
	</body>
</html>