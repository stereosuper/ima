<?php
/*
Template Name: Postuler
*/

if (isset($_GET['offre'])){
	$offre = $_GET['offre'];
	if($offre == 'none'){
		$accroche = 'Vous souhaitez envoyer une candidature spontanée.';
	}
	else{
		$accroche = "Vous souhaitez postuler à l'offre " . get_field('offre_ref', $offre) . " : <br/>" . get_post($offre)->post_title;
	}
}else{
	$accroche = '';
	$offre = '';
}

$message_status = '';
$erreurNom = '';
$erreurPrenom = '';
$erreurMail = '';
$erreurTel = '';
$erreurAdresse = '';
$erreurCP = '';
$erreurVille = '';
$erreurMessage = '';
$erreurCV = '';
$erreurEnvoi = '';

if(isset($_POST['nom'])){ $nom = strip_tags($_POST['nom']); }else{ $nom = '';}
if(isset($_POST['prenom'])){ $prenom = strip_tags($_POST['prenom']); }else{ $prenom = ''; }
if(isset($_POST['mail'])){ $mail = strip_tags($_POST['mail']); }else{ $mail = ''; }
if(isset($_POST['tel'])){ $tel = strip_tags($_POST['tel']); }else{ $tel = ''; }
if(isset($_POST['adresse'])){ $adresse = strip_tags($_POST['adresse']); }else{ $adresse = ''; }
if(isset($_POST['cp'])){ $cp = strip_tags($_POST['cp']); }else{ $cp = ''; }
if(isset($_POST['ville'])){ $ville = strip_tags($_POST['ville']); }else{ $ville = ''; }
if(isset($_POST['message'])){ $message = strip_tags($_POST['message']); }else{ $message = ''; }


// MAIL DE DESTINATION //////////////////////////////////////
$mailto = get_field('postuler_mail');

if(isset($_POST['submitted'])) {
	if(empty($nom)) {
		$erreurNom = 'Le champ <span>Nom</span> est obligatoire';
		$message_status = "Erreur"; 
	}
	if(empty($prenom)) {
		$erreurPrenom = 'Le champ <span>Prénom</span> est obligatoire';
		$message_status = "Erreur"; 
	}
	if(empty($mail)) {
		$erreurMail = 'Le champ <span>Email</span> est obligatoire';
		$message_status = "Erreur"; 
	}else{
		if(!(filter_var($mail, FILTER_VALIDATE_EMAIL))) {
			$erreurMail = 'L’adresse email est invalide';
			$message_status = "Erreur"; 
		}
	}
	if(empty($tel)) {
		$erreurTel = 'Le champ <span>Téléphone</span> est obligatoire';
		$message_status = "Erreur"; 
	}else {
		if (!(strlen($tel) == 10 && ctype_digit($tel))) {
			$erreurTel = 'Le numéro de téléphone est incorrect';
			$message_status = "Erreur"; 
		}
	}
	if(empty($adresse)) {
		$erreurAdresse = 'Le champ <span>Adresse</span> est obligatoire';
		$message_status = "Erreur"; 
	}
	if(empty($cp)) {
		$erreurCP = 'Le champ <span>Code Postal</span> est obligatoire';
		$message_status = "Erreur"; 
	}else {
		if (!(strlen($cp) == 5 && ctype_digit($tel))) {
			$erreurCP = 'Le code postal est incorrect';
			$message_status = "Erreur"; 
		}
	}
	if(empty($ville)) {
		$erreurVille = 'Le champ <span>Ville</span> est obligatoire';
		$message_status = "Erreur"; 
	}
	if(empty($message)) {
		$erreurMessage = 'Le champ <span>Commentaires et lettre de motivation</span> est obligatoire';
		$message_status = "Erreur"; 
	}


	$nomFichier = $_FILES['cv']['name'];
	$extension = pathinfo($nomFichier)['extension'];
	$extensionsOk = array('pdf', 'PDF');

	if (!(in_array($extension, $extensionsOk))) {
		$erreurCV = "Le fichier n'a pas l'extension attendue";
		$message_status = "Erreur";
		$cv = '';
	}else{
		$repertoire = WP_CONTENT_DIR . '/cv/';
		$nomDestination = "cv_".date("YmdHis").".".$extension;
		if (move_uploaded_file($_FILES["cv"]["tmp_name"], $repertoire.$nomDestination)) {
			$attachments = WP_CONTENT_DIR . '/cv/' . $nomDestination;
			$erreurCV = '';
		} else {
			$erreurCV = "Le déplacement du fichier temporaire a échoué". " vérifiez l'existence du répertoire ".$repertoire;
			$message_status = "Erreur";
			$cv = '';
		}
	}

	if($erreurNom == '' && $erreurPrenom == '' && $erreurTel == '' && $erreurMail == '' && $erreurAdresse == '' && $erreurCP == '' && $erreurVille == '' && $erreurMessage == '' && $erreurCV == ''){ 

		if(!isset($offre)){
			if($offre == 'none'){
				$subject = "Nouvelle candidature spontanée provenant de imatechnologies.fr";
				$offreRef = ' ';
			}else{
				$subject = "Nouvelle candidature à l'offre " . get_field('offre_ref', $offre) . " provenant de imatechnologies.fr";
				$offreRef = 'Offre: ' . get_field('offre_ref', $offre) . " - " . get_post($offre)->post_title . "\r\n\r\n";
			}
		}else{
			$subject = "Nouvelle candidature provenant de imatechnologies.fr";
			$offreRef = ' ';
		}
		
		$headers = '';
		$content =  $offreRef .
					'De: '. $nom . " " . $prenom . "\r\n" .
					'Email: ' . $mail . "\r\n" .
					'Tél: '. $tel . "\r\n" .
					'Adresse: '. $adresse . " " . $cp . " " . $ville . "\r\n\r\n".
					'Commentaires et lettre de motivation: '. $message . "\r\n";

		$sent = wp_mail( $mailto, $subject, $content, $headers, $attachments);

		if($sent) {
			$message_status = "Demande envoyée";
			// vider
			unlink($attachments);
		}
		else{ 
			$message_status = "Erreur"; 	
			$erreurEnvoi = "Votre candidature n'a pas pu être envoyée. Veuillez réessayer!";
		}

	}
}

