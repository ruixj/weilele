=== Open Social ===

Contributors: playes
Donate link: https://www.xiaomac.com/201311150.html
Tags: china, afly, social, login, connect, qq, sina, weibo, baidu, google, live, douban, renren, kaixin001, openid, xiaomi, wechat, QQ登陆, 新浪微博, 百度, 谷歌, 豆瓣, 人人网, 开心网, 登录, 连接, 注册, 分享, 小米, 微信
Requires at least: 3.0
Tested up to: 4.6
Stable tag: 1.6.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Login or Share with social networks: QQ, WeiBo, Baidu, Google, Microsoft, DouBan, XiaoMi, WeChat, GitHub, Twitter, Facebook. No API! Single PHP!

== Description ==

Login or Share with social networks: QQ, WeiBo, Baidu, Google, Microsoft, DouBan, XiaoMi, WeChat, GitHub, Twitter, Facebook. No API! Single PHP!

### 功能特点 ###

1. 支持登陆：腾讯QQ、新浪微博、百度、谷歌、豆瓣、微信、微软、脸书、推特等
2. 支持分享：QQ空间、新浪微博、微信、脸书、推特
3. 带昵称网址头像、无第三方平台、可设置右侧小工具

### 关于购买 ###

1. 免费版功能完善稳定，基本停止更新。
2. 付费版 Open Social: ￥180，[点此购买](https://selfstore.io/products/587)（需注册）
3. 购买后请如需帮助或支持可添加 [QQ](https://www.xiaomac.com/about) 好友

### 升级过渡 ###

1. 免费版在后台名字为 Open Social，最高版本为 1.6.4，页面标识为 open-social/open-social
2. 付费版名字不变依然为 Open Social，版本为最新，页面标识为 open-social
3. 升级时直接覆盖原目录，旧版配置会自动保留。

### 版本对比 ###

	免费版
	时间：2013-2015
	性质：自用，开源，很随意，较粗糙
	功能：自动登陆，随机账号，微信仅支持开放号
	定位：定制性不高的个人博客，社交登陆初体验者

	付费版
	时间：2016～
	性质：负责，专注，按需开发，精益求精
	功能：定制登陆，支持绑定，微博同步，支持多站
	定位：对用户体验有体会和需求的博客玩家
	策略：一次购买，无使用时间限制；小版本免费升级，大版本会酌情涨价
	使用：单文件，无加密，无环境要求；一次购买可自用多个网站，谢绝另行分享及转卖

更多: [https://www.xiaomac.com/201311150.html](https://www.xiaomac.com/201311150.html)

== Installation ==

1. Upload the plugin folder to the "/wp-content/plugins/" directory of your WordPress site,
2. Activate the plugin through the 'Plugins' menu in WordPress,
3. Visit the "Settings \ Open Social Setting" administration page to setup the plugin. 

== Frequently Asked Questions ==

= 回调连接需要怎么设置？ =

通常跟网站域名一致（一致意思是一模一样），如 [https://www.xiaomac.com/]，末尾要保留斜杆。

= 第三方登陆的后台并没有 AppID 或 SecretKEY？ =

叫法大同小异，一般一个叫 XXX_ID 是公开的；一个叫 XXX_KEY 是不公开的。

= 为什么脸书推特等无法登陆？ =

脸书推特需要翻墙，目前国内空间基本不支持。插件提供了一个设置代理的功能。

= 绑定帐号后可以自动同步文章或评论么？ =

目前没有做这个功能，不排除后面的版本会实现这个功能。

= 为什么邮件通知没有效果？ =

要么是邮箱地址不存在；要么是空间不支持邮件函数，可以装邮件插件（如 wp-mail-smtp）。

= 为什么登陆方式是跳转而非弹窗？ =

弹窗容易出现一些兼容问题出现，后来才改为跳转，好像也没什么坏处。

= 关闭游客评论的情况下怎么单独开放游客评论？ =

编辑任意文章或页面，添加自定义栏目“os_guestbook”，值为 1，该文章即支持游客评论；而且跟登陆评论并不矛盾。

== Screenshots ==

1. Sidebar
2. Widgets
3. Setting1: General Setting
4. Setting2: Account Setting
5. Setting3: Profile Option
6. Comment Form

== Changelog ==

= 1.6.4 =
* 更新QQ登陆：去掉多余的腾讯微博的参数
* 修正头像函数：提升优先级并兼容邮箱地址

= 1.6.3 =
* 修正小米登陆

= 1.6.2 =
* 修正微信开放平台登陆
* 若干细节规范和优化
* 新增内部登陆按钮，方便老用户先登陆再绑定

= 1.6.1 =
* 若干兼容性更新

= 1.6.0 =
* 支持多网站绑定
* 优化了若干细节
* 修正了若干问题

= 1.5.4 =
* 修正微信二维码兼容
* 过滤分享时的一些干扰字符

= 1.5.3 =
* 修复语言（对应后台管理员设置的网站语言；个人在资料页设置的只对自己有效；不跟浏览器语言有关——函数不熟，希望能一劳永逸啦：）

= 1.5.2 =
* 更新微信二维码生成
* 取消自适应浏览器语言

= 1.5.1 =
* 可屏蔽Gavatar头像（如被墙）
* 默认虚假邮箱无法启用邮件通知
* 修复QQ在线小组件和啤酒链接

= 1.5.0 =
* 个人用户名允许修改一次
* 简化帐号及小工具的设置选项
* 增加几个非常实用的短代码
* 支持文章单独开放游客评论
* 游客评论支持反垃圾正则过滤
* 切换语言功能移到个人资料页
* 优化了一些细节和样式及翻译

= 1.4.1 =
* 增加微信开放平台登陆（未有帐号）
* 优化了分享按钮的提示问题
* 优化了一些体验小问题

= 1.4.0 =
* 优化分享接口可以自动附加文章批量图片
* 针对新版插件系统添加一个漂亮的图标

= 1.3.2 =
* 针对国内环境提供了登陆接口的代理及反向代理的功能
* 优化了推特的登陆函数和头像功能
* 优化了远程访问的接口函数

= 1.3.1 =
* 新用户默认角色指定为订阅者
* 新增转换其他同类插件用户数据
* 脚本加载方式改为可配置并后置
* 评论中的链接和外链统一为新窗
* 修正一些小问题

= 1.3.0 =
* 新增 Twitter/Github 登陆
* 优化配置保存方式防止更新丢失
* 精简大量代码和删除无关功能
* 登陆及分享按钮可以配置是否启用
* 修正头像显示的一些问题
* 增强了请求函数的兼容性

= 1.2.0 =
* 新增 CSDN/OSChina/Facebook 登陆
* 登陆方式弃用弹窗彻底改为跳转更稳定
* 新增评论回复邮件通知功能并带总开关
* 完善用户个人资料页的配置和整合度
* 增加了几个实用扩展功能和开关选项
* 添加了顶部和评论两个滚动小按钮
* 优化代码和规范修正一些翻译小错误

= 1.1.5 =
* 登陆页面以设置的callback参数为准避免混淆问题
* 修正链接带#时登陆后未自动刷新的问题
* 修正tooltip对页面非插件元素的影响

= 1.1.4 =
* 修正QQ头像的问题

= 1.1.3 =
* 修正 iOS 登陆时不会跳转的问题

= 1.1.2 =
* 增加以小米帐号登陆
* 增加短代码[os_hide]，登陆用户可见

= 1.1.1 =
* 解决绑定功能逻辑不清晰的问题

= 1.1.0 =
* 解决豆瓣回调地址要完全匹配不能带参数的问题
* 支持评论需登陆设置下的登陆按钮的默认展示
* 登陆界面下通过开放帐号登陆可智能返回登陆前的页面
* 支持在个人资料页里绑定系统已注册的用户
* 哦，等等，上面这个功能原来一早已支持了的

= 1.0.9 =
* 解决更新后帐号配置被清空的问题

= 1.0.8 =
* 默认显示较清晰头像
* 分享按钮可添加在文章后
* 合并谷歌回调文件（旧文件可删）
* 修正登陆页面登陆问题
* 样式表和脚本放到图片目录下
* 规范了一下配置的变量名

= 1.0.7 =
* 修正头像函数调试模式下会出现警告的问题

= 1.0.6 =
* 更新了一下设定

= 1.0.5 =
* 增加参数设置、优化设置页面
* 增加入口，用户更容易修改邮箱
* 修正头像BUG，细节优化

= 1.0.4 =
* 增加语言切换
* 图片归类到一个目录
* 一些小修正

= 1.0.3 =
* 增加谷歌用户的头像

= 1.0.2 =
* 全新改版

= 1.0.1 =
* 增加多LIVE、豆瓣、人人网、开心网
* 精简大量代码

= 1.0.0 =
* 第一个版本
