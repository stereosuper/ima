<?php
/*
    Template Name: Secteurs
*/

get_header();

?>
	<div class="wrapper-blocs">
			<div id="fond-bloc-visu" <?php if ( has_post_thumbnail() ) { $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true); ?>
		style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center center; background-size: cover;"
 		<?php } ?>>
 	</div>
		<div class="ribbon ribbon-bleu">
			<div class="fond-ribbon"></div>
			<div class="ribbon-content">
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						$breadcrumbs = yoast_breadcrumb( '<ul class="breadcrumb"><li>', '</li></ul>', false );
						$cleanBreadcrumbs = str_replace('<span prefix="v: http://rdf.data-vocabulary.org/#">', ' ', $breadcrumbs);
						str_replace( '</span> › <span typeof="v:Breadcrumb">', '</li><li>', $cleanBreadcrumbs );
						$breadLi = str_replace( '</span> › <span typeof="v:Breadcrumb">', '</li><li>', $cleanBreadcrumbs );
						$breadSpan = str_replace( '<span typeof="v:Breadcrumb">', ' ', str_replace( '</span>', ' ', $breadLi ) );
						echo str_replace( 'strong', 'h1', $breadSpan );
					}
				?>
			</div>
		</div>

		<div class="ribbon-copie">
			<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
			<div class="ribbon-content"></div>
		</div>


        <div class="bloc-full bloc-penche" id="zone-actus">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

				<div class="fond-bloc"></div>

				<div class="bloc-content intro-home">
                    <div>
                        <?php the_field('intro');?>
                    </div>
                </div>

        </div>

        <?php 
            // check if the repeater field has rows of data
            if( have_rows('subpages') ):
        ?>
        <div class="list-subpage">
        <?php while ( have_rows('subpages') ) : the_row();
            $image = get_sub_field('image');
        ?>
            <a href='<?php the_sub_field('lien'); ?>'>
                <div style='background-image: url(<?php echo esc_url($image['url']); ?>)'></div>
            </a>

        <?php endwhile; ?>

        
        </div>
        <?php endif; ?>


        <?php 
            // check if the repeater field has rows of data
            if( have_rows('subpages') ):
        ?>
        <div class="bloc-full">
            <div class="bloc-content with-bg">
        <?php while ( have_rows('subpages') ) : the_row();
            $image = get_sub_field('image');
        ?>
            <div class="secteur-item">
                <div class="secteur-image" style='background-image: url(<?php echo esc_url($image['url']); ?>)'></div>
                <div class="secteur-text">
                    <h2><?php the_sub_field('titre'); ?></h2>
                    <?php the_sub_field('texte'); ?>
                    <a href='<?php the_sub_field('lien'); ?>' class='btn-actu'><span>En savoir plus</span></a>
                </div>
            </div>
        <?php endwhile; ?>
            </div>
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


	<?php endwhile; ?>

<?php endif; ?>


<?php get_footer(); ?>