get_header('rh'); ?>
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

				<div class="ribbon-copie" style="display: block;">
					<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
					<div class="ribbon-content" style="height: 31px; width: 403px;"></div>
				</div>
				<div class="fond-bloc"></div>

				<div class="bloc-content bloc-single" id="bloc-actus">
					<?php $ID = get_the_ID(); ?>
					
					<strong><?php echo $accroche; ?></strong>
					<p><?php formatTexte(get_field('postuler_form')); ?></p>
					<h2>Vos infos personnelles</h2>
					<form enctype="multipart/form-data" method="POST" action="<?php echo get_permalink( $ID ) . basename($_SERVER['REQUEST_URI']); ?>">
						
						<?php if($message_status != 'Demande envoyée'){ ?>
							<fieldset class="form-gauche <?php if($erreurNom != '') echo 'error'; ?>">
								<label for="nom"><strong>Nom</strong></label>
								<input type="text" name="nom" id="nom" value="<?php echo $nom; ?>">
							</fieldset><fieldset class="form-droite <?php if($erreurPrenom != '') echo 'error'; ?>">
								<label for="prenom"><strong>Prénom</strong></label>
								<input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>">
							</fieldset><fieldset class="form-gauche <?php if($erreurMail != '') echo 'error'; ?>">
								<label for="mail"><strong>Email</strong> <span>(pas pour vous spammer !)</span></label>
								<input type="email" name="mail" id="mail" value="<?php echo $mail; ?>">
							</fieldset><fieldset class="form-droite <?php if($erreurTel != '') echo 'error'; ?>">
								<label for="tel"><strong>Téléphone</strong></label>
								<input type="tel" name="tel" id="tel" value="<?php echo $tel; ?>" class="taille2">
							</fieldset>
							<fieldset class="<?php if($erreurAdresse != '') echo 'error'; ?>">
								<label for="adresse"><strong>Adresse postale</strong></label>
								<input type="text" name="adresse" id="adresse" value="<?php echo $adresse; ?>" class="taille4">
							</fieldset>
							<fieldset class="form-inline form-inline-gauche <?php if($erreurCP != '') echo 'error'; ?>">
								<label for="cp"><strong>Code Postal</strong></label>
								<input type="text" name="cp" id="cp" value="<?php echo $cp; ?>" class="taille1">
							</fieldset><fieldset class="form-inline <?php if($erreurVille != '') echo 'error'; ?>">
								<label for="ville"><strong>Ville</strong></label>
								<input type="text" name="ville" id="ville" value="<?php echo $ville; ?>" class="taille3">
							</fieldset>
							<fieldset class="<?php if($erreurMessage != '') echo 'error'; ?>">
								<label for="message"><strong>Commentaires et lettre de motivation</strong></label>
								<textarea name="message" id="message"><?php echo $message; ?></textarea>
							</fieldset>
							<fieldset class="<?php if($erreurCV != '') echo 'error'; ?>">
								<label for="cv"><strong>JOINDRE VOTRE CV</strong> <span>(format PDF, taille max: 5Mo)</span></label>
								<div class="zone-fichier">
									<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
									<input type="file" name="cv" id="cv">
								</div>
							</fieldset>
                            <fieldset>
                                <p class='under-form'><?php the_field('postuler_under') ?></p>
                            </fieldset><br/>
							<button class="btn-form" name="submitted">
								<span class="container-fond-btn-form">
									<span class="fond-btn-form"></span>
								</span>
								<span class="txt-btn-form"><span class="icon-arrow-right"></span> Envoyer</span>
							</button>
						<?php } ?>

						<?php if($message_status == 'Demande envoyée'){ ?>
						<div class="bloc-message recu">
							<p><span>Candidature reçue !</span><br/>
							Votre candidature nous est parvenue. Nous allons l'étudier et vous répondre dans les plus brefs délais.</p>
						</div>
						<?php } ?>
						<?php if($message_status == 'Erreur'){ ?>
						<div class="bloc-message erreur">
							<p><span>Petit souci !</span><br/>
							Certains champs semblent comporter des erreurs. Merci de vérifier vos coordonnées.</p>
						</div>
						<?php } ?>
					</form>
						
				</div>

		</div>

	</div><!-- #primary .content-area -->

	</section>

