<!--MAIN NAVIGATION-->


<div id="overlay" class="overlay drawer-off" data-animation="drawer">

	<div class="overlay-content">

	<div class="toggles icon toggles-overlay" data-controls="overlay">&nbsp;</div>
	
	
		<?php if(is_child_theme_active() && !empty(get_theme_mod('custom_logo'))):
			the_custom_logo();
		else: ?>
			<a href="<?php print get_home_url(); ?>" class="custom-logo-link" rel="home">
				<img class="default-logo-overlay" alt="default logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/defaultLogo.png" />
			</a>
		<?php endif; ?>
		
		
		<?php if(has_nav_menu('main')): ?>
			<div class="navigation-main">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'off-canvas' );?>
				</div>
			</div>
		<?php endif; ?>


	</div>
	
</div>