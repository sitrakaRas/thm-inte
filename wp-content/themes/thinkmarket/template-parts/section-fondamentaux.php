<!-- section fondamentaux -->
<?php global $post; ?>
<?php 
  if($post->ID == wp_get_post_by_template("template/template-rejoindre.php")){
    $class="class='bl-rose'";
  } else{
    $class="";
  }
?>
<section id="fondamentaux" <?php echo $class; ?>>
  <div class="container-fluid">
    <div class="row">
       <!-- titre-part -->
      <div class="titre-part col-md-10 col-md-offset-1">
        <h2><?php echo get_field("titre_fondamentaux"); ?></h2>
        <?php echo get_field("sous_titre_fondamentaux") ?>
      </div>
      <!-- ./titre-part -->
      <!-- content-row -->
      <div class="content-row col-md-12">
        <div class="row">

          <?php 
              if(have_rows("block_fondamentaux")):
                while(have_rows("block_fondamentaux")): the_row();
           ?>
          <!-- block-f -->
          <div class="block-f col-md-3 col-sm-6">
            <div class="content-block">
              <!-- ./first-view -->
              <div class="first-view">
                <div class="img-ctn">
                  <img src="<?php echo get_sub_field("logo_block") ;?>" alt="">
                </div>
                <div class="text-ctnr">
                  <h3><?php echo get_sub_field("titre_block"); ?></h3>
                  <?php echo get_sub_field("content_block"); ?>
                </div>                    
                <span class="plus"></span>
              </div>
              <!-- ./first-view -->
              <!-- mask-view -->
              <div class="mask-view">
                <div class="text-ctn">
                  <?php echo get_sub_field("contenu_hover"); ?>
                </div>
              </div>
              <!-- ./mask-view -->
              
            </div>                
          </div>
          <!-- ./block-f -->
          <?php 
                endwhile;
              endif;
           ?>
        </div>
      </div>
      <!-- ./content-row -->
      
    </div>
  </div>
</section> 
<!-- ./section fondamentaux -->