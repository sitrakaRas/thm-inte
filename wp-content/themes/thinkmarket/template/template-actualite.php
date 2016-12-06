<?php /* Template Name: Actualité */ ?>

<?php
global $post;

if(isset($_GET["term_id"])){
  $term_id = $_GET["term_id"];
  $filtre = true;
}

$link_actu = get_the_permalink(wp_get_post_by_template("template/template-actualite.php"));

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

                    <li <?php if($filtre != true){echo 'class="active"';} ?>><a href="<?php echo $link_actu; ?>" title="Toute notre actualité">Toute notre actualité</a></li>
                    <?php 
                    	foreach ($terms as $term) {
	                    	if($term->slug != 'non-classe'):
	                    	?>
	                    	<li <?php if($term_id == $term->term_id){ echo "class='active'";}?>><a href="<?php echo $link_actu.'?term_id='.$term->term_id; ?>" title="<?php echo $term->name ?>"><?php echo $term->name ?></a></li>
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
               <?php get_template_part('template-parts/list','article'); ?>
                              
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