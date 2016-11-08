<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- main-nav -->
    <div class="main-nav">
      <div class="container-fluid">

        <!-- Static navbar -->
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src=" <?php bloginfo("template_url"); ?>/images/logo-top.png" alt=""></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
            <?php 
	            $args = array(
	            	'theme_location' => 'primary',
	            	'menu_class' => 'nav navbar-nav navbar-right'
	            );
	            wp_nav_menu( $args ); 
            ?>

            </div><!--/.nav-collapse -->
          </div><!--/.container-fluid -->
        </nav>

      </div>
    </div>
    <!-- ./main-nav -->

