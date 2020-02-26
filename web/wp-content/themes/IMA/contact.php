<?php
/*
Template Name: Contact
*/

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
$mailto = get_field('contact_mail');;

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
		$sent = mail( $mailto, $subject, $headers );
		if($sent) {
			$message_status = "Demande envoyée";
		}
		else{ 
			$message_status = "Erreur"; 	
			$erreurEnvoi = "Votre message n'a pas pu être envoyé. Veuillez réessayer!";
		}
	}
}

get_header('contact'); ?>
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
		<div class="bloc-full bloc-penche" id="zone-actus">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

				<div class="ribbon-copie">
					<div class="fond-ribbon"><div class="ribbon-join ribbon-bleu"></div></div>
					<div class="ribbon-content"></div>
				</div>
				<div class="fond-bloc"></div>

				<div class="bloc-content" id="bloc-actus">
					<?php $ID = get_the_ID(); ?>

					<p><?php formatTexte(get_field('contact_txt')); ?><br /> Vous pouvez nous contacter par email à <a class="btn-bleu" href="mailto:<?php the_field('contact_mail'); ?>"><?php the_field('contact_mail'); ?></a> ou par téléphone au&nbsp;<nobr><strong><?php the_field('contact_tel'); ?></strong></nobr></p>
					<p><?php formatTexte(get_field('contact_form')); ?></p>

					<form method="POST" action="<?php echo get_permalink( $ID ); ?>">
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
						</fieldset>
                        <fieldset>
                            <p class='under-form'><?php the_field('contact_under') ?></p>
                        </fieldset><br/>
						<button class="btn-form" name="submitted" <?php if($message_status == 'Demande envoyée'){ echo 'disabled';}?>>
							<span class="txt-btn-form">Envoyer</span>
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

				<?php endwhile; ?>

			<?php endif; ?>

		</div>

	</div><!-- #primary .content-area -->

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
		<span class="txt-bloc-deform-adresse"><?php the_field('contact_adresse'); ?><br /><br />Téléphone :<br /> <strong><?php the_field('contact_tel'); ?></strong><br /><br /> <a class="btn-bleu" href="mailto:<?php the_field('contact_mail'); ?>"><?php the_field('contact_mail'); ?></a></span>
		<a href="<?php the_field('contact_maps'); ?>" target="_blank" class="detail-bloc-adresse">
			<span class="container-fond-detail-bloc-adresse">
				<span class="fond-detail-bloc-adresse"></span>
			</span>
			<span class="txt-detail-bloc-adresse">Voir l'itinéraire</span>
		</a>
	</div>
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

<?php get_footer(); ?>