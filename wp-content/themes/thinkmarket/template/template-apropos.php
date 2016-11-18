<?php /* Template Name: A propos */ ?>
<?php
global $post;
?>

<?php get_header(); ?>
<?php get_template_part( 'template-parts/section', 'slidertop' ); ?>
<?php get_template_part( 'template-parts/section', 'fondamentaux' ); ?>
<?php get_template_part( 'template-parts/section', 'expertise' ); ?>
<!-- section bounce -->
<section id="bounce" class="sect-wrap bounce-wrap">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part col-md-10 col-md-offset-1">
        <h2><?php echo get_field("titre_symbole"); ?></h2>
        <?php echo get_field("sous_titre_symbole"); ?>
      </div>
      <!-- ./titre-part -->
      <div class="content-part">
        <div class="col-md-5 col-md-offset-6">
          <?php echo get_field("contenu_symbole"); ?>
        </div>            
      </div>
    </div>


  </div>
  
</section>
<!-- ./section bounce -->
<?php get_template_part( 'template-parts/section', 'associes' ); ?>
<?php get_template_part( 'template-parts/section', 'manager' ); ?>
<?php get_footer();