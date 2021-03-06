<?php wp_reset_query(); ?>
<?php global $post; ?>

<?php 
  $type = get_field("type",$post->ID);
  if($type == "interne"){
    $class = "large";
    $home_class = "";
  }else{
    $class="";
    $home_class = "st-home";
  }
  
  if($post->ID == wp_get_post_by_template("template/template-rejoindre.php")){
    $glob_class = "inverted";
  }else{
    $glob_class ="";
  }
?>

<section id="block-top" class="<?php echo $glob_class; ?>">
  <!-- slider-top -->
  <div class="slider-top">
    <!-- item-top -->
    <div class="item-top  <?php echo $home_class; ?>" style="background-image: url('<?php echo get_field("image",$post->ID) ?>')"  
>
      <div class="content-box ">
        <div class="content-box-type-one <?php echo $class; ?>">
          <?php if($post->post_type == 'offre'): ?>
          <div class="titre"><?php echo $post->post_title; ?></div>
          <?php endif; ?>
          <?php echo get_field('contenu_premier_slide',$post->ID); ?>
        </div>
        
      </div>
      <?php $lien = get_field('lien',$post->ID); ?>
      <?php if($lien != ""): ?>
      <!-- bottom-link -->
      <div class="col-md-12 bottom-link">
        <div class="link-ctnr">
          <a href="<?php echo $lien; ?>">découvrir notre approche</a>
        </div>
      </div>
      <!-- ./bottom-link -->
      <?php endif; ?>
    </div>
    <!-- ./item-top -->


    <?php if( have_rows('items') ):
            while ( have_rows('items') ) : the_row(); ?>
    <?php  
      $fd = get_sub_field("type_fond");
      $sh = get_sub_field("show_hide");
      if( $sh[0] != "Hide"):
    ?>
    <!-- item-top -->
    <div class="item-top" 
    <?php 

      if( $fd == "Rose"){
        ?>
         style="background-image: url('<?php echo bloginfo('template_url') ?>/images/bounce.jpg')"
        <?php 
      }
      elseif($fd == "Bleu"){        
         ?>
         style="background-image: url('<?php echo bloginfo('template_url') ?>/images/fond-bleu.jpg')"
        <?php 
      }else{
        ?>
        style="background-image: url('<?php echo get_sub_field("image") ?>')"
        <?php 
      }
    ?> > 
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

    <?php
          endif;  
        endwhile;
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