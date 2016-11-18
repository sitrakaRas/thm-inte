<!-- section manager -->
<section id="manager" class="sect-wrap">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part col-md-10 col-md-offset-1">
        <h2><?php echo get_field("titre_section") ?></h2>          
      </div>

      <div class="manager-part">
        <div class="col-md-12">
          <div class="row">
            <?php if(have_rows("block_manager")): ?>
            <?php while(have_rows("block_manager")): the_row();?>
            <div class="col-md-3">
              <!-- case -->
              <div class="case">
                <!-- block-manager -->
                <div class="block-manager">
                  <div class="image">
                    <img src="<?php echo get_sub_field("portrait") ?>" alt="">
                  </div>
                  <div class="content">
                    <p><?php echo get_sub_field("citation_manager") ;?></p>
                    <ul>
                      <li><a href="mailto:<?php echo get_sub_field("mail_manager") ?>"><img src="<?php echo bloginfo("template_url") ?>/images/mail.png" alt=""></a></li>
                      <li><a href="<?php echo get_sub_field("linkedin_manager") ?>"><img src="<?php echo bloginfo("template_url") ?>/images/linkedin-app.png" alt=""></a></li>
                    </ul>
                  </div>
                </div>
                <!-- ./block-manager -->
                <!-- block-name -->
                <div class="block-name">
                  <div class="name"><?php echo get_sub_field("nom_manager") ;?></div>
                  <div class="poste"><?php echo get_sub_field("poste_manager") ;?></div>
                </div>
                <!-- ./block-name -->
              </div>
              <!-- ./case -->
            </div>
          <?php endwhile;endif; ?>
            
          </div>
        </div>

        
      </div>
    </div>
    <!-- bottom-link -->
  <div class="col-md-12 bottom-link bleu">
    <div class="link-ctnr">
      <a href="<?php echo get_field("lien_vers_page") ?>">Nous rejoindre</a>
    </div>
  </div>
  <!-- ./bottom-link -->
  </div>
</section>
<!-- ./section manager -->