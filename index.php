<?php get_header(); ?>
<body id="back-to-top">
	
	<!-- Header -->
	<header id="main-header" role="banner">
		<div id="splash"></div>
		<div id="main-nav">
			<h1>Sheridan Insider</h1>
			<p>News for the Sheridan Community</p>
			<a href="#navigation" id="nav-link">Navigation</a>
		</div>
	</header>

	<div id="page-wrap">

		<!-- Main Body -->
		<section id="main" role="main">
			<?php if(is_front_page()):   get_template_part( 'loop' , 'index'    ); ?>
            <?php elseif(is_single()):   get_template_part( 'loop' , 'single'   ); ?>
            <?php elseif(is_search()):   get_template_part( 'loop' , 'search'   ); ?>
            <?php elseif(is_category()): get_template_part( 'loop' , 'category' ); ?>
            <?php elseif(is_archive()):  get_template_part( 'loop' , 'archive'  ); ?>
            <?php elseif(is_page()):     get_template_part( 'page' ); ?>
            <?php endif; ?>		
        </section>

		<!-- Sidebar -->
		<section id="other">
			<div id="navigation"></div>
			<h2>Sidebar</h2>
			<p>Mobile navigation goes here</p>
			<a href="#back-to-top" id="back-to-top-link">Back to top</a>
		</section>

	</div>
	<div id="page-bg"></div>
	<?php wp_footer(); ?>

</body>
</html>