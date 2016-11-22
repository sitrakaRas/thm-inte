<?php global $post; ?>
<?php 
  if($post->ID == wp_get_post_by_template("template-offre.php")){
    $class="offreP";
  } else{
    $class="";
  }
?>
<?php if($post->post_type == "offre") : ?>
<!-- section offre-shifter   -->
<section id="shifter-part" class="sect-wrap rose">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part col-md-6 col-md-offset-3">
        <a href="#"><?php the_field('titre_nos_offre', 'option'); ?></a>
      </div>
      <!-- ./titre-part -->
      <!-- wrapper-shiffter -->
      <div class="wrapper-shiffter col-md-12">
        <div class="row">
          <!-- row-shiffter -->
          <div class="row-shiffter slider-schifter">

            <?php 
              $args = array( 'post_type' => 'offre' ,'posts_per_page' => 6);
              $loop = new WP_Query( $args );
              while ( $loop->have_posts() ) : $loop->the_post();  
            ?>
            <!-- block-shifter -->
            <div class="block-shifter col-md-4 col-sm-6">
                <a href="<?php echo get_the_permalink(); ?>" class="link-offre">
                  <img src="<?php echo get_field('logo'); ?>" alt="icone">
                </a>                  
                <h3 style="<?php echo "font-size:".get_field('taille_titre')."px;"?>"><?php echo get_the_title(); ?></h3>
                <p style="<?php echo "font-size:".get_field('taille_slogan')."px;"; ?>"><?php echo get_field('slogan'); ?></p>
                <a href="<?php echo get_the_permalink(); ?>">en savoir plus</a>
            </div>
            <!-- ./block-shifter -->
            <?php endwhile; ?>
           
          </div>
          <!-- ./row-shiffter -->
        </div>   
      </div>
      <!-- ./wrapper-shiffter -->
    </div>
  </div>
</section>
<!-- ./section offre-shifter   -->
<?php else: ?>
<!-- section offre-shifter   -->
<section id="shifter-part" class="sect-wrap rose <?php echo $class; ?>">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part col-md-6 col-md-offset-3">
        <a href="#"><?php the_field('titre_nos_offre', 'option'); ?></a>
        <p><?php the_field('sous_titre_nos_offre', 'option'); ?></p>
      </div>
      <!-- ./titre-part -->
      <!-- wrapper-shiffter -->
      <div class="wrapper-shiffter col-md-10 col-md-offset-1">
        <div class="row">
          <!-- row-shiffter -->
          <div class="row-shiffter">

            <?php 
              $args = array( 'post_type' => 'offre' ,'posts_per_page' => 6);
              $loop = new WP_Query( $args );
              while ( $loop->have_posts() ) : $loop->the_post();  
            ?>
            <!-- block-shifter -->
            <div class="block-shifter col-md-4 col-sm-6">
                <a href="<?php echo get_the_permalink(); ?>" class="link-offre">
                  <img src="<?php echo get_field('logo'); ?>" alt="icone">
                </a>                  
                <h3 style="<?php echo "font-size:".get_field('taille_titre')."px;"?>"><?php echo get_the_title(); ?></h3>
                <p style="<?php echo "font-size:".get_field('taille_slogan')."px;"; ?>"><?php echo get_field('slogan'); ?></p>
                <a href="<?php echo get_the_permalink(); ?>">en savoir plus</a>
            </div>
            <!-- ./block-shifter -->
            <?php endwhile; ?>
           
          </div>
          <!-- ./row-shiffter -->
        </div>   
      </div>
      <!-- ./wrapper-shiffter -->

      <!-- bottom-link -->
      <div class="col-md-12 bottom-link bleu ">
        <div class="link-ctnr">
          <a href="#">Nos offres</a>
        </div>
      </div>
      <!-- ./bottom-link -->

    </div>
  </div>
</section>
<!-- ./section offre-shifter   -->
<?php endif; ?>

<?php wp_reset_query(); ?>


