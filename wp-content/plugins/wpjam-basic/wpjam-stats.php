<?php

add_action("wp_head","wpjam_stats");
function wpjam_stats(){ ?>

<?php if(wpjam_basic_get_setting('google_analytics_id')){ ?>
<!-- Google Analytics Begin-->
<?php if(wpjam_basic_get_setting('google_universal')){?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', '<?php echo wpjam_basic_get_setting('google_analytics_id');?>', 'auto');
<?php if(is_404()){?>
ga('send', 'pageview', '<?php echo '/404'.$_SERVER["REQUEST_URI"]; ?>');
<?php } else { ?>
ga('send', 'pageview');
<?php } ?>
</script>
<?php } else { ?>
<script type="text/javascript">
var _gaq = _gaq || [];
var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
_gaq.push(['_require', 'inpage_linkid', pluginUrl]);
_gaq.push(['_setAccount', '<?php echo wpjam_basic_get_setting('google_analytics_id');?>']);
<?php if(is_404()){?>
_gaq.push(['_trackPageview', '<?php echo '/404'.$_SERVER["REQUEST_URI"]; ?>']);
<?php } else{ ?>
_gaq.push(['_trackPageview']);
<?php }?>
_gaq.push(['_trackPageLoadTime']);
(function() {
	var ga = document.createElement('script');
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	ga.setAttribute('async', 'true');
	document.getElementsByTagName('head')[0].appendChild(ga);
})();
</script>
<?php } ?>
<!-- Google Analytics End -->
<?php } ?>

<?php if(wpjam_basic_get_setting('baidu_tongji_id')){ ?>
<!-- Baidu Tongji Start -->
<script type="text/javascript">
var _hmt = _hmt || [];
<?php if(is_404()){?>
_hmt.push(['_setAutoPageview', false]);
_hmt.push(['_trackPageview', '<?php echo '/404'.$_SERVER["REQUEST_URI"]; ?>']);
<?php } ?>

(function() {
var hm = document.createElement("script");
hm.src = "//hm.baidu.com/hm.js?<?php echo wpjam_basic_get_setting('baidu_tongji_id');?>";
hm.setAttribute('async', 'true');
//document.documentElement.firstChild.appendChild(hm);
document.getElementsByTagName('head')[0].appendChild(hm);
//var s = document.getElementsByTagName("script")[0]; 
//s.parentNode.insertBefore(hm, s);
})();
</script>
<!-- Baidu Tongji  End -->
<?php } ?>

<?php }