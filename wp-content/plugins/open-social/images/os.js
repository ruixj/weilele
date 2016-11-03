var browser = {
    versions: function () {
        var u = navigator.userAgent, app = navigator.appVersion;
        return {         //移动终端浏览器版本信息
            trident: u.indexOf('Trident') > -1, //IE内核
            presto: u.indexOf('Presto') > -1, //opera内核
            webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
            gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
            mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
            ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
            android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
            iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
            iPad: u.indexOf('iPad') > -1, //是否iPad
            webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
        };
    }(),
    language: (navigator.browserLanguage || navigator.language).toLowerCase()
}

function isPc()
{
	if (browser.versions.mobile) {//判断是否是移动设备打开。browser代码在下面
		var ua = navigator.userAgent.toLowerCase();//获取判断用的对象
		if (ua.match(/MicroMessenger/i) == "micromessenger") {
				//在微信中打开
		}
		if (ua.match(/WeiBo/i) == "weibo") {
				//在新浪微博客户端打开
		}
		if (ua.match(/QQ/i) == "qq") {
				//在QQ空间打开
		}
		if (browser.versions.ios) {
				//是否在IOS浏览器打开
		} 
		if(browser.versions.android){
				//是否在安卓浏览器打开
		}
		return false;
	} else {
		//否则就是PC浏览器打开
		return true;
	}
}

function login_button_click(id,link){
	var back = location.href;
	if('wechat' == id)
	{
		id = 'wechatle';
	}
    if('wordpress'==id){
		location.href = link;
	}else {
		try{
			if(back.indexOf('wp-login.php')>0) 
				back = document.loginform.redirect_to.value;
		}
		catch(e)
		{
			back = '/';
		}
		
		if(back.indexOf('profile.php')>0 && back.indexOf('updated')<0) 
			back = back.indexOf('?')>0 ? (back + '&updated=1') : (back + '?updated=1');
		
		location.href=(link?link:'/')+'?connect='+id+'&action=login&back='+escape(back);
	}
}

function login_button_unbind_click(id,link){
	var back = location.href;
	if(back.indexOf('profile.php')>0 && back.indexOf('updated')<0) 
		back = back.indexOf('?')>0 ? (back + '&updated=1') : (back + '?updated=1');
	location.href = (link?link:'/')+'?connect='+id+'&action=unbind&back='+escape(back);
}

function share_button_click(link,ev){
	if(link=='QRCODE'){
		if(!window.jQuery) return;
		var elm = ev.srcElement || ev.target;
		var qrDiv = jQuery(elm).parent().find('.open_social_qrcode');
		if(!qrDiv.find('canvas').length){
			qrDiv.qrcode({width:180,height:180,correctLevel:0,background:'#fff',foreground:'#111',text:location.href});
		}
		qrDiv.toggle(250);
	}else{
		var url = encodeURIComponent(location.href);
		var title = encodeURIComponent(document.title + (window.jQuery ? (': ' + jQuery('article .entry-content').text().replace(/\r|\n|\t/g,'').replace(/ +/g,' ').replace(/<!--(.*)\/\/-->/g,'').substr(0,100)) : ''));
		var pic = '';
		window.jQuery && jQuery('#content > article img').each(function(){pic+=(pic?'||':'')+encodeURIComponent(jQuery(this).attr('src'));});
		window.open(link.replace("%URL%",url).replace("%TITLE%",title).replace("%PIC%",pic),'xmOpenWindow','width=600,height=480,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1');
	}
}

window.jQuery && jQuery(document).ready(function($){
    try{
    	$('.open_social_box').tooltip({ position: { my: "left top+5", at: "left bottom" }, show: { effect: "blind", duration: 200 } });
    }
	catch(e)
	{
		
	}
	
	$("img.avatar[ip*='.']").each(
		function(){
			$(this).click(
				function(){
					window.open("http://www.baidu.com/s?wd="+$(this).attr('ip'));
				});
	});
	
	$('.comment-content a,.comments-area a.url').each(
		function(){$(this).attr('target','_blank');}
	);
	
    var float_button = $("#open_social_float_button");
	
	if(!$("#respond")[0]) 
		$('#open_social_float_button_comment').hide();
	
    $(window).scroll(function() {
		if(float_button[0]){
	        if ($(window).scrollTop() >= 300) {
	            $('#open_social_float_button').fadeIn(250);
	        } else {
	            $('#open_social_float_button').fadeOut(250);
	        }
		}
    });
	
    $('#open_social_float_button_top').click(function() {
        $('html,body').animate({
            scrollTop: '0px'
        },
        100);
    });
	
    $('#open_social_float_button_comment').click(function() {
        $('html,body').animate({
            scrollTop: $('#respond').offset().top
        },
        200);
    });
	
	var bIsPc = isPc();
	var wechat_div = $("#wechat");
	var wechatle_div = $("#wechatle");
	var wechatqr_div = $("#wechatqr");
	if(bIsPc)
	{
		if(wechat_div)
			wechat_div.hide();
		
		if(wechatle_div)
			wechatle_div.hide();
	}
	else
	{
		if(wechatqr_div)
			wechatqr_div.hide();
		
		if(wechat_div)
			wechat_div.hide();		
	}
});
