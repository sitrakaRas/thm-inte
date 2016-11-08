 <!-- section contact -->
    <section id="contact-part" class="sect-wrap blanc">
      <div class="container-fluid">
        <div class="row">
          <!-- titre-part -->
          <div class="titre-part col-md-6 col-md-offset-3">
            <a href="#">contact</a>
            <p>Un projet ou une problématique sur lesquels Thinkmarket pourrait vous accompagner ? Une simple question ? Contactez-nous.</p>
          </div>
          <!-- ./titre-part -->
          <!-- contact-wrapper -->
          <div class="contact-wrapper">
            <a class="mail-contact" href="mailto:itstimetoshift@thinkmarket.fr">itstimetoshift@thinkmarket.fr</a>
            <div class="rs">
              <ul>
                <li><a href="#"><img src="images/linkedin.png" alt=""></a></li>
                <li><a href="#"><img src="images/linkedin.png" alt=""></a></li>
                <li><a href="#"><img src="images/linkedin.png" alt=""></a></li>
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
      <div class="map-wrapper">
        <p>map</p>
      </div>
    </section>
    <!-- ./section map -->
    <!-- footer-link -->
    <section id="footer-link">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-1"></div>
          <!-- block-footer -->
          <div class="col-md-2">
            <div class="bloc-footer bloc-footer-type-one">
              <h3>adresse</h3>
              <div class="logo">
                <a href="#"><img src="images/footer-park.png" alt=""></a>
              </div>
              <div class="adresse">
                <ul>
                  <li>
                    <p>Parking Alhambra</p>
                    <p>50 Rue de malte, 75011 Paris</p>
                  </li>
                  <li>
                    <p>Parking Zenpark</p>
                    <p>15 Rue Bichat, 75010 Paris</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- ./block-footer -->
          <!-- block-footer -->
          <div class="col-md-2">
            <div class="bloc-footer bloc-footer-type-one">
              <h3>adresse</h3>
              <div class="logo">
                <a href="#"><img src="images/footer-park.png" alt=""></a>
              </div>
              <div class="adresse">
                <ul>
                  <li>
                    <p>Parking Alhambra</p>
                    <p>50 Rue de malte, 75011 Paris</p>
                  </li>
                  <li>
                    <p>Parking Zenpark</p>
                    <p>15 Rue Bichat, 75010 Paris</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- ./block-footer -->
          <!-- block-footer -->
          <div class="col-md-2">
            <div class="bloc-footer bloc-footer-type-two">
              <div class="logo">
                <a href="#"><img src="images/velib.png" alt=""></a>
              </div>
              <div class="adresse">
                <ul>
                  <li>
                    <p>Parking Alhambra</p>
                    <p>50 Rue de malte, 75011 Paris</p>
                  </li>
                  <li>
                    <p>Parking Zenpark</p>
                    <p>15 Rue Bichat, 75010 Paris</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- ./block-footer -->
          <!-- block-footer -->
          <div class="col-md-2">
            <div class="bloc-footer bloc-footer-type-two">
              <div class="logo">
                <a href="#"><img src="images/autolib.png" alt=""></a>
              </div>
              <div class="adresse">
                <ul>
                  <li>
                    <p>Parking Alhambra</p>
                    <p>50 Rue de malte, 75011 Paris</p>
                  </li>
                  <li>
                    <p>Parking Zenpark</p>
                    <p>15 Rue Bichat, 75010 Paris</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- ./block-footer -->
          <!-- block-footer -->
          <div class="col-md-2">
            <div class="bloc-footer bloc-footer-type-two">
              <div class="logo">
                <a href="#"><img src="images/metro.png" alt=""></a>
              </div>
              <div class="adresse">
                <ul>
                  <li>
                    <p>Parking Alhambra</p>
                    <p>50 Rue de malte, 75011 Paris</p>
                  </li>
                  <li>
                    <p>Parking Zenpark</p>
                    <p>15 Rue Bichat, 75010 Paris</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- ./block-footer -->
        </div>
        
      </div>
    </section>
    <!-- ./footer-link -->
    <section id="second-link">
      <div class="container-fluid">
        <ul>
          <li>© 2016</li>
          
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

<?php wp_footer(); ?>
</body>
</html>