 <?php

 if(isset($_GET['open']) && $_GET['open']=="1"){
 	$opened = ($_GET['open']=="1");
 }else{
 	$opened = false;
 }

 $message_status = '';
 $erreurNom = '';
 $erreurSociete = '';
 $erreurMail = '';
 $erreurMessage = '';
 $erreurEnvoi = '';

 if(isset($_POST['nom'])){ $nom = strip_tags($_POST['nom']); }else{ $nom = '';}
 if(isset($_POST['societe'])){ $societe = strip_tags($_POST['societe']); }else{ $societe = ''; }
 if(isset($_POST['mail'])){ $mail = strip_tags($_POST['mail']); }else{ $mail = ''; }
 if(isset($_POST['tel'])){ $tel = strip_tags($_POST['tel']); }else{ $tel = ''; }
 if(isset($_POST['message'])){ $message = strip_tags($_POST['message']); }else{ $message = ''; }

 // MAIL DE DESTINATION //////////////////////////////////////
 $mailto = 'adrien@stereosuper.fr';

 if(isset($_POST['submitted'])) {
 	if(empty($nom)) {
 		$erreurNom = 'Le champ <span>Nom</span> est obligatoire';
 		$message_status = "Erreur"; 
 	}
 	if(empty($societe)) {
 		$erreurSociete = 'Le champ <span>Société</span> est obligatoire';
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
 	if(empty($message)) {
 		$erreurMessage = 'Le champ <span>Message</span> est obligatoire';
 		$message_status = "Erreur"; 
 	}
 	if($erreurNom == '' && $erreurSociete == '' && $erreurMail == '' && $erreurMessage == ''){ 
 		$subject = "Nouvelle demande de contact provenant de imatechnologies.fr";
 		$headers = 'De: '. $nom ."\r\n" .
 					'Société: '. $societe . "\r\n" .
 					'Email: ' . $mail . "\r\n" .
 					'Tél: '. $tel . "\r\n" .
 					'Message: '. $message . "\r\n";
 		$sent = mail( $mailto, $subject, $headers, $message);
 		if($sent) {
 			$message_status = "Demande envoyée";
 		}
 		else{ 
 			$message_status = "Erreur"; 	
 			$erreurEnvoi = "Votre message n'a pas pu être envoyé. Veuillez réessayer!";
 		}
 	}
 }

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
	  	<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	  	<title></title>
	  	<meta name="description" content="">
	  	<meta name="viewport" content="width=device-width,initial-scale=1">
	  	<meta name="format-detection" content="telephone=no">
	  	<meta http-equiv="x-rim-auto-match" content="none">

	  	<link rel="stylesheet" href="css/libs/normalize.css">
	  	<link rel="stylesheet" href="css/style.css">
		<!--[if lt IE 7]>
		<link rel="stylesheet" href="css/libs/ie6.css" />
		<![endif]-->
		<script src="js/libs/modernizr.js" type="text/javascript" charset="utf-8"></script>
		<!-- videojs -->
		<link rel="stylesheet" href="js/libs/videojs/video-js.css">
		<script src="js/libs/videojs/video.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/libs/videojs/youtube.js" type="text/javascript" charset="utf-8"></script>
		<!-- isMobile -->
		<script src="js/libs/isMobile.min.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body class="inte contact">
		<div id="container-bg-map">
			<div id="bg-map"></div>
			<div id="pin-map"></div>
		</div>
		<section id="wrapper-content">
			<div class="container clearfix">
				<section id="content">
					<header>
						<nav>
							<div id="label-menu">Nos métiers</div>
							<div id="container-menu-wrapper">
								<div id="menu-wrapper">
									<div id="circle-dashed-container">
										<svg id="circle-dashed-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" viewBox="0 0 85 85">
											<circle class="cls-2" cx="42" cy="42" r="42"/>
										</svg>
									</div>
									<ul>
										<li class="circle-vehicules"><a href="#"><span class="txt-circle">Véhicules</span></a></li>
										<li class="circle-formation"><a href="#"><span class="txt-circle">Formation</span></a></li>
										<li class="circle-offre-conseil"><a href="#"><span class="txt-circle">Conseil</span></a></li>
										<li class="circle-service-client"><a href="#"><span class="txt-circle">Service<br /> client</span></a></li>
										<li class="circle-juridique"><a href="#"><span class="txt-circle">Juridique</span></a></li>
									</ul>
									<a href="#" id="circle-imatech"></a>
								</div>
							</div>
						</nav>
					</header>
					<div class="wrapper-blocs">
						<div class="ribbon ribbon-bleu">
							<div class="fond-ribbon"></div>
							<div class="ribbon-content">
								<ul class="breadcrumb">
									<li><a href="#">IMATECH</a></li>
									<li class="active"><h1>Contact</h1></li>
								</ul>
							</div>
						</div>
						<div class="ribbon-copie">
							<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
							<div class="ribbon-content"></div>
						</div>
						<div class="bloc-full bloc-penche" id="zone-actus">
							<div class="fond-bloc"></div>
							<div class="bloc-content" id="bloc-actus">
								<p><strong>Et si... Nous parlions de vous ?</strong><br /> Vous pouvez nous contacter par email à <a class="btn-bleu" href="mailto:enchante@imatech.fr">enchante@imatech.fr</a> ou par téléphone au&nbsp;<strong>02&nbsp;51&nbsp;86&nbsp;62&nbsp;00</strong></p>
								<p>Si vous préférez, remplissez le formulaire ci-dessous : </p>
								<form method="POST" action="?open=1">
									<fieldset class="form-gauche <?php if($erreurNom != '') echo 'error'; ?>">
										<label for="nom"><strong>Nom</strong></label>
										<input type="text" name="nom" id="nom" value="<?php echo $nom; ?>">
									</fieldset><fieldset class="form-droite <?php if($erreurSociete != '') echo 'error'; ?>">
										<label for="societe"><strong>Société</strong></label>
										<input type="text" name="societe" id="societe" value="<?php echo $societe; ?>">
									</fieldset><fieldset class="form-gauche <?php if($erreurMail != '') echo 'error'; ?>">
										<label for="mail"><strong>Email</strong> <span>(pas pour vous spammer !)</span></label>
										<input type="email" name="mail" id="mail" value="<?php echo $mail; ?>">
									</fieldset><fieldset class="form-droite <?php if($erreurTel != '') echo 'error'; ?>">
										<label for="tel">Téléphone <span>(facultatif)</span></label>
										<input type="tel" name="tel" id="tel" value="<?php echo $tel; ?>">
									</fieldset>
									<fieldset class="<?php if($erreurMessage != '') echo 'error'; ?>">
										<label for="message"><strong>Message</strong></label>
										<textarea name="message" id="message"><?php echo $message; ?></textarea>
									</fieldset><br/><br/>
									<button class="btn-form" name="submitted" <?php if($message_status == 'Demande envoyée'){ echo 'disabled';}?>>
										<span class="container-fond-btn-form">
											<span class="fond-btn-form"></span>
										</span>
										<span class="txt-btn-form"><span class="icon-arrow-right"></span> Envoyer</span>
									</button>
									<?php if($message_status == 'Demande envoyée'){ ?>
									<div class="bloc-message recu">
										<p><span>Message reçu !</span><br />
										Votre message nous est parvenu. Nous allons vous répondre dans les plus brefs délais.</p>
									</div>
									<?php } ?>
									<?php if($message_status == 'Erreur'){ ?>
									<div class="bloc-message erreur">
										<p><span>Petit souci !</span><br />
										Certains champs semblent comporter des erreurs. Merci de vérifier vos coordonnées.</p>
									</div>
									<?php } ?>
								</form>
							</div>
						</div>
					</div>
				</section>
			</div>
			<section id="content-right">
				<div id="bloc-adresse">
					<span class="categ-bloc-adresse">
						<span class="container-fond-categ-bloc-adresse">
							<span class="fond-categ-bloc-adresse"></span>
						</span>
						<span class="txt-categ-bloc-adresse">IMA&nbsp;TECHNOLOGIES</span>
					</span>
					<span class="container-fond-bloc-deform-adresse">
						<span class="fond-bloc-deform-adresse"></span>
					</span>
					<span class="txt-bloc-deform-adresse">1, Impasse Claude<br /> Nougaro BP 40327<br /> 44803 St Herblain cedex<br /><br />Téléphone :<br /> <strong>02 51 86 62 00</strong><br /><br /> <a class="btn-bleu" href="mailto:enchante@imatech.fr">enchante@imatech.fr</a></span>
					<a href="#" class="detail-bloc-adresse">
						<span class="container-fond-detail-bloc-adresse">
							<span class="fond-detail-bloc-adresse"></span>
						</span>
						<span class="txt-detail-bloc-adresse">Voir l'itinéraire</span>
						<span class="btn-icon-plus"><span class="icon-plus"></span></span>
					</a>
				</div>
			</section>
		</section>
		<div id="bloc-fond-visu">
			<div id="wrapper-embed">
					<video id="id-video-js" class="video-js vjs-default-skin" controls preload="auto" width="100%" height="100%" poster="img/videos/posters/poster-video-1.jpg" src="https://www.youtube.com/watch?v=zsxQdkbek_4"></video>
			</div>
			
			<div id="fond-couleur-bloc-visu"></div>
			<div class="container" id="container-bloc-visu-content">
				<div class="bloc-content bloc-visu-content">
					<div id="fond-bloc-visu"></div>
				</div>
			</div>
		</div>
		<aside id="bloc-autres-videos">
			<div id="container-btn-plus">
				<a href="#" class="btn-icon-plus" id="plus-autres-videos"><span class="icon-plus"></span></a>
			</div>
			<div id="scroll-container-autres-videos">
			<div id="container-autres-videos">
				<div id="wrapper-autres-videos">
					<ul id="autres-videos">
						<li class="active has-video" data-url-video="https://www.youtube.com/watch?v=zsxQdkbek_4" data-poster-name="img/videos/posters/poster-video-1.jpg">
							<a href="#" class="lien-autre-video">
								<span class="container-fond-autre-video">
									<span class="fond-autre-video"><img src="img/videos/locaux.png" alt="" /></span>
								</span>
								<span class="autre-video-icon-play"><span class="icon-play"></span></span>
								<span class="titre-video">
									<span class="container-fond-titre-video">
										<span class="fond-titre-video"></span>
									</span>
									<span class="txt-titre-video">relation client</span>
								</span>
							</a>
						</li>
						<li class="has-calameo" data-id-calameo="00224528101a4985cfc4d">
							<a href="#" class="lien-autre-video">
								<span class="container-fond-autre-video">
									<span class="fond-autre-video"><img src="img/videos/locaux.png" alt="" /></span>
								</span>
								<span class="autre-video-icon-play"><span class="icon-play"></span></span>
								<span class="titre-video">
									<span class="container-fond-titre-video">
										<span class="fond-titre-video"></span>
									</span>
									<span class="txt-titre-video">les locaux</span>
								</span>
							</a>
						</li>
						<li class="has-image" data-image-name="img/images/ima_technologies_plateau.jpg">
							<a href="#" class="lien-autre-video">
								<span class="container-fond-autre-video">
									<span class="fond-autre-video"><img src="img/videos/album-photo.png" alt="" /></span>
								</span>
								<span class="autre-video-icon-play"><span class="icon-play"></span></span>
								<span class="titre-video">
									<span class="container-fond-titre-video">
										<span class="fond-titre-video"></span>
									</span>
									<span class="txt-titre-video">Album photo</span>
								</span>
							</a>
						</li>
						<li class="has-video" data-url-video="https://www.youtube.com/watch?v=TmGh5Kadwuo" data-poster-name="poster-video-2.jpg">
							<a href="#" class="lien-autre-video">
								<span class="container-fond-autre-video">
									<span class="fond-autre-video"><img src="img/videos/entreprise.png" alt="" /></span>
								</span>
								<span class="autre-video-icon-play"><span class="icon-play"></span></span>
								<span class="titre-video">
									<span class="container-fond-titre-video">
										<span class="fond-titre-video"></span>
									</span>
									<span class="txt-titre-video">l'entreprise</span>
								</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			</div>
		</aside>
		<div id="wrapper-interlocuteur-modal">
			<div id="wrapper-relative-interlocuteur-modal">
				<div id="overlay-interlocuteur"></div>
				<nav id="interlocuteur-modal">
					<div class="container-fond-modal">
						<div class="fond-modal"></div>
					</div>
					<div id="content-interlocuteur">
						<div class="bloc-gauche-content-interlocuteur">
							<div class="container-photo-interlocuteur"><div class="fond-photo-interlocuteur"><img src="layoutImg/interlocuteurs/interlocuteur-1.jpg"></div></div>
						</div><div class="bloc-droite-content-interlocuteur">
							<h3>Jean-Philippe Cornet</h3>
							<blockquote>Une devise courte</blockquote>
							<ul class="contact-interlocuteur">
								<li class="has-icon"><div class="icon-telephone"></div>02 51 86 62 81</li>
								<li class="has-icon"><div class="icon-mail"></div><a href="mailto:jp.cornet@imatechnologies.fr">jp.cornet@imatechnologies.fr</a></li>
								<li>
									<ul class="social-interlocuteur">
										<li class="twitter"><a href="#"><span class="icon-twitter"></span></a></li>
										<li class="linkedin"><a href="#"><span class="icon-linkedin"></span></a></li>
										<li class="facebook"><a href="#"><span class="icon-facebook"></span></a></li>
										<li class="viadeo"><a href="#"><span class="icon-viadeo"></span></a></li>
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
		<div id="wrapper-sitemap-modal">
			<div id="wrapper-relative-sitemap-modal">
				<div id="overlay"></div>
				<nav id="sitemap-modal">
					<div class="container-fond-modal">
						<div class="fond-modal"><div class="cercle-sitemap"></div></div>
					</div>
					<div id="content-sitemap">
						<ul id="menu-sitemap">
							<li>
								<a href="#" class="circle-sitemap" id="sitemap-juridique"><span class="circle-responsive"><span class="icon-arrow-right"></span></span><span class="txt-circle-sitemap">Juridique</span></a>
								<ul class="liste-liens-sitemap">
									<li><a href="#">Advocat</a></li>
									<li><a href="#">Information juridique multicanale</a></li>
								</ul>
							</li>
							<li>
								<a href="#" class="circle-sitemap" id="sitemap-vehicules"><span class="circle-responsive"><span class="icon-arrow-right"></span></span><span class="txt-circle-sitemap">Véhicules</span></a>
								<ul class="liste-liens-sitemap">
									<li><a href="#">Support technique</a></li>
									<li><a href="#">Formation</a></li>
								</ul>
							</li>
							<li>
								<a href="#" class="circle-sitemap" id="sitemap-formation"><span class="circle-responsive"><span class="icon-arrow-right"></span></span><span class="txt-circle-sitemap">Formation</span></a>
								<ul class="liste-liens-sitemap">
									<li><a href="#">Formations personnalisées</a></li>
									<li><a href="#">Prochaines dates programmées</a></li>
								</ul>
							</li>
							<li>
								<a href="#" class="circle-sitemap" id="sitemap-service-client"><span class="circle-responsive"><span class="icon-arrow-right"></span></span><span class="txt-circle-sitemap">Service<br /> client</span></a>
								<ul class="liste-liens-sitemap">
									<li><a href="#">Yootel</a></li>
									<li><a href="#">Helpdesk informatique</a></li>
								</ul>
							</li>
							<li>
								<a href="#" class="circle-sitemap" id="sitemap-conseil"><span class="circle-responsive"><span class="icon-arrow-right"></span></span><span class="txt-circle-sitemap">Conseil</span></a>
								<ul class="liste-liens-sitemap">
									<li><a href="#">Conseil</a></li>
									<li><a href="#">Ingéniérie</a></li>
								</ul>
							</li>
						</ul><div class="autres-menus-sitemap">
							<ul id="autre-menu-big-sitemap">
								<li><a href="#">Actualité</a></li>
								<li><a href="#">Rse</a></li>
								<li><a href="#">Certifications</a></li>
								<li><a href="#">Richesse Humaine</a></li>
								<li><a href="#">Innovation</a></li>
								<li><a href="#">À propos</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
							<ul id="autre-menu-small-sitemap">
								<li><a href="#">Mentions légales</a></li>
								<li><a href="#">Plan d’accès</a></li>
								<li><a href="#">Presse</a></li>
							</ul>
						</div>
					</div>
					<div class="titre-modal">
						<div class="container-fond-titre-modal">
							<div class="fond-titre-modal"></div>
						</div>
						<div class="txt-titre-modal"><span class="titre-modal-large">Plan du site</span> <span class="titre-modal-small">Menu</span></div>
					</div>
					<div class="close-modal">
						<div class="container-fond-close-modal">
							<div class="fond-close-modal"></div>
						</div>
						<a href="#" id="lien-close-modal"><span class="icon-close"></span></a>
					</div>
				</nav>
			</div>
		</div>
		<div id="bloc-menu-responsive">
			<a href="#" id="menu-responsive">
				<svg class="svg-hamburger" xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14">
		            <g id="hamburger">
		                <rect class="rect1" x="0" y="0" width="18" height="2"></rect>
		                <rect class="rect2" x="0" y="6" width="18" height="2"></rect>
		                <rect class="rect3" x="0" y="12" width="18" height="2"></rect>
		            </g>
		        </svg>
		        <!--<img src="layoutImg/logo-small.png" alt="" />-->
		        <svg class="svg-logo-ima" xmlns="http://www.w3.org/2000/svg" viewBox="0 367.5 612 94">
			        <path d="M604.3,461.5v-44.7h-38.5v44.7H558v-94h7.7v7.7v33.9h38.5v-41.6h7.7v94H604.3z M504.1,455.4c10.8,0,17,0,17,0
			        	s7.7-1.5,10.8-7.7l6.2,3.1c0,0-4.6,10.8-17,10.8c-10.8,0-20,0-20,0s-17,0-17-17s0-58.6,0-58.6s-1.5-20,20-20c18.5,0,20,0,20,0
			        	s13.9,0,13.9,10.8l-6.2,3.1c0,0-3.1-7.7-10.8-7.7s-13.9,0-13.9,0s-13.9,0-13.9,13.9s0,58.6,0,58.6S493.3,455.4,504.1,455.4z
			        	 M420.8,461.5v-94h49.3v7.7h-41.6v33.9H464v7.7h-35.5v35.5h41.6v7.7h-41.6h-7.7V461.5z M385.4,461.5h-7.7v-86.3h-23.1v-7.7H407v7.7
			        	h-21.6V461.5z M337.6,461.5l-6.2-20h-24.7l-6.2,20H279l27.7-94h24.7l27.7,94H337.6z M320.6,386h-3.1l-7.7,41.6h20L320.6,386z
			        	 M254.4,389.1l-17,72.5h-20l-17-69.4v69.4h-20v-94h20h10.8l13.9,63.2h3.1l13.9-63.2h30.8v94h-20v-72.5H254.4z M146.4,367.5h23.1v94
			        	h-23.1V367.5z M119.2,397.6c0.4,0.9,14.2,36.4,14.2,36.4l-19.4,27.5H78.6l-2,0l31-42.5C107.6,419,119.7,409.8,119.2,397.6z
			        	 M78.6,423l-30.8,38.5H0l61.1-79.8C61.1,381.8,48.1,407.4,78.6,423z M101.1,422.3l-31.4,39.2H52.8l29.6-37
			        	C82.3,424.5,92.2,427.2,101.1,422.3z M116.6,393.5c0,15.1-12.3,27.4-27.4,27.4s-27.4-12.3-27.4-27.4s12.3-27.4,27.4-27.4
			        	S116.6,378.3,116.6,393.5z"/>
		        </svg>
		        
			</a>
		</div>
		<div id="bloc-retour-video">
			<a href="#" id="retour-video">
				<span class="picto-retour-video">
					<span class="icon-arrow-left"></span>
				</span>
			</a>
		</div>
	  	<footer>
	  		<div class="bandeau-footer"></div>
	  		<div class="container">
	  			<ul id="footer-elements">
	  				<li class="padding-top-footer">
	  					<nav id="nav-footer">
	  						<ul>
	  							<li><a href="#" id="lien-sitemap">Plan du site</a></li>
	  							<li><a href="#">Mentions légales</a></li>
	  							<li><a href="#">Presse</a></li>
	  							<li><a href="#">Contact</a></li>
	  							<li><a href="#">Plan d’accès</a></li>
	  						</ul>
	  					</nav>
	  				</li><li class="padding-top-footer">
	  					1, impasse Claude Nougaro - BP 40327 - 44803 Saint-Herblain cedex
	  				</li><li>
	  					<a href="tel:+33251866200" class="tel-footer">02 51 86 62 00</a>
	  				</li><li class="last padding-top-footer">
	  					Suivez nous :
	  					<ul class="social-footer">
	  						<li class="twitter"><a href="#"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-twitter"></span></a></li>
	  						<li class="linkedin"><a href="#"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-linkedin"></span></a></li>
	  						<li class="viadeo"><a href="#"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-viadeo"></span></a></li>
	  						<li class="scoopit"><a href="#"><span class="container-fond-social"><span class="fond-social"></span></span><span class="logo-footer icon-scoopit"></span></a></li>
	  					</ul>
	  				</li>
	  			</ul>
	  		</div>
	  	</footer>
		<!--[if lt IE 7 ]>
			<script src="js/libs/dd_belatedpng.js"></script>
			<script>DD_belatedPNG.fix("img, .png_bg");</script>
		<![endif]-->
		<!-- jQuery -->
		<script src="js/libs/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/libs/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/libs/jquery.cookie.js" type="text/javascript" charset="utf-8"></script>
		<!-- jsPlumb -->
		<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/jsPlumb/1.4.1/jquery.jsPlumb-1.4.1-all-min.js"></script> -->
		<!-- support lib for bezier stuff -->
		<script src="js/libs/jsPlumb/jsBezier-0.6.js"></script>
		<!-- geom functions -->
		<script src="js/libs/jsPlumb/biltong-0.2.js"></script>
		<!-- jsplumb util -->
		<script src="js/libs/jsPlumb/util.js"></script>
		<script src="js/libs/jsPlumb/browser-util.js"></script>
		<!-- base DOM adapter -->
		<script src="js/libs/jsPlumb/dom-adapter.js"></script>
		<!-- main jsplumb engine -->
		<script src="js/libs/jsPlumb/jsPlumb.js"></script>
		<!-- endpoint -->
		<script src="js/libs/jsPlumb/endpoint.js"></script>
		<!-- connection -->
		<script src="js/libs/jsPlumb/connection.js"></script>
		<!-- anchors -->
		<script src="js/libs/jsPlumb/anchors.js"></script>
		<!-- connectors, endpoint and overlays  -->
		<script src="js/libs/jsPlumb/defaults.js"></script>
		<!-- bezier connectors -->
		<script src="js/libs/jsPlumb/connectors-bezier.js"></script>
		<!-- state machine connectors -->
		<script src="js/libs/jsPlumb/connectors-statemachine.js"></script>
		<!-- flowchart connectors -->
		<script src="js/libs/jsPlumb/connectors-flowchart.js"></script>
		<!-- SVG renderer -->
		<script src="js/libs/jsPlumb/renderers-svg.js"></script>
		<!-- vml renderer -->
		<script src="js/libs/jsPlumb/renderers-vml.js"></script>
		<script src="js/libs/jsPlumb/connector-editors.js"></script>
		<!-- jquery jsPlumb adapter -->
		<script src="js/libs/jsPlumb/jquery.jsPlumb.js"></script>
		
		<!-- Tweens -->
		<script src="js/libs/greensock/TweenMax.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/libs/greensock/TimelineMax.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/libs/greensock/plugins/BezierPlugin.min.js" type="text/javascript" charset="utf-8"></script>
		
		<!-- BigVideo -->
		<script src="js/libs/videojs/bigvideo.js" type="text/javascript" charset="utf-8"></script>
		
		<script src="js/script.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
