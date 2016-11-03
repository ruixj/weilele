jQuery(document).ready(function() {

	jQuery('.wp-full-overlay-sidebar-content').prepend('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://wordpress.org/support/view/theme-reviews/lawyeria-lite" class="button" target="_blank">{review}</a>'.replace('{review}',objectL10n.review));	
	jQuery('.wp-full-overlay-sidebar-content').prepend('<a style="width: 80%; margin: 5px auto 20px auto; display: block; text-align: center;" href="http://themeisle.com/documentation-lawyeria-lite" class="button" target="_blank">{documentation}</a>'.replace('{documentation}',objectL10n.documentation));	
	jQuery('.wp-full-overlay-sidebar-content').prepend('<a style="width: 80%; margin: 20px auto 5px auto; display: block; text-align: center;" href="https://themeisle.com/themes/lawyeria-attorney-lawyer-wordpress-theme/" class="button" target="_blank">{pro}</a>'.replace('{pro}',objectL10n.pro));
	
});
