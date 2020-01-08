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


<?php if(is_active_sidebar( 'sidebar-8' ) ): ?>

	<aside class="widget-area footer-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'wireframe' ); ?>">
		<div class="widget-column footer-widget-area-left site-info">
			<?php dynamic_sidebar( 'sidebar-8' ); ?>
		</div>
	</aside><!-- .widget-area -->

<?php endif; ?>
