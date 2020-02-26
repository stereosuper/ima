<?php
/**
 * Le template pour une offre d'emploi
 *
 */

get_header('rh'); ?>

	<div class="wrapper-blocs">
		
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				<div class="ribbon ribbon-bleu">
					<div class="fond-ribbon"></div>
					<div class="ribbon-content">
						<ul class="breadcrumb">
							<li><a href="<?php echo get_site_url(); ?>">IMATECH</a></li>
							<li><a href="<?php echo get_home_url(); ?>/offres-emploi/">Offres d'emploi</a></li>
							<li><h1><?php echo get_the_date(); ?></h1></li>
						</ul>
					</div>
				</div>

				<div class="ribbon-copie" style="display: block;">
					<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
					<div class="ribbon-content" style="height: 31px; width: 403px;"></div>
				</div>

				<div class="bloc-full" id="zone-actus">

					<?php
						$ID = get_the_ID();
						$current = get_permalink( $ID );
					?>

					<a href="<?php echo get_home_url(); ?>/rh/offres-emploi/postuler?offre=<?php echo $ID; ?>" class="btn-postuler">
						<span class="raccord"></span>
						<span class="container-fond-btn-postuler">
							<span class="fond-btn-postuler"></span>
						</span>
						<span class="txt-btn-postuler">-> Postuler</span>
					</a>
					<div class="container-fond-bloc">
						<div class="fond-bloc"></div>
					</div>

					<div class="bloc-content bloc-single" id="bloc-actus">

						<div class="date-categ-actu">Le <span class="date-actu"><?php echo get_the_date(); ?></span></div>
						<h2><?php the_title(); ?></h2>
						<div class="content-single">
							<ul class="details-annonce">
								<div class="container-fond-details-annonce">
									<div class="fond-details-annonce"></div>
								</div>
								<li><span class="titre-detail-annonce">Localisation : </span><span class="content-detail-annonce"><?php the_field('offre_localisation'); ?></span></li>
								<li><span class="titre-detail-annonce">Référence : </span><span class="content-detail-annonce"><?php the_field('offre_ref'); ?></span></li>
								<li><span class="titre-detail-annonce">Contrat : </span><span class="content-detail-annonce"><?php the_field('offre_contrat'); ?></span></li>
								<li><span class="titre-detail-annonce">Salaire : </span><span class="content-detail-annonce"><?php the_field('offre_salaire'); ?></span></li>
								<li><span class="titre-detail-annonce">Horaires - Temps de travail : </span><span class="content-detail-annonce"><?php the_field('offre_horaires'); ?></span></li>
							</ul>
							<?php the_content(); ?>
						</div>

							<div class="bloc-partage">
								<div class="titre-modal">
									<div class="container-fond-titre-modal">
										<div class="fond-titre-modal"></div>
									</div>
									<div class="txt-titre-modal"><?php _e('Partager', 'ima'); ?><br /> <span><?php _e('cette offre', 'ima'); ?></span></div>
								</div>

								<ul class="partage">
									<li class="twitter"><a href="http://twitter.com/intent/tweet/?url=<?php echo $current; ?>&text=<?php the_field('titre-contenu'); ?>&via=IMAtech" target="_blank"><span class="icon-twitter"></span></a></li>
									<li class="scoopit"><a href="https://www.scoop.it/bookmarklet?url=<?php echo $current; ?>" target="_blank"><span class="icon-scoopit"></span></a></li>
									<li class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current; ?>&title=<?php the_field('titre-contenu'); ?>" target="_blank"><span class="icon-linkedin"></span></a></li>
								</ul>
							</div>

					</div>
				</div>

				<?php endwhile; ?>

				<?php else : ?>

						<div class="ribbon ribbon-bleu">
							<div class="fond-ribbon"></div>
							<div class="ribbon-content">
								<ul class="breadcrumb">
									<li><a href="<?php echo get_site_url(); ?>">IMATECH</a></li>
									<li><a href="<?php echo get_home_url(); ?>/offres/">Offres d'emploi</a></li>
									<li><h1>404</h1></li>
								</ul>
							</div>
						</div>

						<div class="ribbon-copie">
							<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
							<div class="ribbon-content"></div>
						</div>
						<div class="bloc-full" id="zone-actus">
							<div class="fond-bloc"></div>

							<div class="bloc-content bloc-single" id="bloc-actus">
								<h2>Cette offre n'existe plus ou a été déplaçée!</h2>
							</div>
						</div>

				<?php endif; ?>

		

	</div><!-- #primary .content-area -->

	</section>

</div>

<section id="content-right">
	<?php $pages = get_posts(array( 'post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'postuler.php' ));
	foreach($pages as $page){
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

	} ?>

</section>


</section>

				<div id="bloc-fond-visu">
					<div id="fond-couleur-bloc-visu"></div>
					<div class="container" id="container-bloc-visu-content"><div class="bloc-content bloc-visu-content"><div id="fond-bloc-visu"></div></div></div>
				</div>

				<?php include('includes/sitemap.php'); ?>

				<?php
				foreach($pages as $page){
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

<?php get_footer(); ?>
