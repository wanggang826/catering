<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"D:\www\alasika\public\theme\mobile\user\index.html";i:1505209278;s:53:"D:\www\alasika\public\theme\mobile\layout\layout.html";i:1505208863;s:53:"D:\www\alasika\public\theme\mobile\layout\footer.html";i:1505210465;}*/ ?>
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

<link rel="stylesheet" href="__MOBILE__/static/user/css/personal.css" />
<link rel="stylesheet" type="text/css" href="__MOBILE__/static/css/public.css"/>

	<header class="mui-bar mui-bar-nav my-nav">
	    <h1 class="mui-title denglu">个人中心</h1>
	</header>
	<div class="mui-content">
	    <div class="personal-top">
	    	<img src="__MOBILE__/static/user/img/personal.png"/>
	    	<div class="personal-relative">
	    		<div>
	    			<img src="__MOBILE__/static/user/img/touxiang.png"/>
		    		<span class="iconfont icon-iconzhuanqu50 fright"></span>
		    		<div class="clear"></div>
	    		</div>
	    		<p class="personal-p"><img src="__MOBILE__/static/user/img/tong.png"/><a><?php echo $user['nickname']; ?><span class="iconfont <?php if($user['sex'] == 1): ?>  icon-nan <?php else: ?> icon-nv <?php endif; ?>"></span></a></p>
	    		<p class="personal-p2"><a href=""><?php echo $user['introduce']; ?></a></p>
	    	</div>
	    </div>
	    <div class="personal-center">
	    	<ul class="center-ul">
	    		<li class="fleft zhanghu">
	    			<p>账户余额</p>
	    			<p><span><?php echo $user['remainder']; ?>&nbsp;元</span></p>
	    		</li>
	    		<li class="fleft youhuiquan">
	    			<p>我的优惠券</p>
	    			<p><span><?php echo $user['coupon_total']; ?>&nbsp;张</span></p>
	    		</li>
	    		<li class="fleft integration">
	    			<p>我的积分</p>
	    			<p><span><?php echo $user['integration']; ?></span></p>
	    		</li>
	    		<li class="fleft pinglun">
	    			<p>发布评论</p>
	    			<p><span><?php echo $user['comment_total']; ?>&nbsp;条</span></p>
	    		</li>
	    		<li class="clear"></li>
	    	</ul>
	    </div>
	    <div class="personal-bottom">
	    	<ul class="mui-table-view myUl Br Dr">
			    <li class="mui-table-view-cell">
			        <a href="<?php echo url('feedback'); ?>" class="mui-navigate-right"><span class="iconfont icon-yjfk"></span>意见反馈</a>
			    </li>
			    <li class="mui-table-view-cell Dr">
			        <a href="feedback2.html" class="mui-navigate-right"><span class="iconfont icon-iconfonticonwodechiyuguanyuwomen"></span>关于我们</a>
			    </li>
			</ul>
	    </div>
	</div>
<nav class="mui-bar mui-bar-tab">
    <a href="../index.html" class="mui-tab-item <?php if($controller_name == 'Index'): ?>mui-active<?php endif; ?>">
        <span class="mui-icon icon_index"></span>
        <span class="mui-tab-label">首页</span>
    </a>
    <a href="../static/diy/diyList.html" class="mui-tab-item <?php if($controller_name == 'Printing'): ?>mui-active<?php endif; ?>">
        <span class="mui-icon icon_diy"></span>
        <span class="mui-tab-label">拉花DIY</span>
    </a>
    <a href="<?php echo url('order/my_order'); ?>" class="mui-tab-item <?php if($controller_name == 'Order'): ?>mui-active<?php endif; ?>">
        <span class="mui-icon icon_order"></span>
        <span class="mui-tab-label">订单</span>
    </a>
    <a href="<?php echo url('user/index'); ?>" class="mui-tab-item <?php if($controller_name == 'User'): ?>mui-active<?php endif; ?>">
        <span class="mui-icon icon_person"></span>
        <span class="mui-tab-label">个人中心</span>
    </a>
</nav>
	<script type="text/javascript">
		mui('body').on('tap','a',function(){
			if(this.href){
				window.location.href=this.href;
			}
		})
		$(function () {
			mui('.head_nav').on('tap', 'li', function () {
				var index = $(this).index();
				$(this).siblings().removeClass("active");
				$(this).addClass("active");
				if (index == 1) {
					$("#diy_pending").hide();
					$("#diy_complete").show();
				} else {
					$("#diy_pending").show();
					$("#diy_complete").hide();
				}
			})
		})
		mui('body').on('tap','.zhanghu',function(){
		  	window.location.href='<?php echo url("account",["user_id"=>$user['id']]); ?>';
		}) 
		mui('body').on('tap','.youhuiquan',function(){
		  	window.location.href='<?php echo url("coupon",["user_id"=>$user['id']]); ?>';
		})
		mui('body').on('tap','.integration',function(){
		  	window.location.href='<?php echo url("integration",["user_id"=>$user['id']]); ?>';
		})
		mui('body').on('tap','.pinglun',function(){
		  	window.location.href='<?php echo url("comments",["user_id"=>$user['id']]); ?>';
		})
		mui('body').on('tap','.icon-iconzhuanqu50',function(){
		  	window.location.href='<?php echo url("info",["user_id"=>$user['id']]); ?>';
		})
	</script>

</body>
</html>