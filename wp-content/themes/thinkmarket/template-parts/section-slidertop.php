<?php global $post; ?>

<section id="block-top">
  <!-- slider-top -->
  <div class="slider-top">
    <!-- item-top -->
    <div class="item-top" style="background-image: url('<?php echo get_field("image",$post->ID) ?>')"  
    data-center="background-position: 50% 30%;"
    data-top-bottom="background-position: 50% -40%;"
    data-anchor-target="#block-top">
      <div class="content-box ">
        <div class="content-box-type-one">
          <?php echo $post->post_content; ?>
        </div>
        
      </div>
      <!-- bottom-link -->
      <div class="col-md-12 bottom-link">
        <div class="link-ctnr">
          <a href="#">découvrir notre approche</a>
        </div>
      </div>
      <!-- ./bottom-link -->
    </div>
    <!-- ./item-top -->


    <?php if( have_rows('items') ):
            while ( have_rows('items') ) : the_row(); ?>
    <!-- item-top -->
    <div class="item-top" 
    <?php 
      $fd = get_sub_field("type_fond");
      if( $fd == "Rose"){
        ?>
         style="background-image: url('<?php echo get_bloginfo('template_url') ?>/images/bounce.jpg')"
        <?php 
      }
      elseif($fd == "Bleu"){        
         ?>
         style="background-image: url('<?php echo get_bloginfo('template_url') ?>/images/fond-bleu.jpg')"
        <?php 
      }else{
        ?>
        style="background-image: url('<?php echo get_sub_field("image") ?>')"
        <?php 
      }
    ?>
    data-center="background-position: 50% 0px;"
    data-top-bottom="background-position: 50% -200px;"
    data-anchor-target="#block-top"> 
      <div class="content-box">
        <div class="content-box-type-two">
          <div class="actu-bloc">
            <div class="text-actu">
              <h3><a href="<?php echo get_sub_field("lien_article"); ?>"><?php echo get_sub_field("titre"); ?></a></h3>
              <p><?php echo get_sub_field("auteur"); ?></p>
              <a href="#"><?php echo get_sub_field("titre_article"); ?></a>
              <span><?php echo get_sub_field("extrait") ?>...</span>
              <div class="link-more">
                <a href="<?php echo get_sub_field("lien_article"); ?>">lire la suite</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ./item-top -->

    <?php   endwhile;
          endif; 
    ?>

  </div>
  <!-- ./slider-top -->
  <!-- to-next-btn -->
  <div class="to-next-btn">
    <a href="#"><div class="scroll-to"></div></a>
  </div>
  <!-- ./to-next-btn -->

</section>