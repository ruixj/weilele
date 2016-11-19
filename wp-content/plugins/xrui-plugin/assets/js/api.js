// (function(){ 
// window.BMap_loadScriptTime = (new Date).getTime(); 
// document.write('<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BIalsTEjgPtbogULIaIj6mnD"></script>');
// document.write('<script type="text/javascript" src="http://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>');
// })();

function locationError(error){
       switch(error.code) {
           case error.TIMEOUT:
               alert("A timeout occured! Please try again!连接超时，请重试 ");
               break;
           case error.POSITION_UNAVAILABLE:
               alert('We can\'t detect your location. Sorry! 非常抱歉，我们暂时无法为您提供位置服务');
               break;
           case error.PERMISSION_DENIED:
               alert('Please allow geolocation access for this to work.您拒绝了使用位置共享服务，查询已取消');
               break;
           case error.UNKNOWN_ERROR:
               alert('An unknown error occured!');
               break;
       }
}

function translatePoint(position) {
	var currentLat = position.coords.latitude;
	var currentLon = position.coords.longitude;
	var gpsPoint = new BMap.Point(currentLon, currentLat);
	BMap.Convertor.translate(gpsPoint, 0, initMap); //转换坐标
}

function initMap(point) {
	//初始化地图
	map = new BMap.Map("map");
	//map.addControl(new BMap.NavigationControl());
	map.addControl(new BMap.ScaleControl());
	//map.addControl(new BMap.OverviewMapControl());
	map.centerAndZoom(point, 14);
	map.disableDragging();
	map.addOverlay(new BMap.Marker(point));

	data = {};
	data.lat = point.lat;
	data.lng = point.lng;
	data.p = 5;

	//$.get("/index.php?g=portal&m=index&a=ajaxBaiduMapVillages&pid=59", data, , 'json');
	
	$.ajax( {
		url:  ajaxurl,
		type: 'post',
		data: {
			action: 'sp_get_current_nearby',
			lat : point.lat,
			lng : point.lng,
			p : 5 
		},
		dataType: "json",
		success: function (result) {

			var res = result['results'];
			if (result['status'] == 'fail') {
				$.alert(res);
				return false;
			}
			var html = '';
			var default_html = '';
			for (var i = 0; i < res.length; i++) {
				html += '<li data-values="' + res[i].uid + '" data-text="' + res[i].name + '">';
				html += res[i].name;
				html += '<i></i>';
				html += '</li>';
				default_html += '<p><label for="' + res[i].uid + '" data-text="' + res[i].name + '" data-values="' + res[i].uid + '" ><input type="radio" name="key" value="' + res[i].uid + '" id="' + res[i].uid + '">' + res[i].name + '</label></p>';
			}
			$("#location_result").html(html);
			$("#villages").html(default_html);
		}
	} );		
}

