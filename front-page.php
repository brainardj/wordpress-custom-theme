<?php
/*
Template Name: Homepage Template
*/
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage wireframe
 * @since 1.0
 * @version 1.0
 */
 

get_header(); ?>



		<?php
		// Get each of our panels and show the post data.
		if ( confget("show-homepage-recent-posts") && (0 !== wireframe_panel_count() || is_customize_preview() )) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param int $num_sections Number of front page sections.
			 */
			$num_sections = apply_filters( 'wireframe_front_page_sections', 4 );
			global $wireframecounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$wireframecounter = $i;
				wireframe_front_page_section( null, $i );
			}

		endif; // The if ( 0 !== wireframe_panel_count() ) ends here.
		?>


		<?php if(wireframe_has_menu_content()): ?>
		
		<div class="homePageMenus">
			<div class="homepage-menu-column">
			
			
			<?php if(has_nav_menu('menu-loc-1')):  ?>
				<div class="trevor-menu trevor-about-menus">
					<div class="trevor-menu-label trevor-about-menu-label">Menu #1</div>
					<?php wp_nav_menu( array('theme_location' => 'menu-loc-1','fallback_cb'=>false)); ?>
				</div>
			<?php endif; ?>
			
			
			<?php if(has_nav_menu('menu-loc-2')):  ?>
				<div class="trevor-menu trevor-member-menus">
					<div class="trevor-menu-label trevor-members-menu-label">Menu #2</div>
					<?php wp_nav_menu( array('theme_location' => 'menu-loc-1','fallback_cb'=>false)); ?>
				</div>
			<?php endif; ?>
			
			
			<?php if(has_nav_menu('menu-loc-3')):  ?>
				<div class="trevor-menu trevor-resources-menus">
					<div class="trevor-menu-label trevor-resources-menu-label">Menu #3</div>
					<?php wp_nav_menu( array('theme_location' => 'menu-loc-1','fallback_cb'=>false)); ?>
				</div>
			<?php endif; ?>
		
			</div>
		</div>
		
		<?php endif; ?>		

		
		<?php echo wireframe_homepage_sections(); ?>
		<?php echo wireframe_homepage_pages(); ?>

		<div class="trevor-posts-container">
			<div class="trevor-posts" >
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<?php
						wp_reset_query();
						$query = new WP_Query( array( 'post_type' => 'post' ) );
						// Show the selected front page content.
						if ($query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								get_template_part( 'template-parts/page/content', 'front-page-trevor' );
							endwhile;
						else :
							get_template_part( 'template-parts/post/content', 'none' );
						endif;
						?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
<?php
get_footer();
