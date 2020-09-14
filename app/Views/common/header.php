<!doctype html>


<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Favicon -->
		<link rel="apple-touch-icon" sizes="57x57" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php print base_url();?>/assets/imgs/favicons/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php print base_url();?>/assets/imgs/favicons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php print base_url();?>/assets/imgs/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php print base_url();?>/assets/imgs/favicons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php print base_url();?>/assets/imgs/favicons/favicon-16x16.png">
		<link rel="manifest" href="<?php print base_url();?>/assets/imgs/favicons/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php print base_url();?>/assets/imgs/favicons/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<!-- Bootstrap CSS -->
		<!--<link rel="stylesheet" href="<?php print base_url();?>/assets/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="<?php print base_url();?>/assets/css/bootstrap-select.min.css"/>
		<link rel="stylesheet" href="<?php print base_url();?>/assets/css/tempusdominus-bootstrap-4.min.css" />


		<!-- Custom CSS -->
		<link rel="stylesheet" href="<?php print base_url();?>/assets/css/style.css"/>
		<link rel="stylesheet" href="<?php print base_url();?>/assets/css/responsive.css"/>

		<!-- Jquery -->
		<script src="<?php print base_url();?>/assets/js/jquery.min.js"></script>
		<script src="<?php print base_url();?>/assets/js/moment.js"></script>


		<title>
			<?php if(isset($title)){print $title;}?>
		</title>


	</head>

	<body id="full-width" class="fnt-wht">

		<?php if(isset($_SESSION['roles']) && $_SESSION['roles'] <= 2){?>


		<?php }?>
