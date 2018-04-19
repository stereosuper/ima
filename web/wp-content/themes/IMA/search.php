<?php
/*
Template Name: Search Page
*/
get_header(); ?>

	<div class="wrapper-blocs">
		<div class="bloc-full bloc-categories-articles">

				<div class="ribbon ribbon-bleu">
					<div class="fond-ribbon"></div>
					<div class="ribbon-content">
						<ul class="breadcrumb">
							<li><a href="<?php echo get_site_url(); ?>">IMATECH</a></li>
							<li><h1>Résultats de la recherche</h1></li>
						</ul>
					</div>
				</div>

				<div class="ribbon-copie">
					<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
					<div class="ribbon-content"></div>
				</div>
				<div class="fond-bloc"></div>

					<?php $posts = query_posts($query_string . '&posts_per_page=-1'); ?> 

					<?php if ( have_posts() ) : ?>	

						<?php
						    global $wp_query;
						    $results = $wp_query->found_posts;
						?>

						<div class="bloc-content small-padding-top">
							<div class="nb-resultats"><p>La recherche "<?php the_search_query(); ?>" a retourné <strong><?php echo $results; ?> résultats</strong></p></div>
						</div>
					</div>
						
					<div class="bloc-full bloc-penche article">
						<div class="fond-bloc"></div>
						<div class="bloc-content small-padding-top" id="bloc-actus">

							<ul class="liste-recherche">
							<?php while ( have_posts() ) : the_post() ?>
							 	
								<li>
							 		<p><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></p>	
										
									<?php if ( $post->post_type == 'post' ) { ?>									
										<div class="date-categ-actu">
											Le <span class="date-actu"><?php the_time( get_option( 'date_format' ) ); ?></span> dans <?php foreach((get_the_category()) as $cat) { ?><a href="<?php echo get_category_link($cat->term_id) . ' ';  ?>" class="categ-actu"><?php echo $cat->cat_name . ' ';  ?></a><?php } ?>
										</div>
									<?php } ?>
							 
									<div class="content-actu">	
										<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'your-theme' )  ); ?>
									</div>				
								</li>
							 
							<?php endwhile; ?>

							</ul>

						</div>
					</div>
					 
					<?php else : ?>

					<div class="bloc-content small-padding-top">

						<div class="nb-resultats"><p>Votre recherche "<?php the_search_query(); ?>" n'a retourné <strong>aucun résultat</strong></p></div>
						 
						<?php get_search_form(); ?>

					</div>
				</div>
					 
					<?php endif; ?>	

	</div><!-- #primary .content-area -->

	</section>

</div>
</section>

				<div id="bloc-fond-visu">					
					<div id="fond-couleur-bloc-visu"></div>
					<div class="container" id="container-bloc-visu-content"><div class="bloc-content bloc-visu-content"><div id="fond-bloc-visu"></div></div></div>
				</div>

				<?php include('includes/sitemap.php'); ?>

<?php get_footer(); ?>
