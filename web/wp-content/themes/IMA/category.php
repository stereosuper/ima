<?php get_header(); ?>

	<div class="wrapper-blocs">
		<div class="ribbon ribbon-bleu">
			<div class="fond-ribbon"></div>
			<div class="ribbon-content">
				<ul class="breadcrumb">
					<li><a href="<?php echo get_site_url(); ?>">IMATECH</a></li>
					<li><a href="<?php echo get_home_url(); ?>/actualites/">Actualités</a></li>
					<li><h1><?php single_cat_title( '', true ); ?></h1></li>
				</ul>
			</div>
		</div>

		<div class="ribbon-copie">
			<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
			<div class="ribbon-content"></div>
		</div>
		<div class="bloc-full bloc-categories-articles">
				<!-- <div id="raccord-categories-articles"></div> -->
				<div class="fond-bloc"></div>
				<div class="bloc-content small-padding-top">
						<div class="nb-actualites"><strong><?php echo count_cat_post(single_cat_title( '', false )); ?> actualités</strong> dans la catégorie</div>
						
						<a href="#" id="btn-categories-articles">
							<!-- <span class="container-fond-categories-articles">
								<span class="fond-categories-articles"></span>
							</span> -->
							<span class="txt-btn-categories-articles"><?php single_cat_title( '', true ); ?> <span class="icon-arrow-right"></span></span>
						</a>
						<ul id="categories-articles">
							<!-- <div class="container-fond-categories-articles">
								<div class="fond-categories-articles"></div>
							</div> -->
							<li><a href="<?php echo get_home_url(); ?>/actualites/">— Toutes les catégories</a></li>
							<?php 
								$args = array( 'hierarchical' => 0 ); 
								$categories = get_categories( $args );
								foreach ($categories as $cat) {
									echo '<li><a href="'. get_home_url() .'/category/' . $cat->category_nicename . '">' . $cat->name . '</a></li>';
								}
							?>
						</ul>
				</div>

			</div>


			<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				
				<div class="bloc-full bloc-penche article">

					<div class="fond-bloc"></div>
					<div class="bloc-content small-padding-top" id="bloc-actus">
						
						<div class="date-categ-actu">Le <span class="date-actu"><?php echo get_the_date(); ?></span> dans <?php foreach((get_the_category()) as $cat) { ?><a href="<?php echo get_category_link($cat->term_id) . ' ';  ?>" class="categ-actu"><?php echo $cat->cat_name . ' ';  ?></a><?php } ?> </div>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="content-actu">
							<?php if(has_post_thumbnail()){ the_post_thumbnail(); }?>
							<p>
								<?php formatTexte(get_field('actus_fist_line')); ?>
							</p>
						</div>
						<div class="wrapper-btn-actu">
							<a href="<?php the_permalink(); ?>" class="btn-actu">
								<span>En savoir plus</span>
							</a>
						</div>
							
					</div>
				</div>

			<?php endwhile; ?>

			<nav id="nav"><?php next_posts_link(); ?></nav>

			<?php endif; ?>
			

	<?php 				
				global $post;
				$page_for_posts_id = get_option('page_for_posts');
				if ( $page_for_posts_id ) { $post = get_post($page_for_posts_id); }
		    	setup_postdata($post);
		?>


	</div><!-- #primary .content-area -->

	</section>

</div>
</section>

		<?php if($embed == false){ ?>
		<div id="bloc-fond-visu">
			<?php if( get_field('bloc_media') ):
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

			<?php endif; ?>
			
			<div id="fond-couleur-bloc-visu"></div>
			<div class="container" id="container-bloc-visu-content">
				<div class="bloc-content bloc-visu-content">
					<div id="fond-bloc-visu" <?php if ( has_post_thumbnail() ) { $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);?> 
													style="background: url(<?php echo $thumb_url[0]; ?>) no-repeat center center; background-size: cover;" 
 											 <?php } ?>>
 					</div>
				</div>
			</div>
		</div>
		
		<?php $medias = get_field('bloc_media');

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

		<?php if( count($medias) <= 1 ) echo '</div>' ?>
	<?php } ?>

		<?php if( $int ){ 
			foreach($int as $i) :?>

				<div id="wrapper-interlocuteur-modal">
					<div id="wrapper-relative-interlocuteur-modal">
						<div id="overlay-interlocuteur"></div>
						<nav id="interlocuteur-modal">
							<div class="container-fond-modal">
								<div class="fond-modal"></div>
							</div>
							<div id="content-interlocuteur">
								<div class="bloc-gauche-content-interlocuteur">
									<div class="container-photo-interlocuteur"><div class="fond-photo-interlocuteur"><?php if( get_field('interlocuteur_img', $i->ID) ) { ?><img src="<?php echo get_field('interlocuteur_img', $i->ID)['sizes']['thumbnail']; ?>" alt="<?php echo get_field('interlocuteur_img', $i->ID)['alt']; ?>"/><?php } ?></div></div>
								</div><div class="bloc-droite-content-interlocuteur">
									<h3><?php the_field('interlocuteur_nom', $i->ID); ?></h3>
									<?php if(get_field('interlocuteur_devise', $i->ID)) echo "<blockquote>". get_field('interlocuteur_devise', $i->ID) ."</blockquote>"; ?>
									<ul class="contact-interlocuteur">
										<?php if( get_field('interlocuteur_tel', $i->ID) ) { ?><li class="has-icon"><div class="icon-telephone"></div><?php the_field('interlocuteur_tel', $i->ID); ?></li><?php } ?>
										<?php if( get_field('interlocuteur_mail', $i->ID) ) { ?><li class="has-icon"><div class="icon-mail"></div><a href="mailto:<?php the_field('interlocuteur_mail', $i->ID); ?>"><?php the_field('interlocuteur_mail', $i->ID); ?></a></li><?php } ?>
										<li>
											<ul class="social-interlocuteur">
												<?php if( get_field('interlocuteur_twitter', $i->ID) ){ ?><li class="twitter"><a href="<?php the_field('interlocuteur_twitter', $i->ID); ?>" target="_blank"><span class="icon-twitter"></span></a></li><?php } ?>
												<?php if( get_field('interlocuteur_linkedin', $i->ID) ){ ?><li class="linkedin"><a href="<?php the_field('interlocuteur_linkedin', $i->ID); ?>" target="_blank"><span class="icon-linkedin"></span></a></li><?php } ?>
												<?php if( get_field('interlocuteur_fb', $i->ID) ){ ?><li class="facebook"><a href="<?php the_field('interlocuteur_fb', $i->ID); ?>" target="_blank"><span class="icon-facebook"></span></a></li><?php } ?>
												<?php if( get_field('interlocuteur_viadeo', $i->ID) ){ ?><li class="viadeo"><a href="<?php the_field('interlocuteur_viadeo', $i->ID); ?>" target="_blank"><span class="icon-viadeo"></span></a></li><?php } ?>
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
			<?php endforeach;
		} ?>


		<?php include('includes/sitemap.php'); ?>

<?php get_footer(); ?>