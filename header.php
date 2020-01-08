<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage wireframe
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Prompt&display=swap" rel="stylesheet" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="<?php print wireframe_body_styles(array("background-color","color")); ?>">

	<?php get_template_part('template-parts/overlay/overlay'); ?>
		
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wireframe' ); ?></a>


		<?php get_template_part('template-parts/header/global-header'); ?>


		<?php if(!is_inner_page()) {
			get_template_part('template-parts/header/banner');
		} ?>

		
		
		<!--If a regular post or page, and not the front page, show the featured image.
		Using get_queried_object_id() here since the $post global may not be set before a call to the_post().-->
		<?php
		if ( ( is_single() || ( is_page() && ! wireframe_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
			echo '<div class="single-featured-image-header">';
			echo get_the_post_thumbnail( get_queried_object_id(), 'wireframe-featured-image' );
			echo '</div><!-- .single-featured-image-header -->';
		endif;
		?>

		<div class="site-content-contain">
			<div id="content" class="site-content">
