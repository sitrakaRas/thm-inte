<!-- section expertise   -->
<section id="expertise-part" class="sect-wrap rose">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part col-md-10 col-md-offset-1">
        <h2><?php echo get_field("titre_expertise"); ?></h2>
        <?php echo get_field("sous_titre_expertise"); ?>
      </div>
      <!-- ./titre-part -->
      <!-- wrapper-expertise -->
      <div class="wrapper-expertise col-md-12">
        <div class="row">
          <!-- row-expertise -->
          <div class="row-expertise slider-expertise">
            <?php if( have_rows('items_slider_expertise') ):
                    while ( have_rows('items_slider_expertise') ) : the_row(); ?>
                      <!-- block-expertise -->
                      <div class="block-expertise col-md-4 col-sm-6">
                          <a href="#" class="link-expertise">
                            <img src="<?php echo get_sub_field("logo") ?>"; alt="icone">
                          </a>                  
                          <h3><?php echo get_sub_field("titre_item_expertise"); ?></h3>
                          <p><?php echo get_sub_field('contenu_item_expertise'); ?></p>
                      </div>
                      <!-- ./block-expertise -->
            <?php endwhile;endif; ?>
            
          </div>
          <!-- ./row-expertise -->
        </div>   
      </div>
      <!-- ./wrapper-expertise -->

    </div>
  </div>
</section>
<!-- ./section expertise -->