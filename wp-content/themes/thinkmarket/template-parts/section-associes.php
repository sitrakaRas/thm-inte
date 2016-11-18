<!-- section associes -->
<section id="associes" class="sect-wrap">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part col-md-10 col-md-offset-1">
        <h2><?php echo get_field("titre_associes"); ?></h2>
       <?php echo get_field("sous_titre_associes"); ?>
      </div>
      <!-- ./titre-part -->
      <div class="col-md-12">
       
        <div class="row">
          <!-- table-assoc -->
          <div class="table-assoc">
            <?php if(have_rows("les_associes")): ?>
            <?php while(have_rows("les_associes")): the_row();?>
            <div class="mid-part">
              <div class="box">
                <div class="intern-bloc-half">
                  <div class="img_ctnr" style="background-image:url('<?php echo get_sub_field("photo"); ?>');">
                    
                  </div>
                  <div class="ctnctnr">
                    <h4><?php echo get_sub_field("question"); ?></h4>
                    <?php echo get_sub_field("reponse"); ?>
                  </div>
                </div>
                <div class="intern-bloc-half">
                  <div class="contenu">
                    <h3><?php echo get_sub_field("nom_associe") ?></h3>
                    <?php echo get_sub_field("details") ?>
                    <div class="rs-part">
                      <ul>
                        <li><a href="mailto:<?php echo get_sub_field('mail') ?>"><img src="<?php echo bloginfo("template_url"); ?>/images/mail.png" alt=""></a></li>
                        <li><a href="<?php echo get_sub_field('linkedin') ?>" target="_blank"><img src="<?php echo bloginfo("template_url"); ?>/images/linkedin-app.png" alt=""></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile;endif; ?>
          </div>
          <!-- ./table-assoc -->
        </div>
        

      </div>
    </div>
  </div>
</section>
<!-- ./section associes -->