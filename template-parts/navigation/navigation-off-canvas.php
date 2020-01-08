<?php
/**
 * Displays main navigation
 *
 * @package WordPress
 * @subpackage wireframe
 * @since 1.0
 * @version 1.2
 */

?>
<!--USE A ID & CLASSNAME OF "main-navigation" if you want to have the menu collapsible on smaller screens-->
<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'wireframe' ); ?>">

	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'main',
				'menu_id'        => 'main-menu',
			)
		);
	?>

</nav>
