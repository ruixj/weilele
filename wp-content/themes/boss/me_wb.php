<?php
 /* 
 Template Name: me_wb
 */
?>
<!DOCTYPE html>
<html class="pixel-ratio-1" lang="zh-cmn-Hans">

<?php wp_head(); ?>
 <style>
html {
    font-size: 50px;
    font-family:PingFang-SC-Regular,Helvetica,sans-serif;
 
color:#333
}
 
body{
-webkit-text-size-adjust:none;
background:#f2f2f2
}
 </style>
<body>
<?php get_template_part( 'template-parts/header-mobile2' ); ?>
<?php xrui_bp_user_screen(); ?>

 
<?php wp_footer(); ?>
</body>

</html>