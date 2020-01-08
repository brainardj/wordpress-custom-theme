		<header id="masthead" class="site-header" style="<?php echo wireframe_get_css("site-header"); ?>;" role="banner">
			
			<?php if(true || strtolower(wp_get_theme()) != "wireframe"): ?>
				<?php if(!wireframe_has_prop("site-header","background-image")): ?>
					<img src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				<?php endif; ?>
			<?php else: ?>
				<?php if(!wireframe_has_prop("site-header","background-image")): ?>
					<img class="default-header" src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
				<?php endif; ?>
			<?php endif; ?>
			

			<!--BANNER WIDGET AREAS--> 
			<!--Left Banner Widget Area -->
			<?php if(is_active_sidebar('sidebar-3')): ?>
				<div class="widget-area banner-widget-area-left">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
			<?php endif; ?>

			<!--Center Banner Widget Area -->
			<?php if(is_active_sidebar('sidebar-4')): ?>
				<div class="widget-area banner-widget-area-left">
					<?php dynamic_sidebar( 'sidebar-4' ); ?>
				</div>
			<?php endif; ?>
		
		
			<!--Right Banner Widget Area -->
			<?php if(is_active_sidebar('sidebar-5')): ?>
				<div class="widget-area banner-widget-area-left">
					<?php dynamic_sidebar( 'sidebar-5' ); ?>
				</div>
			<?php endif; ?>
		
		
			<div class="widget-area banner-tagline-container">
				<strong class="tagline"> 
					<?php 
						if (strtolower(wp_get_theme()) == "wireframe" || get_bloginfo('description','display')=="Just another WordPress site")
							echo "Your Company Tagline Here";
						else
							echo get_bloginfo( 'description', 'display' ); 
					?>
				</strong>
			</div> <!--tagline-container-->
		


		</header><!-- #masthead -->