<?php /* Template Name: Accueil */ ?>
<?php
global $post;
?>

<?php get_header(); ?>
<?php get_template_part( 'template-parts/section', 'slidertop' ); ?>
<?php get_template_part( 'template-parts/section', 'offre' ); ?>
<?php get_template_part( 'template-parts/section', 'client' ); ?>
<?php get_template_part( 'template-parts/section', 'video' ); ?>
<?php get_template_part( 'template-parts/section', 'lastactu' ); ?>
<?php get_template_part( 'template-parts/section', 'partenaire' ); ?>
<?php get_footer();