<?php
/*
Template Name: Home
*/

get_header(); ?>
	<div id="c-home" class="wrapper-blocs">
		<div id="fond-bloc-visu" class="c-home__hero-image" >
 			<?php the_post_thumbnail('full'); ?>
		</div>

		<div class="bloc-full bloc-penche c-home__promise <?php if( get_field('lien_externe')) { echo 'external-page-link'; }?>" id="zone-actus">

				<!--<div class="ribbon">
					<div class="fond-ribbon"></div>
					<div class="ribbon-content">
						<h1><?php //the_field('titre-contenu'); ?></h1>
					</div>
				</div>

				<div class="ribbon-copie">
					<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
					<div class="ribbon-content"></div>
				</div>-->
				<!-- <div class="fond-bloc"></div> -->

				<div class="bloc-content bloc-content-home intro-home small-padding-top" id="bloc-actus">
					<div>
						<h1 class="c-home__promise-title"><?php the_title(); ?></h1>
						<div class="c-home__promise-content">
							<?php the_content(); ?>
						</div>

						<?php if(get_field('btn')) : ?>
							<a href='<?php echo get_field('btn')['url']; ?>' class='btn c-home__promise-button'><?php echo get_field('btn')['title']; ?></a>
						<?php endif; ?>
					</div>

					<?php /*if( get_field('lien-savoir-plus')) {?>
						<a href="<?php the_field('lien-savoir-plus'); ?>" class="btn-bloc ext-link">
							<span class="container-fond-btn-bloc">
								<span class="fond-btn-bloc"></span>
							</span>
							<span class="know-more">En savoir plus</span>
						</a>
					<?php } else if( get_field('lien_externe')) {?>
						<a href="<?php the_field('lien_externe'); ?>" class="btn-bloc ext-link" target="_blank">
							<span class="container-fond-btn-bloc">
								<span class="fond-btn-bloc external"></span>
							</span>
							<span class="know-more">Visiter le site</span>
						</a>
					<?php } else { ?>
					<?php if($post->post_content != "") { ?>
							<div class="suite-bloc">
								<?php the_content(); ?>
							</div>

							<a href="#" class="btn-bloc">
								<span class="container-fond-btn-bloc">
									<span class="fond-btn-bloc"></span>
								</span>
								<span class="txt-btn-bloc">Lire la suite</span>
								<span class="txt-reduire-btn-bloc">Réduire</span>
							</a>
						<?php } ?>
					<?php }*/ ?>
					<?php
					/*$loop = new WP_Query( array( 'post_type' => 'post', 'order' => 'DESC', 'posts_per_page' => 1 ) );
					if ( $loop->have_posts() ) :
					while ( $loop->have_posts() ) : $loop->the_post();*/
					?>
						<!--<div class="date-categ-actu">Le <span class="date-actu"><?php // echo get_the_date(); ?></span> dans <?php // foreach((get_the_category()) as $cat) { ?><a href="<?php // echo get_category_link($cat->term_id) . ' ';  ?>" class="categ-actu"><?php // echo $cat->cat_name . ' ';  ?></a><?php // } ?> </div>
						<h2><a href="<?php // the_permalink(); ?>"><?php // the_title(); ?></a></h2>
						<div class="content-actu">
							<?php // if(has_post_thumbnail()){ // the_post_thumbnail(); }?>
							<p>
								<?php // formatTexte(get_field('actus_fist_line')); ?>
								<a class="btn-plus" href="<?php // the_permalink(); ?>"><span class="txt-btn">Lire la suite</span><span class="container-icon-plus"><span class="icon-plus"></span></span></a>
							</p>
						</div>

						<a href="<?php // echo get_home_url(); ?>/actualites/" class="btn-bloc btn-actu">
							<span class="container-fond-btn-bloc">
								<span class="fond-btn-bloc"></span>
							</span>
							<span class="txt-btn-bloc">Toute l'actualité</span>
							<span class="btn-icon-plus"><span class="icon-plus"></span></span>
						</a>-->
					<?php //endwhile; endif; wp_reset_query(); ?>
				</div>

		</div>

		<?php if( get_field('numbers') ) : $numbers = get_field('numbers'); ?>
			<div class="bloc-full c-home__key-numbers">
				<h2 class='bloc-full-title orange c-home__key-numbers-title'><?php echo $numbers['title']; ?></h2>
				<div class="bloc-content bloc-content-home with-bg bloc-flex bloc-numbers c-home__key-numbers-items">
					<div class="c-home__key-numbers-item">
						<?php echo wp_get_attachment_image($numbers['img1'], 'full'); ?>
						<?php echo $numbers['text1']; ?>
					</div>
					<div class="c-home__key-numbers-item">
						<?php echo wp_get_attachment_image($numbers['img2'], 'full'); ?>
						<?php echo $numbers['text2']; ?>
					</div>
					<div class="c-home__key-numbers-item">
						<?php echo wp_get_attachment_image($numbers['img3'], 'full'); ?>
						<?php echo $numbers['text3']; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if( $event_groupe = get_field('evenementiel') ): ?>
			<div class="c-home__event">
				<?php if ($event_groupe['image']): ?>
					<figure class="c-home__event-media">
						<?php echo wp_get_attachment_image($event_groupe['image'], 'full'); ?>
					</figure>
				<?php endif; ?>
				<div class="c-home__event-content c-content">
					<?php if ($event_groupe['image']): ?>
						<h2 class="c-content__title"><?php echo $event_groupe['titre'] ?></h2>
					<?php endif; ?>
					<?php if ($event_groupe['texte']): ?>
						<div class="c-content__texte">
							<?php echo $event_groupe['texte'] ?>
						</div>
					<?php endif; ?>
					<?php if($event_groupe['bouton']) : ?>
						<a href="<?php echo $event_groupe['bouton']['url']; ?>" class="btn c-content__button">
							<?php echo $event_groupe['bouton']['title']; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="bloc-full c-home__news">
			<?php if (get_field('affichage_titre_actu')): ?>
			<h2 class='bloc-full-title c-home__news-title'>Actualités</h2>
			<?php endif; ?>
			<?php if( have_rows('actus') ): ?>
				<div class="bloc-content bloc-content-home with-bg bloc-flex c-home__news-items">
					<?php
						while ( have_rows('actus') ) : the_row();
						$article_url = get_sub_field('article');
						$article_id = url_to_postid($article_url);
						$article = get_post($article_id);
					?>
						<div class='article c-home__post'>
							<figure class="c-home__post-media">
								<?php if(has_post_thumbnail($article_id)){ echo get_the_post_thumbnail($article_id); }?>
							</figure>
							<div class="c-home__post-content">
								<div class="date-categ-actu c-post-info">Le <span class="date-actu"><?php echo get_the_date('', $article_id); ?></span> dans <?php foreach((get_the_category($article_id)) as $cat) { ?><a href="<?php echo get_category_link($cat->term_id) . ' ';  ?>" class="categ-actu"><?php echo $cat->cat_name . ' ';  ?></a><?php } ?> </div>
								<h2 class="c-post-title"><a href="<?php the_permalink($article_id); ?>"><?php echo get_the_title($article_id); ?></a></h2>
								<div class="content-actu c-post-content">
									<p>
										<?php formatTexte(get_field('actus_fist_line', $article_id)); ?>
									</p>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php /*$blocs = get_field('blocs');

			if( $blocs ): $bloc = 0; ?>

				<div class="zone-blocs" id="zone-blocs-accueil">
					<?php foreach( $blocs as $p ): $bloc ++; ?>
							<?php 
								$specific_class = ""; 
							 	if($bloc == 4){ $specific_class = "bloc-recrutement"; } 
							 	if($bloc == 5){ $specific_class = "bloc-contact"; } 
							?>
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
											} } ?>" class="bloc-small <?php echo get_field( 'bloc-theme', $p->ID )." ".$specific_class; ?>">
								<span class="categ-bloc">
									<span class="container-fond-categ-bloc">
										<span class="fond-categ-bloc"></span>
									</span>
									<span class="txt-categ-bloc know-more"><?php echo get_the_title( $p->ID ); ?></span>
								</span>
								<?php if($bloc != 4 && $bloc != 5){ ?>
									<span class="categ-bloc-copie">
										<span class="container-fond-categ-bloc">
											<span class="fond-categ-bloc"><span class="raccord-categ"></span></span>
										</span>
										<span class="txt-categ-bloc-copie"></span>
									</span>
									<span class="container-fond-bloc-deform">
										<span class="fond-bloc-deform"></span>
									</span>
									<span class="txt-bloc-deform"><?php formatTexte(get_field( 'bloc-texte', $p->ID )); ?> <span class='link'><?php formatTexte(get_field( 'bloc-texte-lien', $p->ID )); ?></span></span>
								<?php } ?>
								<!--<span class="detail-bloc">
									<span class="container-fond-detail-bloc">
										<span class="fond-detail-bloc"></span>
									</span>
									<span class="txt-detail-bloc"><?php //echo get_field( 'bloc-texte-lien', $p->ID ); ?></span>
								</span>
								<span class="detail-bloc-copie">
									<span class="container-fond-detail-bloc">
										<span class="fond-detail-bloc"><span class="raccord-detail"></span></span>
									</span>
									<span class="txt-detail-bloc-copie"></span>
								</span>
								<span class="btn-icon-plus"><span class="icon-plus"></span></span>-->
								<?php if($bloc == 1){ ?>
									<object id="container-pop" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/pop.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/plop.png"></object>
									<object id="container-pop2" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/pop2.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/plop-2.png"></object>
									<object id="container-pop3" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/pop2.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/plop-2.png"></object>
								<?php } ?>
								<?php if($bloc == 2){ ?>
									<object id="container-twitter" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/twitter.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/twitter.png"></object>
									<object id="container-facebook" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/facebook.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/facebook.png"></object>
								<?php } ?>
								<?php if($bloc == 3){ ?>
									<object id="container-smiley" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/smiley.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/smiley.png"></object>
									<object id="container-smiley-big" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/smiley-big.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/smiley-big.png"></object>
								<?php } ?>
								<?php if($bloc == 4){ ?>
									<object id="container-verre" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/verre.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/verre.png"></object>
									<object id="container-tasse" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/tasse.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/tasse.png"></object>
								<?php } ?>
								<?php if($bloc == 5){ ?>
									<object id="container-mail" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/mail.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/mail.png"></object>
									<object id="container-tel" type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/svg/tel.svg" data-fallback="<?php echo get_template_directory_uri(); ?>/layoutImg/svg-fallback/tel.png"></object>
								<?php } ?>
							</a><br />
					<?php endforeach; ?>
				</div>

		<?php endif;*/ ?>

	</div><!-- #primary .content-area -->

	</section>

	<?php /*if( get_field('bloc_media')) {?>
		<div class="bloc-content bloc-visu-content" id="visu-content">
			<span class="shadow"></span>
			<div class="bloc-btn-video">
				<svg id="circle-dashed-video-svg" viewBox="0 0 85 85">
					<circle class="circle-dashed-video" cx="42" cy="42" r="42"/>
				</svg>
				<div class="content-bloc-btn-video">
					<a href="#" class="btn-video">
						<div class="fond-btn-video"></div>
						<span class="icon-play"></span>
						<span class="bloc-txt-btn-video">
							<span class="container-fond-txt-btn-video">
								<span class="fond-txt-btn-video"></span>
							</span>
							<span class="txt-btn-video">Vidéo</span>
						</span>
						<!--<span class="media-over m1">Vidéos</span>
						<span class="media-over m2">Plaquettes</span>
						<span class="media-over m3">Etc.</span>-->
					</a>
				</div>
			</div>
		</div>
	<?php }*/ ?>