</div>

<section id="content-right">
	
	<?php if( get_field('interlocuteur_nom') ){ ?>
		<div id="bloc-interlocuteur">
			<span class="categ-bloc-interlocuteur">
				<span class="container-fond-categ-bloc-interlocuteur">
					<span class="fond-categ-bloc-interlocuteur"></span>
				</span>
				<span class="container-photo-bloc-interlocuteur">
					<?php if( get_field('interlocuteur_img') ) { ?><span class="fond-photo-bloc-interlocuteur"><img src="<?php echo get_field('interlocuteur_img')['sizes']['thumbnail']; ?>" alt="<?php echo get_field('interlocuteur_img')['alt']; ?>"/></span><?php } ?>
				</span>
				<span class="txt-categ-bloc-interlocuteur">Votre&nbsp;interlocuteur</span>
			</span>
			<span class="container-fond-bloc-deform-interlocuteur">
				<span class="fond-bloc-deform-interlocuteur"></span>
			</span>
			<span class="txt-bloc-deform-interlocuteur">
				<h3><?php the_field('interlocuteur_nom'); ?></h3>
				<ul class="contact-bloc-interlocuteur">
					<?php if( get_field('interlocuteur_tel') ) { ?><li class="has-icon"><div class="icon-telephone"></div><?php the_field('interlocuteur_tel'); ?></li><?php } ?>
					<?php if( get_field('interlocuteur_mail') ) { ?><li class="has-icon"><div class="icon-mail"></div><a href="mailto:<?php the_field('interlocuteur_mail'); ?>"><?php the_field('interlocuteur_mail'); ?></a></li><?php } ?>
				</ul>
			</span>
			<a href="#" class="detail-bloc-interlocuteur btn-interlocuteur">
				<span class="container-fond-detail-bloc-interlocuteur">
					<span class="fond-detail-bloc-interlocuteur"></span>
				</span>
				<span class="txt-detail-bloc-interlocuteur">En savoir +</span>
			</a>
		</div>
	<?php } ?>

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

		<?php include('includes/sitemap.php'); ?>
		
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

	<?php endwhile; ?>

<?php endif; ?>


<?php get_footer(); ?>