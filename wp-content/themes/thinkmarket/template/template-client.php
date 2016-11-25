<?php /* Template Name: Nos clients */ ?>
<?php
global $post;
?>

<?php get_header(); ?>
<?php get_template_part( 'template-parts/section', 'slidertop' ); ?>
<?php get_template_part( 'template-parts/section', 'citation' ); ?>
<?php get_template_part( 'template-parts/section', 'client' ); ?>

<?php wp_reset_query(); ?>
<!-- section offre-shifter (*realisation)   -->
<section id="shifter-part" class="sect-wrap rose realisations">
    <div class="container-fluid">
        <div class="row">
            <!-- titre-part -->
            <div class="titre-part col-md-6 col-md-offset-3">
                <a href="<?php echo get_field("lien_titre") ?>"><?php echo get_field("titre_section_o_et_r") ?></a>
            </div>
            <!-- ./titre-part -->
            <!-- wrapper-shiffter -->
            <div class="wrapper-shiffter col-md-12">
                <div class="row">
                    <!-- row-shiffter -->
                    <div class="row-shiffter slider-schifter">
                        <?php if(have_rows("items_o_et_r")): ?>
                        <?php while(have_rows("items_o_et_r")): the_row();?>
                        <!-- block-shifter -->
                        <div class="block-shifter col-md-4 col-sm-6">
                            <div class="shifter-inner">
                                <div class="shifter-content">
                                    <div class="content-wrap">
                                        <a href="#" class="link-offre">
                                            <img src="<?php echo get_sub_field("logo_o_et_r"); ?>" alt="icone">
                                        </a>                  
                                        <h3><?php echo get_sub_field("titre_item_o_et_r"); ?></h3>
                                    </div>
                                    <a href="#"></a>
                                    <div class="shifter-hover">
                                        <div class="hover-content">
                                           <?php echo get_sub_field("contenu_o_et_r"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./block-shifter -->
                      <?php endwhile;endif; ?>
                       

                    </div>
                    <!-- ./row-shiffter -->
                </div>   
            </div>
            <!-- ./wrapper-shiffter -->
        </div>
    </div>
</section>
<!-- ./section offre-shifter (*realisation)   -->

<?php get_footer();