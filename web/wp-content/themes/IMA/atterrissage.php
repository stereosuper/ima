<?php
/*
Template Name: Atterrissage
*/

get_header(); ?>
	<div class="wrapper-blocs">
		<div class="bloc-full bloc-penche" id="zone-actus">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

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
				<div class="fond-bloc"></div>

				<div class="bloc-content" id="bloc-actus">

						<h2><?php the_field('titre-contenu'); ?></h2>
						<?php the_field('first_line'); ?>

						<?php if($post->post_content != "") { ?>
							<div class="suite-bloc">
								<?php the_content(); ?>

								<?php
								if( get_field('partage') == true) {
									$ID = get_the_ID();
									$current = get_permalink( $ID );
								?>
									<div class="bloc-partage">
										<div class="titre-modal">
											<div class="container-fond-titre-modal">
												<div class="fond-titre-modal"></div>
											</div>
											<div class="txt-titre-modal">Partager<br /> <span>cette page</span></div>
										</div>

										<ul class="partage">
											<li class="twitter"><a href="http://twitter.com/intent/tweet/?url=<?php echo $current; ?>&text=<?php the_field('titre-contenu'); ?>&via=IMAtech" target="_blank"><span class="icon-twitter"></span></a></li>
											<li class="scoopit"><a href="https://www.scoop.it/bookmarklet?url=<?php echo $current; ?>" target="_blank"><span class="icon-scoopit"></span></a></li>
											<li class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current; ?>&title=<?php the_field('titre-contenu'); ?>" target="_blank"><span class="icon-linkedin"></span></a></li>
										</ul>
									</div>
								<?php } ?>

							</div>
						<?php } ?>

						<?php if( get_field('interlocuteur_nom') ){ ?>
							<a href="#" class="btn-interlocuteur <?php if( get_field('interlocuteur_img') ) { echo 'has-photo'; }?>">
								<span class="container-fond-btn-interlocuteur">
									<span class="fond-btn-interlocuteur"></span>
								</span>
								<?php if( get_field('interlocuteur_img') ) { ?><span class="container-photo-btn-interlocuteur"><span class="fond-photo-btn-interlocuteur"><img src="<?php echo get_field('interlocuteur_img')['sizes']['thumbnail']; ?>" alt="<?php echo get_field('interlocuteur_img')['alt']; ?>"/></span></span><?php } ?>
								<span class="txt-btn-interlocuteur">Votre&nbsp;interlocuteur</span>
							</a>
						<?php } ?>

						<?php if($post->post_content != "") { ?>
							<a href="#" class="btn-bloc">
								<span class="container-fond-btn-bloc">
									<span class="fond-btn-bloc"></span>
								</span>
								<span class="txt-btn-bloc">Lire la suite</span>
								<span class="txt-reduire-btn-bloc">Réduire</span>
							</a>
						<?php } ?>

				</div>

		</div>

		<?php $blocs = get_field('blocs');

			if( $blocs ): ?>

				<div class="zone-blocs" id="zone-blocs-accueil">
					<?php foreach( $blocs as $p ): ?>
							<a href="<?php if( get_field( 'lien', $p->ID ) == 'externe'){
												echo get_field( 'lien_externe', $p->ID);
											}else if( get_field( 'lien', $p->ID ) == 'interne' ){
												echo get_field( 'lien_interne', $p->ID);
												$lienMedia = get_field('id_bloc_media', $p->ID);
												if( $lienMedia ){
													if(get_field('calameo_media', $lienMedia->ID)){
														echo '#calameo#'. get_field('calameo_media', $lienMedia->ID);
													}
													else if(get_field('video_media', $lienMedia->ID)){
														echo '#video#'. get_field('video_media', $lienMedia->ID) . '#'. get_field('image_video_media', $lienMedia->ID)['url'];
													}
													else if(get_field('image_media', $lienMedia->ID)){
														echo '#image#'. get_field('image_media', $lienMedia->ID)['url'];
													}
											} } ?>" class="bloc-small <?php echo get_field( 'bloc-theme', $p->ID ); ?>" <?php if( get_field( 'lien', $p->ID ) == 'externe') echo 'target="_blank"'; ?>>

								<span class="categ-bloc">
									<span class="container-fond-categ-bloc">
										<span class="fond-categ-bloc"></span>
									</span>
									<span class="txt-categ-bloc"><?php echo get_the_title( $p->ID ); ?></span>
								</span>
								<span class="container-fond-bloc-deform">
									<span class="fond-bloc-deform"></span>
								</span>
								<span class="txt-bloc-deform"><?php formatTexte(get_field( 'bloc-texte', $p->ID )); ?></span>
								<span class="detail-bloc">
									<span class="container-fond-detail-bloc">
										<span class="fond-detail-bloc"></span>
									</span>
									<span class="txt-detail-bloc"><?php echo get_field( 'bloc-texte-lien', $p->ID ); ?></span>
								</span>
							</a>
					<?php endforeach; ?>
				</div>

		<?php endif; ?>

	</div><!-- #primary .content-area -->

	</section>

