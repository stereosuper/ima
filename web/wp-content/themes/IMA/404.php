<?php
/**
 * The template for displaying any single page.
 *
 */

get_header(); ?>
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
		<div class="bloc-full bloc-penche">
				<div class="fond-bloc"></div>

				<div class="bloc-content" id="bloc-actus">

						<h2>La page est introuvable</h2>
						<p>Désolé, cette page n'existe plus ou a été déplacée. <br/>Si vous êtes perdu, vous pouvez retourner à
							<a href="<?php echo get_home_url(); ?>">l'accueil</a> ou bien faire une recherche dans le site:
							<?php get_search_form(); ?>
						</p>

				</div>

		</div>


	</div><!-- #primary .content-area -->

	</section>

</div>
</section>

<?php include('includes/sitemap.php'); ?>


<?php get_footer(); ?>
