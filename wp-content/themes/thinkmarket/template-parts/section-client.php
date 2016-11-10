<?php 
  $args = array( 'post_type' => 'client','posts_per_page' => 12 );
  $loop = new WP_Query( $args );
  
    
?>

<!-- section nos-client -->
    <section id="nosclient-part" class="sect-wrap bleu-ciel">
      <div class="container-fluid">
        <div class="row">
          <!-- titre-part -->
          <div class="titre-part col-md-6 col-md-offset-3">
            <a href="#"><?php the_field('titre_client', 'option'); ?></a>
            <p><?php the_field('sous_titre_client', 'option'); ?></p>
          </div>
          <!-- ./titre-part -->
          <!-- logo-wrapper -->
          <div class="logo-wrapper">
            <?php  while ( $loop->have_posts() ) : $loop->the_post();  ?>
            <!-- logo-block -->
            <div class="col-md-2 col-sm-6 block-logo">
              <a href="#">               
                <img src="<?php the_post_thumbnail_url(); ?>" alt="logo">
              </a>             
            </div>
            <!-- ./logo-block -->
            <?php 
              endwhile; 
            ?>
          </div>
          <!-- logo-wrapper -->
          <!-- bottom-link -->
          <div class="col-md-12 bottom-link blanc">
            <div class="link-ctnr">
              <a href="#">tous nos client</a>
            </div>
          </div>
          <!-- ./bottom-link -->
        </div>
      </div>
    </section>
    <!-- ./section nos-client -->
