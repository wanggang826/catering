<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\www\alasika\public\theme\mobile\device\device_map.html";i:1505187290;s:53:"D:\www\alasika\public\theme\mobile\layout\layout.html";i:1505186947;}*/ ?>
<!DOCTYPE html>
<html style="background:#F0F2F5;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="/alasika/__MOBILE__/static/js/mui.min.js"></script>
    <link href="/alasika/__MOBILE__/static/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/alasika/__MOBILE__/static/iconfont/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/alasika/__MOBILE__/static/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/alasika/__MOBILE__/static/css/_other.css"/>
    <script src="/alasika/__MOBILE__/static/js/flexible.js"></script>
    <script src="/alasika/__MOBILE__/static/js/jquery_min.js"></script>

    <script type="text/javascript" charset="utf-8">
        mui.init();
    </script>
</head>
<body>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=RHbjk3GObLnlkQhftRZHuyCHG3xZkca6"></script>
<body>
	<header class="mui-bar mui-bar-nav">
	    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	    <h1 class="mui-title">咖啡地图</h1>
	</header>
	<div class="mui-content">
	    <div style="width: 100%;height: 100%;background: white;" id="map_container">
	    	
	    </div>
	</div>
	<div class="fix_bottom">
		<div><span class="mui-icon iconfont icon-shangla"></span></div>
		<ul>
			<li>
				<div>
					<img src="imgs/coffee_model.png" />
	    			<div class="content-middle">
						<h3>立体式有拉花机型</h3>
	    				<div>福田区，云松大厦，下沙站1090号定点。</div>
	    				<p class="ellipsis">客服电话：400-34828</p>
	    			</div>
	    			<div class="content-right">
						<div>0.3公里</div>
						<button class="select">选择</button>
	    			</div>
				</div>
	    	</li>
		</ul>
	</div>
	
	<script type="text/javascript">
		mui('body').on('tap','.icon-shangla',function(){
		  window.location="map_shangla.html";
		}) 
		mui('body').on('tap','.select',function(){
		  window.location="coffee_list.html";
		})
        // 百度地图API功能
       // var map = new BMap.Map("map_container");

        var map = new BMap.Map("map_container");
        var point = new BMap.Point(116.404, 39.915);
        map.centerAndZoom(point, 15);
        var marker = new BMap.Marker(point);  // 创建标注
        map.addOverlay(marker);               // 将标注添加到地图中
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        //关于状态码
        //BMAP_STATUS_SUCCESS	检索成功。对应数值“0”。
        //BMAP_STATUS_CITY_LIST	城市列表。对应数值“1”。
        //BMAP_STATUS_UNKNOWN_LOCATION	位置结果未知。对应数值“2”。
        //BMAP_STATUS_UNKNOWN_ROUTE	导航结果未知。对应数值“3”。
        //BMAP_STATUS_INVALID_KEY	非法密钥。对应数值“4”。
        //BMAP_STATUS_INVALID_REQUEST	非法请求。对应数值“5”。
        //BMAP_STATUS_PERMISSION_DENIED	没有权限。对应数值“6”。(自 1.1 新增)
        //BMAP_STATUS_SERVICE_UNAVAILABLE	服务不可用。对应数值“7”。(自 1.1 新增)
        //BMAP_STATUS_TIMEOUT	超时。对应数值“8”。(自 1.1 新增)
	</script>
</body>
</html>
</body>
</html>