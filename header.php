<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sub_Rosa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); 
$template_class=false;
if ( is_front_page() && is_home() ){
	$top_post=wp_get_recent_posts(array('numberposts=>1'));
	$template_class=carbon_get_post_meta( $top_post[0]['ID'], 'sr_template' );
}
?>
<div id="page" class="site <?php echo $template_class?$template_class:''; ?>">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'subrosa' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<a href="<?php echo get_site_url(); ?>">
				<div class="logo logo--big"><?php echo file_get_contents(get_stylesheet_directory_uri().'/assets/logo.svg'); ?></div>
				<div class="logo logo--small"><?php echo file_get_contents(get_stylesheet_directory_uri().'/assets/logo_small.svg'); ?></div>
			</a>
		</div><!-- .site-branding -->
		<button class="hamburger hamburger--arrow" aria-expanded="false" type="button" id="hamburger">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<nav id="site-navigation" class="main-navigation">
			<div class="nav-inner">
				<a href="<?php echo get_site_url(); ?>">
					<div class="logo logo--nav"><?php echo file_get_contents(get_stylesheet_directory_uri().'/assets/logo_small.svg'); ?></div>
				</a>
				<p>From the global margins</p>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
				<?php get_search_form(); ?>
				<?php subrosa_social_media(); ?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
			<div id="jump-fix"></div>