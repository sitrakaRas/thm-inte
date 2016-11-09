<?php 
  $args = array( 'post_type' => 'partenaire' );
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post();  
    if( get_the_title() == 'Partenaires'):
?>

<!-- section partenaires -->
<section id="partenair-part" class="sect-wrap blanc">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part col-md-6 col-md-offset-3">
        <a href="#"><?php echo get_field("titre"); ?></a>
        <p><?php echo get_field("sous_titre"); ?></p>
      </div>
      <!-- ./titre-part -->

      <!-- partenair-wrapper -->
      <div class="partenair-wrapper">
        <!-- slider-part -->
        <div class="slider-part">
          <?php if( have_rows('les_partenaires') ):
                  while ( have_rows('les_partenaires') ) : the_row(); ?>
          <!-- block-part -->
          <div class="block-part item col-sm-3">
            <a href="<?php echo get_sub_field('lien') ?>" target="_blank" class="part-link">
              <div class="passif"><img src="<?php echo get_sub_field('logo') ?>" alt=""></div>
            </a>
          </div>
          <!-- ./block-part -->
            <?php endwhile; ?>
          <?php endif; ?> 
        </div>
        <!-- ./slider-part -->
      </div>
      <!-- partenair-wrapper -->
    </div>
  </div>
</section>
<!-- ./section partenair -->
<?php 
    endif;
  endwhile; 
?>