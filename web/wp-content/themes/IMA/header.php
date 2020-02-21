<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js gt-ie9" lang="fr"> <!--<![endif]-->

<head>
<meta charset="utf8" />

<title>
	<?php if(is_front_page()){ bloginfo('name'); echo ' - '; } ?>
	<?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
</title>

<meta name='viewport' content='width=device-width,initial-scale=1'>
<meta name="format-detection" content="telephone=no" />

<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">
<link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#fff">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">

<link rel='alternate' type='application/rss+xml' title='<?php bloginfo('name'); ?> Feed' href='<?php echo get_bloginfo('rss2_url') ?>'>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-21236816-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-21236816-1');
</script>

<?php wp_head(); ?>

</head>

<?php
    $embed = (isset($_GET['embed-ima']) && $_GET['embed-ima']) ? true : false;
    $theme = get_field('theme_page');
    if( get_field('bloc_media') ) $theme .= ' has-video';
    if( get_field('blocs') ) $theme .= ' has-bloc-small';
    if( is_front_page() ) $theme .= ' accueil';
    if( is_page_template('logos-miniatures.php') ) $theme .= ' clipboard';
?>

<body <?php if( is_front_page() ) echo ' id="body-accueil" '; body_class( $theme ); if($embed) echo 'style="background:none;"' ?>>
	<section id="wrapper-content">
    <?php include('includes/header.php'); ?>
		<div class="container clearfix">
			<?php include('includes/burger.php'); ?>
			<section id="content">
