<article class="post-entry">
    <div class="post-wrapper">
        <header>
            <?php if(is_user_logged_in()): ?>
                <div class="btn edit-post"><?php edit_post_link(__('Edit'), ''); ?></div>    
            <?php endif; ?>
            <div class="post-date"><p><span><?php echo the_time( 'M','','',false ); ?></span>&nbsp;<?php echo the_time( 'jS, Y','','',false ); ?></p></div>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>    
        </header>
        <section class="post-content">

                <!-- BEGIN post featured image (not working yet) -->
                <?php if(has_post_thumbnail()): ?>
                    <div class="thumbnail-container">
                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'featured-image'); ?>
                        <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"  />
                    </div>
                <?php endif; ?>
                <!-- END post featured image (not working yet) -->

                <?php /*the_content('<span>Read Full Article</span>');*/ ?>
                <?php the_excerpt(); ?>
                <hr>
        </section>
        <footer class="meta selective-hide">
            <p><span>Filed Under: </span><b class=""><?php the_category('</b><b>') ?></b> <span>By: </span><a href="#"><?php the_author(); ?></a></p>
        </footer>
    </div>
</article>