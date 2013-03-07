<?php
	$withcomments = 1; // Visar upp kommentarer även på förstasidan
	get_header(); ?>
	<div id="middle-container">
			<div id="content">
				<?php get_template_part( 'loop', 'index' ); ?>
			</div><!-- END CONTENT -->
			<div id="sidebars">
				<div id="sidebar1">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 1') ) : ?> <?php endif; ?>
				</div> <!-- END SIDEBAR1 -->
				<div id="sidebar2">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 2') ) : ?> <?php endif; ?>
				</div> <!-- END SIDEBAR2 -->
			</div><!-- END SIDEBARS -->
		</div><!-- END MIDDLE-CONTAINER -->
		<?php get_footer(); ?>
