<?php
/**
 * Header file common to all
 * templates
 *
 */
?>
<!doctype html>
<html class="site no-js" <?php language_attributes(); ?> data-html>
<head>
	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	
	<title><?php wp_title(); ?></title>

	<?php // replace the no-js class with js on the html element ?>
	<script>document.documentElement.className=document.documentElement.className.replace(/\bno-js\b/,'js')</script>

	<?php // load the core js polyfills ?>
	<script async defer src="<?php echo get_template_directory_uri(); ?>/assets/js/core.js"></script>

	<?php wp_head(); ?>

    <?php echo Component_Favicon::the_favicon(); ?>
    <?php // echo Component_Fb::include_fb_sdk(); ?>
</head>
<body class="site__body">
<?php // <body> closes in footer.php ?>



<?php // common header content goes here ?>

<?php
    if (is_user_logged_in()) : ?>
        <header class="header">
            <?php  Component_Menu::the_menu('primary'); ?>
        </header>
    <?php endif;
?>