function searchAndLocate() {
	$.showLoading("正在加载...");

	var map = new BMap.Map("map");
	//map.addControl(new BMap.NavigationControl());
	map.addControl(new BMap.ScaleControl());
	map.disableDragging();
	//map.addControl(new BMap.OverviewMapControl());

	var options = {
		onSearchComplete: function (results) {
			// 判断状态是否正确
			if (local.getStatus() == BMAP_STATUS_SUCCESS) {
				var poi = results.getPoi(0);
				map.centerAndZoom(poi.point, 13);
				map.addOverlay(new BMap.Marker(poi.point));

				var data = {};
				data.lat = poi.point.lat;
				data.lng = poi.point.lng;
				data.p = 15;
				
				$.ajax( {
					url:  ajaxurl,
					type: 'post',
					data: {
						action: 'sp_get_current_nearby',
						lat : poi.point.lat,
						lng : poi.point.lng,
						p : 5 
					},
					dataType: "json",
					success: function (result) {

						var res = result['results'];
						if (result['status'] == 'fail') {
							$.alert(res);
							return false;
						}
						var html = '';
						var default_html = '';
						for (var i = 0; i < res.length; i++) {
							html += '<li data-values="' + res[i].uid + '" data-text="' + res[i].name + '">';
							html += res[i].name;
							html += '<i></i>';
							html += '</li>';
							default_html += '<p><label for="' + res[i].uid + '" data-text="' + res[i].name + '" data-values="' + res[i].uid + '" ><input type="radio" name="key" value="' + res[i].uid + '" id="' + res[i].uid + '">' + res[i].name + '</label></p>';
						}
						$("#location_result").html(html);
						$("#villages").html(default_html);
						$.hideLoading();
					}
				} );				
 
			} else {
				//关于状态码
				//BMAP_STATUS_SUCCESS        检索成功。对应数值“0”。
				//BMAP_STATUS_CITY_LIST        城市列表。对应数值“1”。
				//BMAP_STATUS_UNKNOWN_LOCATION        位置结果未知。对应数值“2”。
				//BMAP_STATUS_UNKNOWN_ROUTE        导航结果未知。对应数值“3”。
				//BMAP_STATUS_INVALID_KEY        非法密钥。对应数值“4”。
				//BMAP_STATUS_INVALID_REQUEST        非法请求。对应数值“5”。
				//BMAP_STATUS_PERMISSION_DENIED        没有权限。对应数值“6”。(自 1.1 新增)
				//BMAP_STATUS_SERVICE_UNAVAILABLE        服务不可用。对应数值“7”。(自 1.1 新增)
				//BMAP_STATUS_TIMEOUT        超时。对应数值“8”。(自 1.1 新增)
				if (local.getStatus() == 1) {
//						$.alert('local.getStatus['+ local.getStatus() +']  error' );
					$.alert('同名地点过多，请加上城市名缩小减少范围！');
				}
				$.hideLoading();
			}
		}
	};
	var local = new BMap.LocalSearch(map, options);
	local.search($("#_search").val());
	return false;
}
	
$(
function() {
	
	$('#villages p label').live('click', function() {
			$("#location_id").val($(this).data('values'));
	});
	
	$('#location_result li').live('click', function() {
		var text = $(this).data('text'),vals = $(this).data('values');
		var exist = false;
		$("input[name=key]").each(function(){
			if($(this).val() == vals){
				exist = true;
				$(this).attr('checked',true);
			}
		});
		if(!exist){
			$("#villages").append('<p><label for="' + vals + '"><input checked type="radio" name="key" value="' + vals + '" id="' + vals + '">'+text+'</label></p>');
		}
		
		$("#location_id").val(vals);
		$.closePopup();
	});

	$('#submit').click(function() {
		var data = {};
		data.location_id = $('#location_id').val();
		data.action      = 'save_community';

		if(!data.location_id) {
			$.alert('请选择你所属小区！');
			return false;
		}

		$.showLoading("正在加载...");
		$.post(ajaxurl, 
			data, 
			function(jresult) 
			{
				$.hideLoading();
				
				var o = eval("("+jresult+")");
				
				if(o.status_code != 0) {
					$.alert("更新小区信息失败，稍后重试！");
				} 
				else {
					//恭喜你加入乐莲
					//是否成为活跃老人愿为社区做贡献
					//是否申请为社区管理者
					//是否申请为社区组织者
					$.alert({
						text: '更新小区信息成功！',
						onOK: function() {
							location.href =  o.redirect_url;
							return false;
							//暂时关闭活跃老人申请
							//如果参数过多，建议通过 object 方式传入
							// $.confirm({
								// text: '是否成为活跃老人愿为社区做贡献',
								// onOK: function() {
									// $.post("/index.php?g=user&m=profile&a=state&pid=59", {
										// state: 'is_hxlr'
									// }, 
									// function(d) {
										// if(d.status) {
											// $.toptip('申请成功，您可以在个人中心后台查看审核结果！', 2000, 'success');
											// location.href = '/index.php?g=Portal&m=index&a=index&pid=59';
										// } else {
											// location.href = '/';
										// }
									// });
								// },
								// onCancel: function() {
									// location.href = '/';
								// }
							// });
						}
					});
				}
			});
	});
});
				
				
$(function() {  
    FastClick.attach(document.body); 

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(translatePoint, locationError, {
			// 指示浏览器获取高精度的位置，默认为false
			enableHighAccuracy: true,
			// 指定获取地理位置的超时时间，默认不限时，单位为毫秒
			//timeout: 5000,
			// 最长有效期，在重复获取地理位置时，此参数指定多久再次获取位置。
			//maximumAge: 3000
		});
	} else {
		alert("浏览器不支持html5来获取地理位置信息");
	}
});  