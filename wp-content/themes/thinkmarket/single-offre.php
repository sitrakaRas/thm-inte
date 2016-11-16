<?php global $post; ?>
<?php get_header(); ?>
<?php get_template_part( 'template-parts/section', 'slidertop' ); ?>
<section id="single-ctn">
	<div class="container-fluid">
		<div class="row">
			<div class="titre-part">
				<h2><?php echo $post->post_title; ?></h2>
			</div>	
			<div class="offre-row">									
				<div class="dtc-l">
					<img src="<?php echo get_field('logo',$post->ID);  ?>" alt=""> 
				</div>
				<div class="dtc-r">
					<?php echo get_field('contenu',$post->ID); ?>
					
				</div>
			</div>
		</div>
	</div>

</section>

<?php get_template_part( 'template-parts/section', 'businesscase' ); ?>
<?php get_template_part( 'template-parts/section', 'citation' ); ?>
<?php get_template_part( 'template-parts/section', 'offre' ); ?>
<?php get_footer();