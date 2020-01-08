<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage wireframe
 * @since 1.0
 * @version 1.0
 */

?>

<?php if(true || !is_active_sidebar('sidebar-6')): ?>
	<div class="widget-area footer-default-widget-left">
		<img class="default-social" src="<?php echo get_template_directory_uri(); ?>/assets/images/default-facebook-icon.png" style="height:47px;" />
		<img class="default-social" src="<?php echo get_template_directory_uri(); ?>/assets/images/default-twitter-icon.png" style="height:47px;" />
	</div>
<?php endif; ?> 



<?php if(is_active_sidebar( 'sidebar-6' ) ): ?>

	<aside class="widget-area footer-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'wireframe' ); ?>">
		<div class="widget-column horizontal footer-widget-area-left site-info">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</div>
	</aside><!-- .widget-area -->

<?php endif; ?>
