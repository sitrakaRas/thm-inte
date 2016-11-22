<!-- section recrute -->
<section id="recrute" class="sect-wrap">
  <div class="container-fluid">
    <div class="row">
      <!-- titre-part -->
      <div class="titre-part">
        <h2><?php echo get_field("titre_recrute"); ?></h2>
        <?php echo get_field("sous_titre_recrute"); ?>
      </div>
      <!-- ./titre-part -->
      <!-- recrute-wrapper -->
      <div class="recrute-wrapper">
        <?php if(have_rows("block_recrute")): ?>
        <?php  while(have_rows("block_recrute")): the_row();?>
        <div class="col-md-4">
          <div class="block">
            <h3><?php echo get_sub_field("titre_block");?></h3>
            <?php echo get_sub_field("contenu_block"); ?> 
          </div>
        </div>

      <?php endwhile;endif; ?>
      </div>
      <!-- ./recrute-wrapper -->
    </div>
  </div>
  
</section>
<!-- ./section recrute -->