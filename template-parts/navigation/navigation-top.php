<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage wireframe
 * @since 1.0
 * @version 1.2
 */

?>
<!--USE ID & CLASSNAME OF "main-navigation" if you want to have the menu collapsible on smaller screens?-->
<nav class="menu collapsible menu-button" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'wireframe' ); ?>">

	<?php if(has_nav_menu('top')):
		wp_nav_menu(
			array(
				'theme_location' => 'top',
				'menu_id'        => 'top-menu',
				'menu_class'		 => 'horizontal light-background'
			)
		);
	endif; ?>

</nav>