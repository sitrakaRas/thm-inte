<?php /* Template Name: Nous rejoindre */ ?>
<?php
global $post;
?>

<?php get_header(); ?>
<?php get_template_part( 'template-parts/section', 'slidertop' ); ?>
<?php get_template_part( 'template-parts/section', 'fondamentaux' ); ?>
<?php get_template_part( 'template-parts/section', 'recrute' ); ?>
<?php get_template_part( 'template-parts/section', 'manager' ); ?>
    
<!-- section join_us -->
<section id="joins_us">
  <div class="container-fluid">
    <div class="row">
      <div class="bloc-join">
        <?php echo get_field("contenu_join_us") ?>
      </div>
    </div>
  </div>     
</section>
<!-- ./section join_us -->

<!-- section processus -->
<section id="processus" class="sect-wrap rose">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part">
        <h2><?php echo get_field("titre_processus") ?></h2>
        <?php echo get_field("sous_titre_processus") ?>
      </div>
      <!-- ./titre-part -->
      <!-- processus-wrapper -->
      <div class="processus-wrapper">
        <div class="col-md-12"> 
            <div class="row"> 

            	<?php 
            		$i = 0;
            		if(have_rows("processus")): ?>
            	<?php while(have_rows("processus")): the_row();?>
            		<?php $i++; ?>
                <!-- block -->
	            <div class="the-bl">
	                <div class="col-md-4">  
	                    <div class="block"> 
	                      <div class="number">#<?php echo $i; ?></div>
	                      <div class="content"> 
	                          <?php echo get_sub_field("contenu"); ?>
	                      </div>
	                    </div>               
	                </div>                   
	            </div> 
	            <!-- block -->
          		<?php endwhile;endif; ?>
             
            </div>
        </div>   
      </div>
      <!-- ./processus-wrapper -->
    </div>
  </div>
</section>
<!-- ./section processus -->
<?php get_footer();