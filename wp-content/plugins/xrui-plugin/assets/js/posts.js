jQuery(document).ready(
	function($) {   
		//点击下一页的链接(即那个a标签)   
		// $('div.post-read-more a').click( 
			// function() {   
				// $this = $(this);   
				// $this.addClass('loading'); //给a标签加载一个loading的class属性，可以用来添加一些加载效果   
				// var href = $this.attr("href"); //获取下一页的链接地址   
				// if (href != undefined) { //如果地址存在   
					// $.ajax( { //发起ajax请求   
						// url: href, //请求的地址就是下一页的链接   
						// type: "get", //请求类型是get   
			  
						// error: function(request) {   
							// //如果发生错误怎么处理   
						// },   
						// success: function(data) { //请求成功   
							// $this.removeClass('loading'); //移除loading属性   
							// var $res = $(data).find(".post"); //从数据中挑出文章数据，请根据实际情况更改   
							// $('#content').append($res); //将数据加载加进posts-loop的标签中。   
							// var newhref = $(data).find(".post-read-more a").attr("href"); //找出新的下一页链接   
							// if( newhref != undefined ){   
								// $(".post-read-more a").attr("href",newhref);   
							// }else{   
								// $(".post-read-more").hide(); //如果没有下一页了，隐藏   
							// }   
						// }   
					// });   
				// }   
				// return false;   
			// }
			
		// );   
        var is_post_loading = false;//We'll use this variable to make sure we don't send the request again and again.

        jq( document ).on( 'scroll', function () {
			//Find the visible "load more" button.
			//since BP does not remove the "load more" button, we need to find the last one that is visible.
			var load_more_btn = jq( "div.post-read-more a:visible" );
			//If there is no visible "load more" button, we've reached the last page of the activity stream.
			if ( !load_more_btn.get( 0 ) )
				return;

			//Find the offset of the button.
			var pos = load_more_btn.offset();

			//If the window height+scrollTop is greater than the top offset of the "load more" button, we have scrolled to the button's position. Let us load more activity.
			//            console.log(jq(window).scrollTop() + '  '+ jq(window).height() + ' '+ pos.top);

			if ( jq( window ).scrollTop() + jq( window ).height() > pos.top )
			{
				load_more_posts();
			}
        } );

		/**
		 * This routine loads more activity.
		 * We call it whenever we reach the bottom of the activity listing.
		 *
		 */
		function load_more_posts() {

			//Check if activity is loading, which means another request is already doing this.
			//If yes, just return and let the other request handle it.
			if ( is_post_loading )
				return false;
			var load_more_btn = jq( "div.post-read-more a" );
			//So, it is a new request, let us set the var to true.
			is_post_loading = true;

				 
			load_more_btn.addClass('loading'); //给a标签加载一个loading的class属性，可以用来添加一些加载效果   
			var href = load_more_btn.attr("href"); //获取下一页的链接地址   
			if (href != undefined) { //如果地址存在   
				$.ajax( { //发起ajax请求   
					url: href, //请求的地址就是下一页的链接   
					type: "get", //请求类型是get   
		  
					error: function(request) {   
						//如果发生错误怎么处理  
						load_more_btn.removeClass('loading'); //移除loading属性 							
						is_post_loading = false;
					},   
					success: function(data) { //请求成功   
						load_more_btn.removeClass('loading'); //移除loading属性   
						var $res = $(data).find(".post"); //从数据中挑出文章数据，请根据实际情况更改   
						$('#content').append($res); //将数据加载加进posts-loop的标签中。   
						var newhref = $(data).find(".post-read-more a").attr("href"); //找出新的下一页链接   
						if( newhref != undefined ){   
							$(".post-read-more a").attr("href",newhref);   
						}
						else
						{   
							$(".post-read-more").hide(); //如果没有下一页了，隐藏   
						}   
						is_post_loading = false;
					}   
					
				});   
			} 

			return false;
		}
        
});



  


