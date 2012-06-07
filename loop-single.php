<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <article class="post-entry single">
    <div class="post-wrapper">
        <header>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="post-date"><p><span>Posted: </span><a href="#"><?php echo the_time( 'M jS, Y','','',false ); ?></a></p></div>
        </header>
        <section class="post-content">
            <?php the_content(); ?>
        </section>
        <footer>
            <p><span>Filed Under: </span><?php the_category(', ') ?> <span>By :</span><a href="#"><?php the_author(); ?></a></p>
        </footer>
    </div>
</article>
<?php endwhile; endif; ?>

<!-- begin Previous/Next links -->
<ul id="prev-next">
    <li id="prev">
        <div class="wrapper">
            <?php $prev_var = '
                <div id="prev-img"></div>
                <strong class="link">&nbsp; %link</strong>
            ';?>
            <?php next_post_link($prev_var); ?>
        </div>
    </li>
    <li id="next">
        <div class="wrapper">
            <?php $next_var = '
                <strong class="link">%link &nbsp;</strong>
                <div id="next-img"></div>
            ';?>
            <?php previous_post_link($next_var); ?>
        </div>
    </li>
</ul>
<!-- end Previous/Next links -->
<section>
<?php comments_template(); ?>
</section>
