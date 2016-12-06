<?php 
	$args = array( 'post_type' => 'footer' );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();		
		if( get_the_title() == 'footer'):
?>
 <!-- section contact -->
    <section id="contact-part" class="sect-wrap blanc">
      <div class="container-fluid">
        <div class="row">
          <!-- titre-part -->
          <div class="titre-part col-md-6 col-md-offset-3">
            <a href="#"><?php echo get_field('section_titre'); ?></a>
            <p><?php echo get_field('sous_titre'); ?></p>
          </div>
          <!-- ./titre-part -->
          <!-- contact-wrapper -->
          <div class="contact-wrapper">
            <a class="mail-contact" href="mailto:<?php echo get_field('email'); ?>"><?php echo get_field('email'); ?></a>
            <div class="rs">
              <ul>
				
				<?php 
					if( have_rows('reseau_sociaux') ):
					 	// loop through the rows of data
					    while ( have_rows('reseau_sociaux') ) : the_row();
							?>
							<li><a href="<?php echo get_sub_field('lien_reseau_sociaux'); ?>" target="_blank"><img src="<?php echo get_sub_field('icone_reseau_sociaux') ?>" alt=""></a></li>
							<?php

					    endwhile;

					endif;
				 ?>
              </ul>
            </div>

          </div>
          <!-- ./contact-wrapper -->
        </div>
      </div>
    </section>
    <!-- ./section contact -->
    <!-- section map -->
    <section id="map">
      <div id="map-wrapper">
        <p>map</p>
      </div>
    </section>
   
	
	<script>
		function initMap() {
	        var uluru = {lat: <?php echo get_field("map_lat"); ?>, lng: <?php echo get_field("map_long"); ?>};
	        var map = new google.maps.Map(document.getElementById('map-wrapper'), {
	          zoom: 15,
	          center: uluru,
            scrollwheel: false,
            draggable: true,
            styles : [
                      {
                          "featureType": "water",
                          "elementType": "geometry",
                          "stylers": [
                              {
                                  "color": "#e9e9e9"
                              },
                              {
                                  "lightness": 17
                              }
                          ]
                      },
                      {
                          "featureType": "landscape",
                          "elementType": "geometry",
                          "stylers": [
                              {
                                  "color": "#f5f5f5"
                              },
                              {
                                  "lightness": 20
                              }
                          ]
                      },
                      {
                          "featureType": "road.highway",
                          "elementType": "geometry.fill",
                          "stylers": [
                              {
                                  "color": "#ffffff"
                              },
                              {
                                  "lightness": 17
                              }
                          ]
                      },
                      {
                          "featureType": "road.highway",
                          "elementType": "geometry.stroke",
                          "stylers": [
                              {
                                  "color": "#ffffff"
                              },
                              {
                                  "lightness": 29
                              },
                              {
                                  "weight": 0.2
                              }
                          ]
                      },
                      {
                          "featureType": "road.arterial",
                          "elementType": "geometry",
                          "stylers": [
                              {
                                  "color": "#ffffff"
                              },
                              {
                                  "lightness": 18
                              }
                          ]
                      },
                      {
                          "featureType": "road.local",
                          "elementType": "geometry",
                          "stylers": [
                              {
                                  "color": "#ffffff"
                              },
                              {
                                  "lightness": 16
                              }
                          ]
                      },
                      {
                          "featureType": "poi",
                          "elementType": "geometry",
                          "stylers": [
                              {
                                  "color": "#f5f5f5"
                              },
                              {
                                  "lightness": 21
                              }
                          ]
                      },
                      {
                          "featureType": "poi.park",
                          "elementType": "geometry",
                          "stylers": [
                              {
                                  "color": "#dedede"
                              },
                              {
                                  "lightness": 21
                              }
                          ]
                      },
                      {
                          "elementType": "labels.text.stroke",
                          "stylers": [
                              {
                                  "visibility": "on"
                              },
                              {
                                  "color": "#ffffff"
                              },
                              {
                                  "lightness": 16
                              }
                          ]
                      },
                      {
                          "elementType": "labels.text.fill",
                          "stylers": [
                              {
                                  "saturation": 36
                              },
                              {
                                  "color": "#333333"
                              },
                              {
                                  "lightness": 40
                              }
                          ]
                      },
                      {
                          "elementType": "labels.icon",
                          "stylers": [
                              {
                                  "visibility": "off"
                              }
                          ]
                      },
                      {
                          "featureType": "transit",
                          "elementType": "geometry",
                          "stylers": [
                              {
                                  "visibility": "simplified"
                              },
                              {
                                  "color": "#f2f2f2"
                              },
                              {
                                  "lightness": 19
                              }
                          ]
                      },
                      {
                          "featureType": "transit.station",
                          "elementType": "all",
                          "stylers": [
                              {
                                  "lightness": 19
                              },
                              {
                                  "visibility": "on"
                              }
                          ]
                      },
                      {
                          "featureType": "administrative",
                          "elementType": "geometry.fill",
                          "stylers": [
                              {
                                  "color": "#fefefe"
                              },
                              {
                                  "lightness": 20
                              }
                          ]
                      },
                      {
                          "featureType": "administrative",
                          "elementType": "geometry.stroke",
                          "stylers": [
                              {
                                  "color": "#fefefe"
                              },
                              {
                                  "lightness": 17
                              },
                              {
                                  "weight": 1.2
                              }
                          ]
                      }
                  ]
	        });
	        var marker = new google.maps.Marker({
	          position: uluru,
	          map: map,
            icon: '<?php blogInfo("template_url"); ?>/images/pin.png'
	        });

          var transitLayer = new google.maps.TransitLayer();
          transitLayer.setMap(map);
    }
	    
	</script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq8i_6xZ1RHvXHw0l0_Lrrwsyf4oI0SAs&callback=initMap"
        async defer></script>

	


    <!-- ./section map -->
    <!-- footer-link -->
    <section id="footer-link">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-1"></div>
          <!-- block-footer -->

          <?php 
          	if( have_rows('block_adresse') ):
			 	// loop through the rows of data
			    while ( have_rows('block_adresse') ) : the_row();

					if( get_sub_field('type_adresse') == 1){
						$class = "bloc-footer-type-one";
					}else{
						$class = "bloc-footer-type-two";
					}

          ?>
          <div class="col-md-2 col-xs-6 text-sm-left">
            <div class="bloc-footer <?php echo $class; ?>">
              <?php if(get_sub_field('type_adresse') == 1): ?>
              <h3><?php echo get_sub_field("titre_adresse"); ?></h3>
          	  <?php endif; ?>
              <div class="logo">
                <a href="#"><img src="<?php echo get_sub_field("logo_adresse"); ?>" alt=""></a>
              </div>
              <div class="adresse">
                <ul>
                  <li>
                    <?php echo get_sub_field("adresse_part_1") ?>
                  </li>
                  <li>
                    <?php echo get_sub_field("adresse_part_2") ?>
                    
                  </li>
                </ul>
              </div>
            </div>
          </div>
		  <?php
			    endwhile;
			endif;
		  ?>
          <!-- ./block-footer -->         
        </div>
        
      </div>
    </section>
    <!-- ./footer-link -->
    <section id="second-link">
      <div class="container-fluid">
        <ul>
          <li>© 2016 THINKMARKET</li>
        </ul>
        <?php 
        	$args = array(
            	'theme_location' => 'mentions_menu',
            	'container'=> false, 
            	'menu_class'=> false
            );
            wp_nav_menu( $args );
        ?>
        <?php 
        	$args = array(
            	'theme_location' => 'footer_menu',
            	'container'=> false, 
            	'menu_class'=> 'lien-footer'
            );
            wp_nav_menu( $args );
        ?>
      </div>
      
    </section>

<?php 
		endif;
	endwhile; 
?>

<?php wp_footer(); ?>
</body>
</html>