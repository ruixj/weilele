<?php
 /* 
 Template Name: channels
 */
?>
<!DOCTYPE html>
 

<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="msapplication-tap-highlight" content="no"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!-- BuddyPress and bbPress Stylesheets are called in wp_head, if plugins are activated -->
	<?php wp_head(); ?>
</head>

<?php
	global $rtl;
	$logo	 = ( boss_get_option( 'logo_switch' ) && boss_get_option( 'boss_logo', 'id' ) ) ? '1' : '0';
	$inputs	 = ( boss_get_option( 'boss_inputs' ) ) ? '1' : '0';
	$boxed	 =   boss_get_option( 'boss_layout_style' );

	$header_style = boss_get_option('boss_header');
?>

<body>
	<?php get_template_part( 'template-parts/header-mobile2' ); ?>
	<div id="inner-wrap">
		<div class="channel-sub-nav wll-sub-nav">
			<?php
			 
				echo wp_nav_menu(
					array( 'theme_location'   => 'left-panel-menu',
							'menu_class'      => 'nav navbar-nav',
							'container'       => false,
							'depth'			  => 1,
							'echo'			  => false,
							'walker'		  => new BuddybossWalkerlele
					)
				);
		 
			?>
		</div>
	</div>

<div id="toheader">
	<a href="#scroll-to" class="to-top fa fa-angle-up scroll"></a>
</div>
<!--div class="bottom-bar">

    <div class="func-wrap wll-footer">
	  
		<ul class="m-bar">
		   
		</ul>	
	 
    </div>
	   
</div-->
<?php xrui_displayfooter_nav(); ?>
<?php wp_footer(); ?>
</body>

</html>