<div id="header">
	<?php
		require_once("Mobile_Detect.php");
		$detect = new Mobile_Detect;
		echo "\t\t\t";
		if ($detect->isMobile())
			echo "<img src=\"images/banner_m.png\" id=\"banner\"/>";
		else
			echo "<img src=\"images/banner.png\" id=\"banner\"/>";
		echo "\n\t\t\t";
	?>
</div>
<?php echo "\n";?>