</div>
</section>

		<!--<div id="bloc-fond-visu">
			<?php /* if( get_field('bloc_media') ):
				$big = get_field('bloc_media')[0];
				$idFirst = $big->ID;
			?>

					<div id="wrapper-embed">
						<?php if(get_field('video_media', $big->ID)){ ?>
							<video id="id-video-js" class="video-js vjs-default-skin" controls preload="auto" width="100%" height="100%" poster="<?php echo get_field('image_video_media', $big->ID)['url']; ?>" src="<?php echo get_field('video_media', $big->ID); ?>"></video>
						<?php } if(get_field('calameo_media', $big->ID)){ ?>
							<iframe class='calameo-iframe' src='//v.calameo.com/?bkcode=<?php echo get_field('calameo_media', $big->ID); ?>' width='300' height='194' frameborder='0' scrolling='no' allowtransparency allowfullscreen style='margin:0 auto;'></iframe>
						<?php } if(get_field('image_media', $big->ID)){ ?>
							<div class='wrapper-img'><img src='<?php echo get_field('image_media', $big->ID)['url']; ?>'></div>
						<?php } ?>
					</div>

			<?php endif; */ ?>

			<div id="fond-couleur-bloc-visu"></div>
			<div class="container" id="container-bloc-visu-content">
				<div class="bloc-content bloc-visu-content">
					<div id="fond-bloc-visu" <?php /*if ( has_post_thumbnail() ) { $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);?>
													style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center center; background-size: cover;"
 											 <?php }*/ ?>>
 					</div>
				</div>
			</div>
		</div>-->

		<?php /*$medias = get_field('bloc_media');

			if( count($medias) <= 1 ) echo '<div style="display:none;">' ?>
				<aside id="bloc-autres-videos">
					<div id="container-btn-plus">
						<a href="#" class="btn-icon-plus" id="plus-autres-videos"><span class="icon-plus"></span></a>
					</div>
					<div id="scroll-container-autres-videos">
						<div id="container-autres-videos">
							<div id="wrapper-autres-videos">

								<ul id="autres-videos">

									<?php foreach( $medias as $p ): ?>

									<?php if(get_field('video_media', $p->ID)){ ?>
										<li class="<?php if($p->ID == $idFirst){ echo 'active '; } echo 'has-video'; ?>" <?php echo 'data-url-video="'.get_field('video_media', $p->ID).'" data-poster-name="'.get_field('image_video_media', $p->ID)['url'].'"'; ?>>
											<a href="#" class="lien-autre-video">
												<span class="container-fond-autre-video">
													<span class="fond-autre-video"><img src="<?php echo get_field('image_video_media', $p->ID)['sizes']['medium']; ?>" alt="<?php echo get_field('image_video_media', $p->ID)['alt']; ?>" /></span>

									<?php } if(get_field('calameo_media', $p->ID)){ ?>
										<li class="<?php if($p->ID == $idFirst){ echo 'active '; } echo 'has-calameo'; ?>" <?php echo 'data-id-calameo="'.get_field('calameo_media', $p->ID).'"'; ?>>
											<a href="#" class="lien-autre-video">
												<span class="container-fond-autre-video">
													<span class="fond-autre-video"><img src="<?php echo get_field('image_calameo_media', $p->ID)['sizes']['medium']; ?>" alt="<?php echo get_field('image_calameo_media', $p->ID)['alt']; ?>" /></span>

									<?php } if(get_field('image_media', $p->ID)){ ?>
										<li class="<?php if($p->ID == $idFirst){ echo 'active '; } echo 'has-image'; ?>" <?php echo 'data-image-name="'.get_field('image_media', $p->ID)['url'].'"'; ?>>
											<a href="#" class="lien-autre-video">
												<span class="container-fond-autre-video">
													<span class="fond-autre-video"><img src="<?php echo get_field('image_media', $p->ID)['sizes']['medium']; ?>" alt="<?php echo get_field('image_media', $p->ID)['alt']; ?>" /></span>
									<?php } ?>

												</span>
												<span class="autre-video-icon-play"><span class="icon-play"></span></span>
												<span class="titre-video">
													<span class="container-fond-titre-video">
														<span class="fond-titre-video"></span>
													</span>
													<span class="txt-titre-video"><?php echo get_the_title( $p->ID ); ?></span>
												</span>
											</a>
										</li>
									<?php endforeach; ?>

								</ul>

							</div>
						</div>
					</div>
				</aside>

		<?php if( count($medias) <= 1 ) echo '</div>'*/ ?>

		<?php include('includes/sitemap.php'); ?>

		<!--<div id="bloc-retour-video">
			<a href="#" id="retour-video">
				<span class="icon-retour"></span>
			</a>
		</div>-->


<?php get_footer(); ?>
