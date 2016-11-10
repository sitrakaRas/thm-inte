<?php /* Template Name: Mention */ ?>
<?php
global $post;
?>

<?php get_header(); ?>
<section id="tophead">
  <div class="container-fluid">
    <div class="row">
      <div class="headbloc">          
        <div class="leftbloc">
          <h1>Legal notice</h1>
        </div>
        <div class="rightbloc">
          <img src="<?php echo get_bloginfo("template_url") ?>/images/legale.png" alt="">
        </div>
      </div>        
    </div>
    
    
    <div class="block-contenu">
    	<?php echo $post->post_content; ?>
    </div>
  </div>
  
</section>
<?php get_footer();