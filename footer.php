
		<div id="footer">
				<div id="sidnavigering">
					<?php wp_pagenavi(); ?>
				</div>
			<div id="footer-container">
				<div id="footers-1">
					<div id="footer-area1">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Footer 1') ) : ?> <?php endif; ?>
					</div><!-- END FOOTER-AREA1 -->
					<div id="footer-area2">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Footer 2') ) : ?> <?php endif; ?>
					</div><!-- END FOOTER-AREA2 -->
				</div><!-- END FOOTERS1 -->
				<div id="footers-2">
					<div id="footer-area3">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Footer 3') ) : ?> <?php endif; ?>
					</div><!-- END FOOTER-AREA3 -->
					<div id="footer-area4">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Footer 4') ) : ?> <?php endif; ?>
					</div><!-- END FOOTER-AREA4 -->
				</div><!-- END FOOTERS2 -->
			</div><!-- END FOOTER-CONTAINER -->
		</div><!-- END FOOTER -->
	</div> <!-- END WRAPPER -->
<?php	wp_footer(); ?>
</body>
</html>
