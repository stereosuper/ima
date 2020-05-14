<?php
/*
Template Name: Logos
*/

get_header(); 

if(isset($_GET['embed']) && $_GET['embed'] == true){ $embed = true; }else{ $embed = false; }
?>
	<div class="wrapper-blocs">
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

				<div class="bloc-content small-padding-top" id="bloc-actus">
					
						<h2><?php the_field('titre-contenu'); ?></h2>
						<?php the_content(); ?>
						
						<?php 
							$cats = get_terms('catLogo');
							foreach ($cats as $cat){
								$loop = new WP_Query( array( 'post_type' => 'logos', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'catLogo', 'field' => 'slug', 'terms' => $cat->slug ) )) ); 
								if ( $loop->have_posts() ) :
						?>

							<h3>logos <?php if($cat->slug != 'groupe'){echo 'métiers ';} echo '"' . $cat->name . '"'; ?></h3>
							
							<ul class="slider-logos">
								<?php 
									while ( $loop->have_posts() ) : $loop->the_post();
									$id = get_post_thumbnail_id(); $thumb = wp_get_attachment_image($id, 'medium', true);
								?>

								<li>
									<a href="<?php the_field('logoZip'); ?>" class="bloc-slider-logos" target='_blank'>
										<span class="title-slider-logos"><span class="fond-title-slider-logos"></span><span class="content-title-slider-logos"><?php the_title(); ?></span></span>
										<span class="container-img-slider-logos"><?php echo $thumb; ?></span>
										<span class="telecharger-logo-bloc"> <span class="container-fond-telecharger-logo-bloc"> <span class="fond-telecharger-logo-bloc"></span> </span> <span class="txt-telecharger-logo-bloc">Télécharger</span></span>
										<span class="icon-download"></span>
									</a>
								</li>

								<?php endwhile; ?>
							</ul>

						<?php endif; wp_reset_query(); }?>
						
				</div>

		</div>
		

	</div><!-- #primary .content-area -->

	</section>

</div>
</section>
	
	<?php if($embed == false){ ?>
		<div id="bloc-fond-visu">
			<div id="fond-couleur-bloc-visu"></div>
			<div class="container" id="container-bloc-visu-content">
				<div class="bloc-content bloc-visu-content">
					<div id="fond-bloc-visu"  <?php if(!has_post_thumbnail()) echo "class='no-img'"; ?>>
						<?php the_post_thumbnail('full'); ?>
 					</div>
				</div>
			</div>
		</div>
	<?php } ?>



		<?php include('includes/sitemap.php'); ?>

		<?php if($embed == true){ ?>
			<div id="etiquette"></div>
		<?php } ?>

	<?php endwhile; ?>

<?php endif; ?>


<?php get_footer(); ?>