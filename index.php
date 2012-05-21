<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name = "viewport" content = "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
	<title>Sheridan Insider</title>

    <!-- Stylesheets -->
	<!-- <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen" /> -->
	
	
    <!-- Scripts -->
	<!--<script type="text/javascript" src="http://use.typekit.com/mnt3qxv.js"></script>-->
	<!--<script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->
	<!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<?php  wp_head(); ?>
	<script type="text/javascript" src="http://use.typekit.com/mnt3qxv.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body id="back-to-top">
	
	<!-- Header -->
	<header id="main-header">
		<h1>Sheridan Insider</h1>
		<p>News for the Sheridan Community</p>
		<a href="#navigation" id="nav-link">Navigation</a>
	</header>

	<!-- Main Body -->
	<section id="main">
		<?php get_template_part('loop','index'); ?>
	</section>

	<!-- Sidebar -->
	<section id="other">
		<div id="navigation"></div>
		<h2>Sidebar</h2>
		<p>Navigation goes here</p>
		<a href="#back-to-top" id="back-to-top-link">Back to top</a>
	</section>
	<div id="page-bg"></div>
	<?php wp_footer(); ?>
</body>
</html>