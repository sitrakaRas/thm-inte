<?php /* Template Name: Actualité */ ?>

<?php
global $post;
?>
<?php get_header(); ?>
<?php get_template_part( 'template-parts/section', 'slidertop' ); ?>
<!-- section dernieres- actus -->
<section id="last-actu" class="sect-wrap rose actu-inner">
    <div class="container-fluid">
        <div class="row">
        <?php $terms = get_terms('category'); ?>
  

            <!-- tabs-part -->
            <nav class="tabs">
                <ul class="text-center">


                    <li class="active"><a href=".all" title="Toute notre actualité">Toute notre actualité</a></li>
                    <?php 
                    	foreach ($terms as $term) {
	                    	if($term->slug != 'non-classe'):
	                    	?>
	                    	<li><a href=".<?php echo $term->slug ?>" title="<?php echo $term->name ?>"><?php echo $term->name ?></a></li>
	                    	<?php
	                    	endif;
	                    }
                    ?>
                    
                </ul>
            </nav>
            <!-- ./tabs-part -->

            <!-- actu-wrapper -->
            <div class="actu-wrapper">       
                <!-- actu-bloc -->
                <?php  $actualites = CActualite::getAll(); ?>

                <?php $i = 0 ?>
                <?php foreach ($actualites as $actu) {
                	$categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
                	if($i != 2):
                	?>
                	<div class="col-md-4 all <?php echo $categ[0]->slug; ?>">
	                    <div class="actu-bloc">
	                    	<a href="<?php echo $actu->permalink; ?>">
	                    		<div class="img-block" style="background-image: url('<?php echo get_the_post_thumbnail_url($actu->ID,"large") ?>');">                
	                        	</div>
	                    	</a>
	                        
	                        <div class="text-actu">
	                            <h3><a href="#"><?php echo $categ[0]->name; ?></a></h3>
	                            <p>&Eacute;crit par <?php echo get_field('auteur_article',$actu->ID); ?></p>
	                            <a href="<?php echo $actu->permalink; ?>"><?php echo $actu->titre; ?></a>
	                            <div class="summary">
	                                <p><?php echo get_the_excerpt($actu->ID); ?></p>
	                            </div>
	                            
	                        </div>
	                        <div class="bottom-link">
	                        	<div class="link-more">
	                                <a href="<?php echo $actu->permalink; ?>">lire la suite</a>
	                            </div>
	                        </div>
	                    </div>
	                </div>						
                	<?php
                	else :
					?>
					<!-- twitter block -->
	                <div class="col-md-4 bltw">
	                    <div class="twitter-block">
	                        <h3><a href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" target="_blank">nos tweets</a></h3>
	                        <div class="listing">
	                           <a class="twitter-timeline" href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" data-show-replies="false"  data-aria-polite="assertive"data-chrome="nofooter noborders noheader transparent" data-tweet-limit="5"><?php the_field('id_twitter', 'option'); ?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	                        </div>
	                    </div>     
						<div class="bottom-link">
	                     	<div class="link-more">
	                            <a href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" target="_blank">tweet</a>
	                        </div> 
	                    </div>   
	                </div>
	                <!-- ./twitter block -->
	                <div class="col-md-4 all <?php echo $categ[0]->slug; ?>">
	                    <div class="actu-bloc">
	                    	<a href="<?php echo $actu->permalink; ?>">
	                    		<div class="img-block" style="background-image: url('<?php echo get_the_post_thumbnail_url($actu->ID,"large") ?>');">                
	                        	</div>
	                    	</a>
	                        
	                        <div class="text-actu">
	                            <h3><a href="#"><?php echo $categ[0]->name; ?></a></h3>
	                            <p>&Eacute;crit par <?php echo get_field('auteur_article',$actu->ID); ?></p>
	                            <a href="<?php echo $actu->permalink; ?>"><?php echo $actu->titre; ?></a>
	                            <div class="summary">
	                                <p><?php echo get_the_excerpt($actu->ID); ?></p>
	                            </div>
	                            
	                        </div>
	                        <div class="bottom-link">
	                        	<div class="link-more">
	                                <a href="<?php echo $actu->permalink; ?>">lire la suite</a>
	                            </div>
	                        </div>
	                    </div>
	                </div>			
					<?php
					endif;
                	$i++;
                } ?>
                              
            </div>
            <!-- ./actu-wrapper -->
        </div>
        <div class="row spinnerWrapper">
            <div class="col text-center">
                <span class="spinner"></span>
            </div>
        </div>
    </div>     
</section>
        <!-- ./section dernieres- actus -->

<?php get_footer();