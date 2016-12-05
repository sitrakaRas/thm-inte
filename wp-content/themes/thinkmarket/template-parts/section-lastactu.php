<?php wp_reset_query(); ?>
<?php global $post; ?>
<!-- section dernieres- actus -->
<section id="last-actu" class="sect-wrap rose homesection">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part col-md-6 col-md-offset-3">
        <a href="<?php echo the_field("lien_vers_actus","option"); ?>"><?php echo the_field("titre_section_actus","option"); ?></a>           
      </div>
      <!-- ./titre-part -->

      <?php
        $args = array(
          'numberposts' => 2,
          'post_type' => 'actualite',
          'post_status' => 'publish'
        );

        $recent_posts = wp_get_recent_posts($args,OBJECT);
      ?>

      <!-- actu-wrapper -->
      <div class="actu-wrapper">
        <div class="col-md-8">
          <div class="row">
        <?php foreach ($recent_posts as $actu) {
          $categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
         ?>
       
        
          
           <!-- actu-bloc -->
            <div class="col-md-6">
              <div class="actu-bloc actuH">
                <div class="img-block" style="background-image: url('<?php echo get_the_post_thumbnail_url($actu->ID,"large") ?>');">                
                </div>
                <div class="text-actu">
                  <h3><a href="#"><?php echo $categ[0]->name; ?></a></h3>
                  <p>écrit par <?php echo get_field('auteur_article',$actu->ID); ?></p>
                  <a href="<?php echo get_post_permalink($actu->ID); ?>"><?php echo wp_trim_words( $actu->post_title , $num_words = 8, $more = '… ' ); ?></a>
                  <div class="link-more">
                    <a href="<?php echo get_post_permalink($actu->ID); ?>">lire la suite</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- ./actu-bloc -->
         
        
        
        <?php } ?>
         </div>
        </div>
        <!-- twitter block -->
        <div class="col-md-4">
          <div class="twitter-block actuH">
            <h3><a href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" target="_blank">nos tweets</a></h3>
            <div class="listing">
              <!-- listing feed tweet -->
             <a class="twitter-timeline" href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" data-show-replies="false"  data-aria-polite="assertive"data-chrome="nofooter noborders noheader transparent" data-tweet-limit="4"><?php the_field('id_twitter', 'option'); ?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="link-more">
              <a href="#">twitter</a>
            </div>
          </div>             
        </div>
        <!-- ./twitter block -->
      </div>
      <!-- ./actu-wrapper -->
      <!-- bottom-link -->
      <div class="col-md-12 bottom-link bleu">
        <div class="link-ctnr">
          <a href="<?php echo the_field("lien_vers_actus","option"); ?>">toute notre actualité</a>
        </div>
      </div>
      <!-- ./bottom-link -->
    </div>
  </div>     
</section>
<!-- ./section dernieres- actus -->