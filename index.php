<?php get_header(); ?>
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