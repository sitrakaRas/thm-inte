<?php global $post; ?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section id="articleBanner" class="container-fluid">
    <div class="actu_banner row">
    	<?php switch (get_field("type_block_top")) {
    		case 'Image':
    			?>
    			<img src="<?php echo get_field("image"); ?> " alt="">

    			<?php
    			break;
    		case 'Slideshare':
    			echo do_shortcode(get_field("shortcode_slideshare"));
    			break;

    		case 'Video':
    			?>
    			<video class="video-play" preload="none" autoplay>
		           <source src="<?php echo get_field("video"); ?>" type="video/mp4" />
		        </video> 

    			<?php
    			break;
    		default:
    			break;
    	} ?>
	</div>
</section>

<section id="articleContent">
    <div class="container-fluid">
        <div class="actu_title row">
            <div class="link col-lg-12">
            	<?php $categ = wp_get_post_terms($post->ID, 'category', array("fields" => "all")); ?>
                <a href="#" title="L'actualité du cabinet"><?php echo $categ[0]->name; ?></a>
            </div>
            <div class="writer col-lg-12">
            	<p><?php the_time('j F Y') ?></p>
            	<p>
            		&Eacute;crit par <?php echo get_field("auteur_article"); ?>
            	</p>
                
            </div>
            <div class="leftCol col-md-8">
                <article class="content wysiwyg">
                    <h2><?php echo  get_the_title();?></h2>
                    <?php echo apply_filters('the_content',$post->post_content); ?>
                </article>
                <nav>
                    <ul class="row">
                        <li class="nav-prev col-md-4 col-sm-6 text-left readmore rm-left">
                        	<!-- <a href="#" title="Article précédent" class="readmore rm-left">Article précédent</a> -->
                        	<?php previous_post_link( '%link','Article précédent' ); ?>
                       	</li>
                        <li class="nav-next col-md-4 col-sm-6 pull-right text-right readmore rm-right">
                           <!--  <a href="#" title="Article suivant" class="readmore rm-right">Article suivant</a> -->
                            <?php next_post_link( '%link','Article suivant' ); ?>
                        </li>
                        <li class="nav-all col-md-4 col-sm-12 text-center readmore">
                            <a href="#" title="Toutes nos actus" >Toutes nos actus</a>

                        </li>
                    </ul>
                </nav>
            </div>
            <div class="rightCol col-md-4">
                <!-- twitter block -->
                    <div class="twitter-block">
                        <h3><a href="#">nos tweets</a></h3>
                        <div class="listing">
             				<a class="twitter-timeline" href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" data-show-replies="false"  data-aria-polite="assertive" data-chrome="nofooter noborders noheader transparent" data-tweet-limit="5"><?php the_field('id_twitter', 'option'); ?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>                           
                        </div>
                        <div class="link-more">
                            <a href="#">tweet</a>
                        </div>
                    </div>             
                <!-- ./twitter block -->
            </div>
        </div>
    </div>
</section>
<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>		
<?php get_footer();