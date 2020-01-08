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

<?php if(!is_active_sidebar('sidebar-7')){?>
	<div class="footer-default-widget-center">
		<img class="default-social" src="<?php echo get_template_directory_uri(); ?>/assets/images/default-facebook-icon.png" style="height:47px;" />
		<img class="default-social" src="<?php echo get_template_directory_uri(); ?>/assets/images/default-twitter-icon.png" style="height:47px;" />
	</div>
<?php } ?> 

<?php
if (is_active_sidebar( 'sidebar-7' ) ) :
	?>

	<aside class="widget-area footer-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'wireframe' ); ?>">
		<?php
		if ( is_active_sidebar( 'sidebar-7' ) ) {
			?>
			<div class="widget-column footer-widget-area-center site-info">
				<?php dynamic_sidebar( 'sidebar-7' ); ?>
			</div>
		<?php } ?>
	</aside><!-- .widget-area -->

<?php endif; ?>