</div>
</section>


		<?php if( get_field('interlocuteur_nom') ){ ?>

		<div id="wrapper-interlocuteur-modal">
			<div id="wrapper-relative-interlocuteur-modal">
				<div id="overlay-interlocuteur"></div>
				<nav id="interlocuteur-modal">
					<div class="container-fond-modal">
						<div class="fond-modal"></div>
					</div>
					<div id="content-interlocuteur">
						<div class="bloc-gauche-content-interlocuteur">
							<div class="container-photo-interlocuteur"><div class="fond-photo-interlocuteur"><?php if( get_field('interlocuteur_img') ) { ?><img src="<?php echo get_field('interlocuteur_img')['sizes']['thumbnail']; ?>" alt="<?php echo get_field('interlocuteur_img')['alt']; ?>"/><?php } ?></div></div>
						</div><div class="bloc-droite-content-interlocuteur">
							<h3><?php the_field('interlocuteur_nom'); ?></h3>
							<?php if(get_field('interlocuteur_devise')) echo "<blockquote>". get_field('interlocuteur_devise') ."</blockquote>"; ?>
							<ul class="contact-interlocuteur">
								<?php if( get_field('interlocuteur_tel') ) { ?><li class="has-icon"><div class="icon-telephone"></div><?php the_field('interlocuteur_tel'); ?></li><?php } ?>
								<?php if( get_field('interlocuteur_mail') ) { ?><li class="has-icon"><div class="icon-mail"></div><a href="mailto:<?php the_field('interlocuteur_mail'); ?>"><?php the_field('interlocuteur_mail'); ?></a></li><?php } ?>
								<li>
									<ul class="social-interlocuteur">
										<?php if( get_field('interlocuteur_twitter') ){ ?><li class="twitter"><a href="<?php the_field('interlocuteur_twitter'); ?>" target="_blank"><span class="icon-twitter"></span></a></li><?php } ?>
										<?php if( get_field('interlocuteur_linkedin') ){ ?><li class="linkedin"><a href="<?php the_field('interlocuteur_linkedin'); ?>" target="_blank"><span class="icon-linkedin"></span></a></li><?php } ?>
										<?php if( get_field('interlocuteur_fb') ){ ?><li class="facebook"><a href="<?php the_field('interlocuteur_fb'); ?>" target="_blank"><span class="icon-facebook"></span></a></li><?php } ?>
										<?php if( get_field('interlocuteur_viadeo') ){ ?><li class="viadeo"><a href="<?php the_field('interlocuteur_viadeo'); ?>" target="_blank"><span class="icon-viadeo"></span></a></li><?php } ?>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="titre-modal">
						<div class="container-fond-titre-modal">
							<div class="fond-titre-modal"></div>
						</div>
						<div class="txt-titre-modal">Votre<br /> interlocuteur</div>
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
		<?php } ?>

		<?php include('includes/sitemap.php'); ?>

	<?php endwhile; ?>

<?php endif; ?>


<?php get_footer(); ?>