<?php global $post; ?>

<!-- section bussiness-case -->
  <section id="bussiness-case" style="background-image: url('<?php echo get_field("fond",$post->ID); ?>');">
    <div class="titre"><h2><?php echo get_field("titre_section",$post->ID) ?></h2></div>
    <div class="col-md-12">
      <div class="row">
        <!-- slider bc -->
        <div class="slider-bc">
          
          <?php $i = 0; ?>
          <?php if( have_rows('bussiness_items') ):
            while ( have_rows('bussiness_items') ) : the_row(); ?>

            
            
            <?php if( $i % 2 == 0 ): ?>
            <div class="item">
              <!-- bloc -->
              <div class="bloc top-block">
                <h3><?php echo get_sub_field("titre"); ?></h3>
                <?php echo get_sub_field("contenu"); ?>
              </div>
              <!-- ./bloc -->
            <!-- ./item -->
            <!-- ./bloc -->
            <?php else: ?>
              
                <!-- bloc -->
              <div class="bloc bottom-block">
                <h3><?php echo get_sub_field("titre"); ?></h3>
                <?php echo get_sub_field("contenu"); ?>
              </div>
            </div>
            <?php endif; ?>
            <?php $i++; ?>

          <?php endwhile;endif; ?>
          
          <?php if($i == 1): ?>
            </div>
              <!-- ./item -->
          <?php endif; ?>
         

        </div>
        <!-- ./slider bc -->

      </div>
    </div>
    
  </section>
  <!-- ./section bussiness-case -->