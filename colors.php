<?php
	echo "<style>";
	$color1_1; $color1_2; $color2_1; $color2_2; $color2_3;
	$saturation = rand(33,66);
	$lightness = rand(33,66);
	$hue = rand(0,360);
	$color1_1 = "hsl(".$hue.",".$saturation."%,".$lightness."%);";
	$color1_2 = "hsl(".(180+$hue)%360 .",".$saturation."%,".$lightness."%);";
	$saturation = rand(60,80);
	$lightness = rand(75,90);
	$hue = rand(0, 360);
	$color2_1 = "hsl(".$hue.",".$saturation."%,".$lightness."%);";
	$color2_2 = "hsl(".($hue+120)%360 .",".$saturation."%,".$lightness."%);";
	$color2_3 = "hsl(".($hue+240)%360 .",".$saturation."%,".$lightness."%);";
	echo <<<EOT
	body
	{
		background-color: $color1_1;
	}
	
	#content
	{
		background-color: $color1_2;
	}
	
	.year
	{
		background-color: $color2_1;
	}
	
	.month
	{
		background-color: $color2_2;
	}
	
	.navBarArticle
	{
		background-color: $color2_3;
	}
EOT;
	echo "</style>";
?>