                <?php 
                    $post_types = get_post_types();
                    unset(
                        $post_types['page'], 
                        $post_types['attachment'], 
                        $post_types['revision'], 
                        $post_types['nav_menu_item']
                    );
                    $args = array(
                        'post_type' => $post_types,
                        'showposts' => 10,
                        'paged'=>$paged
                    );
                    $insider_posts = new WP_Query($args);
                ?>

                <?php if ( have_posts() ) : while ($insider_posts->have_posts() ) : $insider_posts->the_post(); ?>
                    
                    <?php $queried_post_type = get_post_type(); ?>
                    <?php if('acf' !=  $queried_post_type): //suppress acf (bug? why is it showing up in the posts?) ?> 
                        <!-- NOTE: need to export ACF fields as XML and import to working DB -->
                        <?php if('post' == $queried_post_type): ?>
                        
                            <?php get_template_part( 'post' , 'post'); ?>
                        
                        <?php  elseif ('insider_gallery' == $queried_post_type): ?>
                            
                            <?php get_template_part('post' , 'gallery'); ?>    
                        
                        <?php endif; ?>
                    
                    <?php endif; ?>
                        
                <?php endwhile; endif; ?>

