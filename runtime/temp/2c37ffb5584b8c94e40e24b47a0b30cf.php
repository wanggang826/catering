<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"D:\www\alasika\public\theme\mobile\index\index.html";i:1505199614;s:53:"D:\www\alasika\public\theme\mobile\layout\layout.html";i:1505196504;}*/ ?>
<!DOCTYPE html>
<html style="background:#F0F2F5;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="__MOBILE__/static/js/mui.min.js"></script>
    <link href="__MOBILE__/static/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="__MOBILE__/static/iconfont/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__MOBILE__/static/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="__MOBILE__/static/css/_other.css"/>
    <script src="__MOBILE__/static/js/flexible.js"></script>
    <script src="__MOBILE__/static/js/jquery_min.js"></script>

    <script type="text/javascript" charset="utf-8">
        mui.init();
    </script>
</head>
<body>
<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>/swiper.min.css"/>
<script src="<?php echo $js; ?>/swiper.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>/index.css"/>
<body>
	<div class="mui-content" style="margin-top: 0;">
	    <div id="banner">
			<div class="carousel carouse3 clearfix">
			    <div class="swiper-container">
			        <div class="swiper-wrapper">
			            <div class="swiper-slide">
			            	<img style="width: 10rem;height: 5.6rem;" src="<?php echo $imgs; ?>/banner_01.png">
			            </div>
			            <div class="swiper-slide">
			            	<img style="width: 10rem;height: 5.6rem;" src="<?php echo $imgs; ?>/banner_02.png">
			            </div>
			            <div class="swiper-slide">
			            	<img style="width: 10rem;height: 5.6rem;" src="<?php echo $imgs; ?>/banner_01.png">
			            </div>
			            <div class="swiper-slide">
			            	<img style="width: 10rem;height: 5.6rem;" src="<?php echo $imgs; ?>/banner_02.png">
			            </div>
			        </div>
			        <div class="swiper-pagination"></div>
			    </div>
			</div>
		</div>
		<div class="swipe_text">
			<div class="left_text">
				<p><span class="mui-icon iconfont icon-wenjiansousuo"></span></p>
				<p>每周精选</p>
			</div>
			<div class="right_text">
				<div>
					<p data-num = "1"><button>咖啡推荐1</button>咖啡的种类有很多，每个人喜欢的味道都…</p>
					<p data-num = "2"><button>咖啡推荐2</button>咖啡的种类有很多，每个人喜欢的味道都…</p>
					<p data-num = "3"><button>咖啡推荐3</button>咖啡的种类有很多，每个人喜欢的味道都…</p>
					<p data-num = "4"><button>咖啡推荐4</button>咖啡的种类有很多，每个人喜欢的味道都…</p>
					<p data-num = "5"><button>咖啡推荐5</button>咖啡的种类有很多，每个人喜欢的味道都…</p>
					<p data-num = "1"><button>咖啡推荐1</button>咖啡的种类有很多，每个人喜欢的味道都…</p>
				</div>
			</div>
		</div>
		<div class="index_bg">
			<p><button data-href = "coffee_map.html" class="select_coffee">选咖啡</button></p>
			<p>选择您附近的咖啡机吧！</p>
		</div>
	</div>
	
	<nav class="mui-bar mui-bar-tab">
	    <a href="index.html" class="mui-tab-item mui-active">
	        <span class="mui-icon icon_index"></span>
	        <span class="mui-tab-label">首页</span>
	    </a>
	    <a href="diy/diyList.html" class="mui-tab-item">
	        <span class="mui-icon icon_diy"></span>
	        <span class="mui-tab-label">拉花DIY</span>
	    </a>
	    <a href="order/my_order.html" class="mui-tab-item">
	        <span class="mui-icon icon_order"></span>
	        <span class="mui-tab-label">订单</span>
	    </a>
	    <a href="personal_center/personal.html" class="mui-tab-item">
	        <span class="mui-icon icon_person"></span>
	        <span class="mui-tab-label">个人中心</span>
	    </a>
	</nav>
	
	<script type="text/javascript">
		window.onload = function () {
	        var swiper = new Swiper('.swiper-container', {
	        	loop:true,
	            pagination: '.swiper-pagination',
	            paginationClickable: true,
	            autoplay: 2000
	        });
	   };
		+function(){
			var bannerHeight=$("#banner").height()
			var midHeight=$(".swipe_text").outerHeight();
			var midOffHeight=$(".swipe_text").offset().top;
			$(".index_bg").height((window.screen.availHeight-bannerHeight-midHeight-50)+"px");
			$(".index_bg").css("top",midOffHeight+midHeight+"px");
		}();
		+function(){
			var i=0;
			setInterval(function(){
				i++;
				if(i<=$(".right_text>div>p").length-1){
					$(".right_text>div").animate({"top":-40*i+"px"},function(){
						if(i==$(".right_text>div>p").length-1){
							i=0;
							$(".right_text>div").css({"top":-40*i+"px"})
						}
					});
				}
			},3000)
		}();
		mui('body').on('tap','[data-href]',function(){
		  if(this.getAttribute("data-href")){
		  	window.location=this.getAttribute("data-href");
		  }
		}) 
		mui('body').on('tap','a',function(){
		  if(this.href){
		  	window.location=this.href;
		  }else{
		  	return false;
		  }
		}) 
		mui('body').on('tap','#banner',function(e){
		  e.preventDefault();
		  e.stopPropagation();
		}) 
		mui('body').on('tap','.swipe_text',function(e){
		  e.preventDefault();
		  e.stopPropagation();
		}) 
	</script>
</body>
</html>
<nav class="mui-bar mui-bar-tab">
    <a href="../index.html" class="mui-tab-item">
        <span class="mui-icon icon_index"></span>
        <span class="mui-tab-label">首页</span>
    </a>
    <a href="../static/diy/diyList.html" class="mui-tab-item">
        <span class="mui-icon icon_diy"></span>
        <span class="mui-tab-label">拉花DIY</span>
    </a>
    <a href="<?php echo url('order/my_order'); ?>" class="mui-tab-item">
        <span class="mui-icon icon_order"></span>
        <span class="mui-tab-label">订单</span>
    </a>
    <a href="<?php echo url('user/index'); ?>" class="mui-tab-item mui-active">
        <span class="mui-icon icon_person"></span>
        <span class="mui-tab-label">个人中心</span>
    </a>
</nav>
</body>
</html>