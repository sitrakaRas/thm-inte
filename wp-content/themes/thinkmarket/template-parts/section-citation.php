 <?php   
    if(get_field("type_bloc_citation") == "blanc"){
      $class="blanc";
      $grid = "col-md-12";
    } else{
      $grid = "col-md-10 col-md-offset-1";
    }
  ?>

<section id="citation" class="<?php  echo $class; ?>" >
  <?php   if(get_field("type_bloc_citation") == "bleu"): ?>
  <div class="titre text-center"><h2><?php echo get_field("titre_citation") ?></h2></div>
  <?php   endif; ?> 
 
  <div class="slider">  
    <?php   if(have_rows("item_citation")): ?>
    <?php   while(have_rows("item_citation")): the_row();?>
     <div> 
          <div class="citation-ctn <?php echo $grid; ?>">
            <div class="row">
              <div class="contenu">
                <p><?php echo get_sub_field("contenu_citation")  ?></p>
              </div>
              <span class="auteur"><?php echo get_sub_field("auteur_citation") ?>, <span><?php echo get_sub_field("poste_auteur"); ?></span></span>
            </div> 
          </div>
        <div class="clearfix"></div>
      </div>  
    <?php   endwhile;endif; ?>
  </div>
 
</section>