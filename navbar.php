		<div id="navBar" class="panel panel-default">
			<ul class="nav nav-pills nav-stacked" style="font-size:24;">
				<li class="menu-item"><a href="index.php">Home</a></li>
				<li role="presentation" class="dropdown menu-item">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						News<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" style="font-size:18;">
					<?php
						foreach (getTopics() as $topic)
						{
							if (!$topic->isSubtopic())
								echo "<li><a href=\"topic.php?topic=".$topic->getKey()."\">".$topic->getName()."</a></li>";
						}
					?>
					</ul>
				</li>
				<li role="presentation" class="dropdown menu-item">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						Rockettopia<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" style="font-size:18;">
						<li><a href="#">Our Town</a></li>
						<li><a href="#">Town Fixtures</a></li>
						<li><a href="#">Rockettopia High School</a></li>
						<li><a href="#">Rockettopia College</a></li>
					</ul>
				</li>
				<li class="menu-item"><a href="calendar.php">Events</a></li>
				<li class="menu-item"><a href="faq.php">FAQ</a></li>
				<li class="menu-item"><a href="contact.php">Contact Us</a>
			</ul>
			<?php
				makeNavBar();
				echo "\t\t";
			?>
		</div>