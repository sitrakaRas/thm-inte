<?php wp_reset_query(); ?>
<section id="slidervideo">
  <div class="slidervideoctnr">
  <?php if(have_rows("slider_video")): ?>
  <?php   while(have_rows("slider_video")): the_row();?>
  <!-- items -->
    <div class="items">
      <div class="col-md-12">
        <div class="row">
          <video class="video-play" preload="none" loop autoplay>
            <source src="<?php echo get_sub_field("fichier_video"); ?>" type="video/mp4" />
          </video>  
          <div class="content col-md-4 col-md-offset-7">
            <h3><a href="<?php echo get_field("lien_vers_nous_rejoindre"); ?>">join the shift</a></h3>
            <p><?php echo get_sub_field("resume") ?></p>
            <div class="auteur">
              <p><strong><?php echo get_sub_field("nom_et_prenom"); ?></strong></p>
              <span><?php get_sub_field("poste_personne"); ?></span>
            </div>
          </div>         
        </div>
       
      </div>
    </div>
  <!-- ./items -->
  <?php endwhile;endif; ?>
  </div>
  <!-- bottom-link -->
  <div class="col-md-12 bottom-link bleu">
    <div class="link-ctnr">
      <a href="<?php echo get_field("lien_vers_nous_rejoindre"); ?>">Nous rejoindre</a>
    </div>
  </div>
  <!-- ./bottom-link -->
</section>