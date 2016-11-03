=== Useso take over Google ===
Contributors: xiaoxu125634
Donate link: http://www.brunoxu.com/
Tags: Open Sans, Google Fonts, Google Web Fonts, useso, 360前端公共库, Google字体库, Google公共库, Useso公共库, Useso字体库
Requires at least: 3.0
Tested up to: 4.6.1
Stable tag: trunk

替换所有的Google字体、谷歌JS公用库、Gravatar头像为geekzu资源。

== Description ==

[插件首页](http://www.brunoxu.com/useso-take-over-google.html) | [插件作者](http://www.brunoxu.com/)

前面做了一个去除Google字体插件：<a href="http://wordpress.org/plugins/remove-google-fonts-references/">Remove Google Fonts References</a>，用来去除所有页面中的Google字体引用，避免网页打开速度被严重拖慢。

~~~如果不去掉Google资源引用，使用360前端公共库会怎么样，因为http://libs.useso.com/提供了国内可访问的替换方案，基于useso就开发出了这个插件：Useso take over Google。~~~

~~~插件会自动把所有页面中出现的对Google字体、Google公共库的引用，换成对useso的引用，保证国内能正常访问资源。~~~

~~~插件无需设置，安装激活后即刻生效。~~~

本插件会把页面中所有的Google字体、谷歌JS公用库、Gravatar头像 换成geekzu资源，保证国内用户可以正常访问网站。

【2016-09-18更新】因为360前端库停用，为了使用本插件的网站能正常工作，本插件从1.7版本开始使用geekzu资源替代。

== Installation ==

1. Upload `useso-take-over-google` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress background.

== Changelog ==

= 1.7 =
* 2016-09-18
* 因为360前端库停用，改用geekzu资源。

= 1.6.5 =
* 2016-06-17
* 修复Avada主题的webfont.js不兼容问题。

= 1.6.4 =
* 2015-09-13
* gravatar头像处理补充：现在出现了s.gravatar.com这样的连接。

= 1.6.3 =
* 2015-08-25
* 加上处理：部分http网站还会有https://fonts.useso.com/连接。
* 增加处理的gravatar头像图片处理的安全性，保证不会影响到文章内容中的出现。
* 不要启用wpjam-qiniu插件的“使用 360 前端公共库”功能，启用时编辑插件会导致插件失效。
* 本次更新修复了上面的潜在危险，但还是强烈建议检查下，保证没有启用“使用 360 前端公共库”功能。

= 1.6.2 =
* 2015-07-24
* Fix font resource url in webfont_https_v1.5.3.js.
* Add two filters: "useso_take_over_google_content_filter_before" and "useso_take_over_google_content_filter_after", used for handling page content.

= 1.6.1 =
* 2015-07-09
* Use "geekzu.org" resource take over all gravatar imgs.

= 1.6.1 =
* 2015-07-08
* Replace "lug.ustc.edu.cn" resouces with "geekzu.org" resouces.
* Add handler for "secure.gravatar.com" images.

= 1.6 =
* 2015-07-06
* Replace gravatar imgs with gravatar.duoshuo.com resources.

= 1.5 =
* 2014-10-05
* Use lug.ustc.edu.cn resources when SSL is used.

= 1.4 =
* 2014-09-25
* Solved google fonts imported by 'Web Font Loader'.

= 1.3 =
* 2014-09-20
* Add theme 'pinnacle'(use redux framework) compatibility.

= 1.2 =
* 2014-09-10
* Cover another reference method like '@import url(...)'.
* Optimized action hooks.

= 1.1 =
* 2014-08-26
* Cover login and register page.

= 1.0 =
* 2014-08-22
* First released version.
