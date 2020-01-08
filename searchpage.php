<?php
/*
Template Name: Search Template
*/
require("/var/www/wordpress/wp-content/plugins/search/search-funcs.php");
define('USE_SIDEBAR_MENU',False);
get_header(); ?>
<style type="text/css">
	.search-result-product h6:before {
		content: 'Product: '
	}
	
	.search-result-case-review h6:before {
		content: 'Case Review: '
	}
	
	.search-result-blog h6:before {
		content: 'Blog: '
	}
</style>
<div class="wrap">

	<?php if(USE_SIDEBAR_MENU): ?>
	<div class="custom-sidebar structure">
	
		<nav class="navigation" role="navigation" aria-label="<?php esc_attr_e( 'Sidebar Menu', 'wireframe' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'sidebar',
						'menu_id'				 => 'sidebar-menu'
					)
				);
			?>
		</nav><!-- .navigation -->


		<?php dynamic_sidebar( 'sidebar-first' ); ?>
	</div>
	<?php endif; ?>

	<div id="primary" class="content-area">
	
		<?php dynamic_sidebar( 'widgets-top' ); ?>
	
		<h2>Search Results</h2>
		
		
	
		<main id="main" class="site-main search-results" role="main">


		<?php
		
		
			// $all_results = array(new SearchResult(),new SearchResult());
		
			function show_groups($result_groups){
				foreach($result_groups as $type => $results){
					if(!count($result_groups[$type])>0) continue;
					print "<div class='search-results-group'><h3>".result_type_name($type)."</h3>";
					foreach($results as $result) {
						print search_result($result);
					}
					print "</div>";
				}
			}
		
			function show_all($results){
				foreach($results as $result){
					// if(!count($result_groups[$type])>0) continue;
					print "<div class='search-result search-result'>";/*<?php print $result->getType(); ?>'>";*/
						print search_result($result);
					print "</div>";
				}
			}
			
			show_all($results['all']);

		?>
		


		</main><!-- #main -->
		

		<div class="other-results">
			<div class="other-results-content">
			<div class="search-results-group">
				<h3>OCDLA Products</h3>
			</div>
		
			<div class="search-results-group">
				<h3>OCDLA Events</h3>
			</div>
			</div>
		</div>
		
		
		
	</div><!-- #primary -->

	<?php 
		get_sidebar();
	?>
</div><!-- .wrap -->

<?php
get_footer();