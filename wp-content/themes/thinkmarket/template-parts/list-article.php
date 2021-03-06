 <!-- actu-bloc -->
<?php  
if(isset($_GET["term_id"])){
  $term_id = $_GET["term_id"];
  $filtre = true;
}

$link_actu = get_the_permalink(wp_get_post_by_template("template/template-actualite.php"));

$total = count(CActualite::getAll());
 ?>
<input type="hidden" class="old_number" value="0">
<?php 
  if($filtre):
  $actualites = CActualite::getAll();
?>
  <input type="hidden" class="term_id" value="<?php echo $term_id; ?>">
  
    <?php 
      $i = 0;
      $true_total = 0;
    ?>
    <?php foreach ($actualites as $key => $actu) {
      $categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
            if($term_id == $categ[0]->term_id):
              if($i != 2):
              ?>
              <div class="col-md-4 all <?php echo $categ[0]->slug; ?>" data-offset="<?php echo $key; ?>" data-count="<?php echo $total; ?>">
                  <div class="actu-bloc">
                    <a href="<?php echo $actu->permalink; ?>">
                      <div class="img-block" style="background-image: url('<?php echo get_the_post_thumbnail_url($actu->ID,"large") ?>');">                
                        </div>
                    </a>
                      
                      <div class="text-actu">
                          <h3><a href="<?php echo $link_actu.'?term_id='.$term_id; ?>"><?php echo $categ[0]->name; ?></a></h3>
                          <p>&Eacute;crit par <?php echo get_field('auteur_article',$actu->ID); ?></p>
                          <a href="<?php echo $actu->permalink; ?>"><?php echo $actu->titre; ?></a>
                          <div class="summary">
                              <p><?php echo get_the_excerpt($actu->ID); ?></p>
                          </div>
                          
                      </div>
                      <div class="bottom-link">
                        <div class="link-more">
                              <a href="<?php echo $actu->permalink; ?>">lire la suite</a>
                          </div>
                      </div>
                  </div>
              </div>            
              <?php
              else :
            ?>
            <!-- twitter block -->
                    <div class="col-md-4 bltw desktop-tweet">
                        <div class="twitter-block">
                            <h3><a href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" target="_blank">nos tweets</a></h3>
                            <div class="listing">
                               <a class="twitter-timeline" href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" data-show-replies="false"  data-aria-polite="assertive"data-chrome="nofooter noborders noheader transparent" data-tweet-limit="5"><?php the_field('id_twitter', 'option'); ?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                            </div>
                        </div>     
                        <div class="bottom-link">
                          <div class="link-more">
                                <a href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" target="_blank">tweet</a>
                            </div> 
                        </div>   
                    </div>
                    <!-- ./twitter block -->
                    <div class="col-md-4 all <?php echo $categ[0]->slug; ?>" data-offset="<?php echo $key; ?>" data-count="<?php echo $total; ?>">
                        <div class="actu-bloc">
                          <a href="<?php echo $actu->permalink; ?>">
                            <div class="img-block" style="background-image: url('<?php echo get_the_post_thumbnail_url($actu->ID,"large") ?>');">                
                              </div>
                          </a>
                            
                            <div class="text-actu">
                                <h3><a href="<?php echo $link_actu.'?term_id='.$term_id; ?>"><?php echo $categ[0]->name; ?></a></h3>
                                <p>&Eacute;crit par <?php echo get_field('auteur_article',$actu->ID); ?></p>
                                <a href="<?php echo $actu->permalink; ?>"><?php echo $actu->titre; ?></a>
                                <div class="summary">
                                    <p><?php echo get_the_excerpt($actu->ID); ?></p>
                                </div>
                                
                            </div>
                            <div class="bottom-link">
                              <div class="link-more">
                                    <a href="<?php echo $actu->permalink; ?>">lire la suite</a>
                                </div>
                            </div>
                        </div>
                    </div>      
              <?php
              endif;
              $i++;
            endif;
            // if($i == 4):
            //   break;
            // endif;
          } ?>

<?php 
  else:
  $actualites = CActualite::getAll(5);
?>

    <?php $i = 0 ?>
    <?php foreach ($actualites as $key => $actu) {
      $categ = wp_get_post_terms($actu->ID, 'category', array("fields" => "all"));
      if($i != 2):
      ?>
      <div class="col-md-4 all <?php echo $categ[0]->slug; ?>" data-offset="<?php echo $key; ?>" data-count="<?php echo $total; ?>">
          <div class="actu-bloc">
            <a href="<?php echo $actu->permalink; ?>">
              <div class="img-block" style="background-image: url('<?php echo get_the_post_thumbnail_url($actu->ID,"large") ?>');">                
                </div>
            </a>
              
              <div class="text-actu">
                  <h3><a href="<?php echo $link_actu.'?term_id='.$categ[0]->term_id; ?>"><?php echo $categ[0]->name; ?></a></h3>
                  <p>&Eacute;crit par <?php echo get_field('auteur_article',$actu->ID); ?></p>
                  <a href="<?php echo $actu->permalink; ?>"><?php echo $actu->titre; ?></a>
                  <div class="summary">
                      <p><?php echo get_the_excerpt($actu->ID); ?></p>
                  </div>
                  
              </div>
              <div class="bottom-link">
                <div class="link-more">
                      <a href="<?php echo $actu->permalink; ?>">lire la suite</a>
                  </div>
              </div>
          </div>
      </div>            
      <?php
      else :
    ?>
    <!-- twitter block -->
            <div class="col-md-4 bltw desktop-tweet">
                <div class="twitter-block">
                    <h3><a href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" target="_blank">nos tweets</a></h3>
                    <div class="listing">
                       <a class="twitter-timeline" href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" data-show-replies="false"  data-aria-polite="assertive"data-chrome="nofooter noborders noheader transparent" data-tweet-limit="5"><?php the_field('id_twitter', 'option'); ?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>     
      <div class="bottom-link">
                  <div class="link-more">
                        <a href="https://twitter.com/<?php the_field('id_twitter', 'option'); ?>" target="_blank">tweet</a>
                    </div> 
                </div>   
            </div>
            <!-- ./twitter block -->
            <div class="col-md-4 all <?php echo $categ[0]->slug; ?>" data-offset="<?php echo $key; ?>" data-count="<?php echo $total; ?>">
                <div class="actu-bloc">
                  <a href="<?php echo $actu->permalink; ?>">
                    <div class="img-block" style="background-image: url('<?php echo get_the_post_thumbnail_url($actu->ID,"large") ?>');">                
                      </div>
                  </a>
                    
                    <div class="text-actu">
                        <h3><a href="<?php echo $link_actu.'?term_id='.$categ[0]->term_id; ?>"><?php echo $categ[0]->name; ?></a></h3>
                        <p>&Eacute;crit par <?php echo get_field('auteur_article',$actu->ID); ?></p>
                        <a href="<?php echo $actu->permalink; ?>"><?php echo $actu->titre; ?></a>
                        <div class="summary">
                            <p><?php echo get_the_excerpt($actu->ID); ?></p>
                        </div>
                        
                    </div>
                    <div class="bottom-link">
                      <div class="link-more">
                            <a href="<?php echo $actu->permalink; ?>">lire la suite</a>
                        </div>
                    </div>
                </div>
            </div>      
      <?php
      endif;
            $i++;
          } ?>

<?php endif; ?>