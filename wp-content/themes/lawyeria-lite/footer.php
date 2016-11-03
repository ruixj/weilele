		<?php
		/**
		 *  The template for displaying Footer.
		 *
		 *  @package lawyeria-lite
		 */
		?>
		<footer id="footer">
			<div class="wrapper cf">
				<div class="footer-margin-left cf">
					<?php
						if ( is_active_sidebar( 'footer-sidebar' ) ) {
							dynamic_sidebar( 'footer-sidebar' );
						} else {
							echo '<div class="footer-box">'.__('The sidebar is not active.','lawyeria-lite').'</div>';
						}
					?>
				</div><!--/div .footer-margin-left .cf-->
				<?php echo '<div class="lawyeria_lite_poweredby"><a class="" href="https://themeisle.com/themes/lawyeria-lite/" target="_blank" rel="nofollow">Lawyeria Lite </a>'.__('powered by','lawyeria-lite').'<a class="" href="http://wordpress.org/" target="_blank" rel="nofollow"> WordPress</a></div>'; ?>
			</div><!--/div .wrapper .cf-->
		</footer><!--/footer #footer-->
		<?php wp_footer(); ?>
	</body>
</html>
