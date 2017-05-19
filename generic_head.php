<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="icon" href="images/rocket.ico"/>
		<meta property="og:image" content="http://www.rockettopia.com/images/logo.png"/>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/hammer.min.js"></script>
		<script src="js/scripts.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php require_once("colors.php"); //I am sorry for the nested requires
		require_once("Mobile_Detect.php");
		$detect = new Mobile_Detect;
		if ($detect->isMobile())
		{
			echo <<<EOT
				<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
EOT;
		}

