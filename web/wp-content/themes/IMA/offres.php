<?php
/*
Template Name: Offres
*/

get_header( 'rh' ); ?>
	<div class="wrapper-blocs">
	<div class="bloc-full bloc-categories-articles">
		<div class="ribbon">
			<div class="fond-ribbon"></div>
			<div class="ribbon-content">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					$breadcrumbs      = yoast_breadcrumb( '<ul class="breadcrumb"><li>', '</li></ul>', false );
					$cleanBreadcrumbs = str_replace( '<span prefix="v: http://rdf.data-vocabulary.org/#">', ' ',
						$breadcrumbs );
					str_replace( '</span> › <span typeof="v:Breadcrumb">', '</li><li>', $cleanBreadcrumbs );
					$breadLi   = str_replace( '</span> › <span typeof="v:Breadcrumb">', '</li><li>',
						$cleanBreadcrumbs );
					$breadSpan = str_replace( '<span typeof="v:Breadcrumb">', ' ',
						str_replace( '</span>', ' ', $breadLi ) );
					echo str_replace( 'strong', 'h1', $breadSpan );
				}
				?>
			</div>
		</div>
		<?php query_posts( array( 'post_type' => 'offres', 'posts_per_page' => - 1 ) ); ?>


		<div class="ribbon-copie">
			<div class="fond-ribbon">
				<div class="ribbon-join ribbon-bleu"></div>
			</div>
			<div class="ribbon-content"></div>
		</div>

		<div class="container-fond-bloc">
			<div class="fond-bloc"></div>
		</div>
		<div class="bloc-content small-padding-top">
			<?php
			$ID      = get_the_ID();
			$current = get_permalink( $ID );

			$nbOffres = wp_count_posts( 'offres' )->publish;
			$txt1     = 'offres d’emplois';
			$txt2     = 'sont actuellement disponibles.';
			if ( $nbOffres < 1 ) {
				$nbOffres = 'Pas';
				$txt1     = "d'offres d’emplois";
				$txt2     = 'actuellement disponibles.';
			} elseif ( $nbOffres == 1 ) {
				$txt1 = 'offre d’emploi';
				$txt2 = 'est actuellement disponible.';
			}
			?>
			<div class="nb-offres"><p><strong><?php echo $nbOffres . ' ' . $txt1; ?></strong> <?php echo $txt2; ?><br/>N'hésitez
					pas à nous envoyer <a class="btn-bleu" href="<?php echo $current; ?>postuler?offre=none">votre
						candidature spontanée</a>.</p></div>
		</div>

	</div>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="bloc-full bloc-penche article">

			<div class="container-fond-bloc">
				<div class="fond-bloc"></div>
			</div>
			<div class="bloc-content small-padding-top" id="bloc-actus">

				<div class="date-categ-actu">Le <span class="date-actu"><?php echo get_the_date(); ?></span> - site
					de <?php the_field( 'offre_localisation' ); ?> </div>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<a href="<?php the_permalink(); ?>" class="btn-bloc btn-actu">
							<span class="container-fond-btn-bloc">
								<span class="fond-btn-bloc"></span>
							</span>
					<span class="txt-btn-bloc">Consulter l'offre</span>
				</a>

			</div>
		</div>


	<?php endwhile; ?>


	</div><!-- #primary .content-area -->

	</section>

	</div>

	<section id="content-right">

		<?php
		$pages = $pages = get_posts( array( 'post_type'  => 'page',
		                                    'meta_key'   => '_wp_page_template',
		                                    'meta_value' => 'postuler.php'
		) );
		foreach ( $pages as $page ) {

			$interlocuteurs = get_field( 'interlocuteur', $page->ID );

			if ( $interlocuteurs ) {
				foreach ( $interlocuteurs as $i ) {
					?>
					<div id="bloc-interlocuteur">
					<span class="categ-bloc-interlocuteur">
						<span class="container-fond-categ-bloc-interlocuteur">
							<span class="fond-categ-bloc-interlocuteur"></span>
						</span>
						<span class="container-photo-bloc-interlocuteur">
							<?php if ( get_field( 'interlocuteur_img', $i->ID ) ) {
								?>
								<span class="fond-photo-bloc-interlocuteur">
									<img src="<?php echo get_field( 'interlocuteur_img', $i->ID )['sizes']['thumbnail']; ?>" alt="<?php echo get_field( 'interlocuteur_img', $i->ID )['alt']; ?>"/>
								</span>
							<?php } ?>
						</span>
						<span class="txt-categ-bloc-interlocuteur">Votre&nbsp;interlocuteur</span>
					</span>
					<span class="container-fond-bloc-deform-interlocuteur">
						<span class="fond-bloc-deform-interlocuteur"></span>
					</span>
					<span class="txt-bloc-deform-interlocuteur">
						<h3><?php the_field( 'interlocuteur_nom', $i->ID ); ?></h3>
						<ul class="contact-bloc-interlocuteur">
						<?php if ( get_field( 'interlocuteur_tel', $i->ID ) ) { ?>
							<li class="has-icon">
							<div class="icon-telephone"></div><?php the_field( 'interlocuteur_tel', $i->ID ); ?>
							</li><?php } ?>
							<?php if ( get_field( 'interlocuteur_mail', $i->ID ) ) { ?>
								<li class="has-icon">
								<div class="icon-mail"></div><a
									href="mailto:<?php the_field( 'interlocuteur_mail' ); ?>"><?php the_field( 'interlocuteur_mail',
										$i->ID ); ?></a></li><?php } ?>
						</ul>
					</span>
					<a href="#" class="detail-bloc-interlocuteur btn-interlocuteur">
						<span class="container-fond-detail-bloc-interlocuteur">
							<span class="fond-detail-bloc-interlocuteur"></span>
						</span>
						<span class="txt-detail-bloc-interlocuteur">En savoir +</span>
					</a>
					</div>
					<?php
				}
			}
		}
		?>

	</section>

	</section>

	<div id="bloc-fond-visu">
		<div id="fond-couleur-bloc-visu"></div>
		<div class="container" id="container-bloc-visu-content">
			<div class="bloc-content bloc-visu-content">
				<div id="fond-bloc-visu"></div>
			</div>
		</div>
	</div>

	<?php include( 'includes/sitemap.php' ); ?>

	<?php

	foreach ( $pages as $page ) {

		$interlocuteurs = get_field( 'interlocuteur', $page->ID );
		if ( $interlocuteurs ) {
			foreach ( $interlocuteurs as $i ) {

				?>
				<div id="wrapper-interlocuteur-modal">
					<div id="wrapper-relative-interlocuteur-modal">
						<div id="overlay-interlocuteur"></div>
						<nav id="interlocuteur-modal">
							<div class="container-fond-modal">
								<div class="fond-modal"></div>
							</div>
							<div id="content-interlocuteur">
								<div class="bloc-gauche-content-interlocuteur">
									<div class="container-photo-interlocuteur">
										<div class="fond-photo-interlocuteur"><?php if ( get_field( 'interlocuteur_img',
												$i->ID ) ) { ?><img src="<?php echo get_field( 'interlocuteur_img',
												$i->ID )['sizes']['thumbnail']; ?>"
										                           alt="<?php echo get_field( 'interlocuteur_img',
											                           $i->ID )['alt']; ?>"/><?php } ?></div>
									</div>
								</div>
								<div class="bloc-droite-content-interlocuteur">
									<h3><?php the_field( 'interlocuteur_nom', $i->ID ); ?></h3>
									<?php if ( get_field( 'interlocuteur_devise', $i->ID ) ) {
										echo "<blockquote>" . get_field( 'interlocuteur_devise',
												$i->ID ) . "</blockquote>";
									} ?>
									<ul class="contact-interlocuteur">
										<?php if ( get_field( 'interlocuteur_tel', $i->ID ) ) { ?>
											<li class="has-icon">
											<div class="icon-telephone"></div><?php the_field( 'interlocuteur_tel',
												$i->ID ); ?></li><?php } ?>
										<?php if ( get_field( 'interlocuteur_mail', $i->ID ) ) { ?>
											<li class="has-icon">
											<div class="icon-mail"></div>
											<a href="mailto:<?php the_field( 'interlocuteur_mail',
												$i->ID ); ?>"><?php the_field( 'interlocuteur_mail', $i->ID ); ?></a>
											</li><?php } ?>
										<li>
											<ul class="social-interlocuteur">
												<?php if ( get_field( 'interlocuteur_twitter', $i->ID ) ) { ?>
													<li class="twitter"><a
														href="<?php the_field( 'interlocuteur_twitter', $i->ID ); ?>"
														target="_blank"><span class="icon-twitter"></span></a>
													</li><?php } ?>
												<?php if ( get_field( 'interlocuteur_linkedin', $i->ID ) ) { ?>
													<li class="linkedin"><a
														href="<?php the_field( 'interlocuteur_linkedin', $i->ID ); ?>"
														target="_blank"><span class="icon-linkedin"></span></a>
													</li><?php } ?>
												<?php if ( get_field( 'interlocuteur_fb', $i->ID ) ) { ?>
													<li class="facebook"><a
														href="<?php the_field( 'interlocuteur_fb', $i->ID ); ?>"
														target="_blank"><span class="icon-facebook"></span></a>
													</li><?php } ?>
												<?php if ( get_field( 'interlocuteur_viadeo', $i->ID ) ) { ?>
													<li class="viadeo"><a
														href="<?php the_field( 'interlocuteur_viadeo', $i->ID ); ?>"
														target="_blank"><span class="icon-viadeo"></span></a>
													</li><?php } ?>
											</ul>
										</li>
									</ul>
								</div>
							</div>
							<div class="titre-modal">
								<div class="container-fond-titre-modal">
									<div class="fond-titre-modal"></div>
								</div>
								<div class="txt-titre-modal">Votre<br/> interlocuteur</div>
							</div>
							<div class="close-modal">
								<div class="container-fond-close-modal">
									<div class="fond-close-modal"></div>
								</div>
								<a href="#" id="lien-close-interlocuteur-modal"><span class="icon-close"></span></a>
							</div>
						</nav>
					</div>
				</div>
				<?php
			}
		}

	} ?>

<?php endif; ?>

<?php get_footer(); ?>