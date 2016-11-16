<section id="citation">
  <div class="titre text-center"><h2><?php echo get_field("titre_citation") ?></h2></div>
  <div class="citation-ctn col-md-10 col-md-offset-1">
    <div class="row">
      <div class="contenu">
        <p><?php echo get_field("contenu_citation")  ?></p>
      </div>
      <span class="auteur"><?php echo get_field("auteur_citation") ?>, <span><?php echo get_field("societe"); ?></span></span>
    </div> 
  </div>
  <div class="clearfix"></div>

</section>