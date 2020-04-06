<?php
/*
    Template Name: Secteurs
*/

get_header();

?>
	<div id="c-secteurs" class="wrapper-blocs">
			<div id="fond-bloc-visu" class="c-secteurs__hero-image" <?php if ( has_post_thumbnail() ) { $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true); ?>
		style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center center; background-size: cover;"
 		<?php } ?>></div>
		<!-- <div class="ribbon ribbon-bleu">
			<div class="fond-ribbon"></div>
			<div class="ribbon-content">
				<?php
					// if ( function_exists('yoast_breadcrumb') ) {
					// 	$breadcrumbs = yoast_breadcrumb( '<ul class="breadcrumb"><li>', '</li></ul>', false );
					// 	$cleanBreadcrumbs = str_replace('<span prefix="v: http://rdf.data-vocabulary.org/#">', ' ', $breadcrumbs);
					// 	str_replace( '</span> › <span typeof="v:Breadcrumb">', '</li><li>', $cleanBreadcrumbs );
					// 	$breadLi = str_replace( '</span> › <span typeof="v:Breadcrumb">', '</li><li>', $cleanBreadcrumbs );
					// 	$breadSpan = str_replace( '<span typeof="v:Breadcrumb">', ' ', str_replace( '</span>', ' ', $breadLi ) );
					// 	echo str_replace( 'strong', 'h1', $breadSpan );
					// }
				?>
			</div>
		</div>

		<div class="ribbon-copie">
			<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
			<div class="ribbon-content"></div>
		</div> -->


        <div class="bloc-full bloc-penche c-secteurs__promise" id="zone-actus">
			<?php //if ( have_posts() ) : ?>
				<?php //while ( have_posts() ) : the_post(); ?>
				<!-- <div class="fond-bloc"></div> -->

				<div class="bloc-content intro-home">
                    <h1 class="c-secteurs__promise-title"><?php the_title(); ?></h1>
                    <div class="c-secteurs__promise-content c-secteurs__promise-content--first-part">
                        <?php the_field('intro_first_part');?>
                    </div>
                    <div class="c-secteurs__promise-content c-secteurs__promise-content--second-part">
                        <?php the_field('intro_second_part');?>
                    </div>
                </div>
        </div>

        <?php if( have_rows('liste_vignettes') ): ?>
            <div class="c-secteurs__thumbnails">
                <?php while ( have_rows('liste_vignettes') ) : the_row();
                    $image = get_sub_field('image');
                    $lien = get_sub_field('lien');
                ?>
                    <a class="c-thumbnail__link" href='<?php echo $lien['url']; ?>'>
                        <div class="c-thumbnail__link-image" style='background-image: url(<?php echo esc_url($image['url']); ?>)'></div>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if(have_rows('subpages')): ?>
            <div class="bloc-full c-secteurs__sections">
                <!-- <div class="bloc-content with-bg"> -->
                <?php 
                    while (have_rows('subpages')) : the_row();
                    $image = get_sub_field('image');
                ?>
                    <div class="c-secteurs__section">
                        <div class="secteur-image c-secteurs__section-image" style='background-image: url(<?php echo esc_url($image['url']); ?>)'></div>
                        <div class="secteur-text c-secteurs__section-content">
                            <h2 class="c-secteurs__section-title"><?php the_sub_field('titre'); ?></h2>
                            <div class="c-secteurs__section-text">
                                <?php the_sub_field('texte'); ?>
                            </div>
                            <!-- <a href='<?php // the_sub_field('lien'); ?>' class='btn-actu'><span>En savoir plus</span></a> -->
                        </div>
                    </div>
                <?php endwhile; ?>
                <!-- </div> -->
            </div>
        <?php endif; ?>

        <h2 class="titre-clients"><?php the_field('titre_clients'); ?></h2>

        <?php 
            // check if the repeater field has rows of data
            if( have_rows('clients') ):
        ?>
        <div class="clients">
        <?php while ( have_rows('clients') ) : the_row();?>
            <div class="logo-client">
                <?php echo wp_get_attachment_image( get_sub_field('logo'), 'full' ); ?>
            </div>
        <?php endwhile; ?>
        </div>
        <?php endif; ?>


	</div><!-- #primary .content-area -->

	</section>
</div>
</section>

		<?php include('includes/sitemap.php'); ?>


	<?php //endwhile; ?>

<?php //endif; ?>


<?php get_footer(); ?>
