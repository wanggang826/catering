<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"D:\www\alasika\public\theme\mobile\order\my_order.html";i:1505209211;s:53:"D:\www\alasika\public\theme\mobile\layout\layout.html";i:1505208863;s:53:"D:\www\alasika\public\theme\mobile\layout\footer.html";i:1505210465;}*/ ?>
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

	<title>订单</title>
	<link rel="stylesheet" type="text/css" href="__MOBILE__/static/css/_other.css"/>
	<link rel="stylesheet" type="text/css" href="__MOBILE__/static/order/css/order.css"/>
	<link href="__MOBILE__/static/css/public.css" rel="stylesheet"/>
<div id= "bcid">
	<p class="scan-p">
		<a class="mui-action-back mui-icon iconfont icon-xiangzuo saoA"></a>
		<span class="scan-span">扫一扫</span>
	</p>
	<div class="bottom-div">
		<p>扫描机器二维码</p>
		<p>开始冲泡</p>
	</div>
</div>

<div id="evaluate_confirm">
	<div>
		<p>评论成功<span class="mui-icon iconfont icon-duihao"></span></p>
		<p>(将获得<span>xx</span>点奖励!)</p>
	</div>
</div>
<!--确定取消框-->
<div id="my_confirm">
	<div class="cancel_confirm">
		<h3>确认要取消订单吗？</h3>
		<div><span class="cancel_btn">取消</span><span class="sure_btn">确认</span></div>
	</div>
	<div class="refund_confirm">
		<h3>确认退款吗？</h3>
		<div><span class="cancel_btn">取消</span><span class="sure_btn">确认</span></div>
	</div>
	<div class="refund_success">
		<h3><span class="mui-icon iconfont icon-duihao1"></span>退款成功！</h3>
		<p>(系统将在1~2个工作日退还金额到您的账户中)</p>
	</div>
</div>
<!--冲泡弹框-->
<div id="flush_confirm">
	<div class="flush_busy">
		<img src="__MOBILE__/static/diy/imgs/coffee_cup.jpg"/>
		<p>冲泡完成</p>
		<p>感谢您的惠顾~</p>
		<p>(系统赠送你12积分)</p>
	</div>
	<div class="flush_place">
		<img src="__MOBILE__/static/diy/imgs/coffee_cup.jpg"/>
		<p>咖啡机已准备就绪</p>
		<p>请放杯~</p>
		<p>根据咖啡机界面提示确认冲泡</p>
	</div>
	<div class="flush_ing">
		<img src="__MOBILE__/static/diy/imgs/coffee_cup.jpg"/>
		<p>正在为您冲泡，请稍后~</p>
		<div><img src="__MOBILE__/static/order/imgs/begin_flush.png"/></div>
	</div>
	<div class="flush_complete">
		<img src="__MOBILE__/static/diy/imgs/coffee_cup.jpg"/>
		<h3>冲泡完成！可进行DIY拉花~</h3>
		<p><span>不了，谢谢</span><span>开始拉花</span></p>
	</div>
</div>
<!--下部分享框-->
<div id="confirm_bottom">
	<div class="share_bottom">
		<div class="child_part">
			<p>分享给你的微信好友吧~</p>
			<p><img class="share_wx" src="__MOBILE__/static/order/imgs/icon_wx.png"/></p>
		</div>
	</div>
</div>
<!--分享结果-->
<div id="share_result">
	<div class="share_success">
		<div><span class="mui-icon iconfont icon-duihao1"></span><span>赠送成功</span></div>
		<p>系统奖励您一张优惠券</p>
	</div>
	<div class="share_fail">
		<p>赠送好友咖啡失败</p>
	</div>
</div>

<header class="mui-bar mui-bar-nav">
	<!--<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>-->
	<h1 class="mui-title">我的订单</h1>
</header>
<div class="mui-content">
	<ul class="head_nav">
		<li class="active">
			<span>未完成订单</span>
		</li>
		<li>
			<span>已完成订单</span>
		</li>
	</ul>
	<div id="order_pending">
		<ul class="show_content">
			<li>
				<div class="diy-content">
					<img src="__MOBILE__/static/order/imgs/coffee_cup.jpg" class="diy-photo"/>
					<div class="con-middle">
						<h3 class="middle-title"><span>卡布奇诺</span>Cappuccino</h3>
						<div class="ellipsis">
							<span>水+咖啡</span>
							<span>无奶</span>
							<span>低热量</span>
							<span>口味醇正</span>
						</div>
						<p class="orange_color">
							<span>销量：</span>
							<span>68</span>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<span>评价：</span>
							<span>9</span>
						</p>
					</div>
					<div class="con-right">
						<div class="right-sale">APP专享<span>9</span>折</div>
						<div class="right-money"><em>¥</em>10.00</div>
						<div class="right-total"><span>x</span>1</div>
					</div>
				</div>
				<div class="diy-button clearfix">
					<a href="order_detail.html" class="btn-diy pay_btn">立即支付</a>
					<a href="javascript:;" class="btn-diy cancel_order_btn">取消订单</a>
				</div>
			</li>
		</ul>
	</div>
	<div id="order_complete">
		<ul class="show_content">
			<li>
				<div class="diy-content">
					<img src="__MOBILE__/static/order/imgs/coffee_cup.jpg" class="diy-photo"/>
					<div class="con-middle">
						<h3 class="middle-title"><span>卡布奇诺</span>Cappuccino</h3>
						<div class="ellipsis">
							<span>水+咖啡</span>
							<span>无奶</span>
							<span>低热量</span>
							<span>口味醇正</span>
						</div>
						<p class="orange_color">
							<span>销量：</span>
							<span>68</span>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<span>评价：</span>
							<span>9</span>
						</p>
					</div>
					<div class="con-right">
						<div class="right-sale">APP专享<span>9</span>折</div>
						<div class="right-money"><em>¥</em>10.00</div>
						<div class="right-total"><span>x</span>2</div>
					</div>
				</div>
				<div class="diy-button clearfix">
					<a href="../diy/diyReview.html" class="btn-diy">写评论</a>
					<div class="diy-tips">【写评论 直接积分换免费礼品】</div>
				</div>
			</li>
			<li>
				<div class="diy-content">
					<img src="__MOBILE__/static/order/imgs/coffee_cup.jpg" class="diy-photo"/>
					<div class="con-middle">
						<h3 class="middle-title"><span>卡布奇诺</span>Cappuccino</h3>
						<div class="ellipsis">
							<span>水+咖啡</span>
							<span>无奶</span>
							<span>低热量</span>
							<span>口味醇正</span>
						</div>
						<p class="orange_color">
							<span>销量：</span>
							<span>68</span>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<span>评价：</span>
							<span>9</span>
						</p>
					</div>
					<div class="con-right">
						<div class="right-sale">APP专享<span>9</span>折</div>
						<div class="right-money"><em>¥</em>10.00</div>
						<div class="right-total"><span>x</span>2</div>
					</div>
				</div>
				<div class="diy-button clearfix">
					<a href="../diy/diyReview.html" class="btn-diy btn-after">已评论</a>
					<div class="diy-tips">【写评论 直接积分换免费礼品】</div>
				</div>
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
    $(function () {
        mui('.head_nav').on('tap', 'li', function () {
            var index = $(this).index();
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            if (index == 1) {
                $("#order_pending").hide();
                $("#order_complete").show();
            } else {
                $("#order_pending").show();
                $("#order_complete").hide();
            }
        })
        //退款申请
        mui('body').on('tap','.refund_btn',function(){
            if($(this).hasClass("enable")){
                return false;
            }else{
                var self=this;
                $("#my_confirm").show();
                $(".refund_confirm").show().siblings().hide();
                mui('.refund_confirm').on('tap','.cancel_btn',function(){
                    $('#my_confirm').hide();
                })
                mui('.refund_confirm').on('tap','.sure_btn',function(){
                    $(".refund_confirm").hide();
                    $(".refund_success").show().siblings().hide();
                    $(self).addClass("enable");
                    mui('body').on('tap','.refund_success',function(){
                        $("#my_confirm").hide();
                    })
                })
            }
        })
        //取消订单
        mui('body').on('tap','.cancel_order_btn',function(){
            var self=this;
            $("#my_confirm").show();
            $(".cancel_confirm").show().siblings().hide();
            mui('.cancel_confirm').on('tap','.cancel_btn',function(){
                $('#my_confirm').hide();
            })
            mui('.cancel_confirm').on('tap','.sure_btn',function(){
                $('#my_confirm').hide();
                $(self).parents("li").remove();
            })
        })
        //冲泡咖啡
//			mui('body').on('tap','.flush_btn',function(){
////				var self=this;
//				$("#flush_confirm").show();
//				$(".flush_busy").show().siblings().hide();
//				mui('#flush_confirm').on('tap','.flush_busy',function(){
//					$(this).next().show().siblings().hide();
//				})
//				mui('#flush_confirm').on('tap','.flush_place',function(){
//					$(this).next().show().siblings().hide();
//				})
//				mui('#flush_confirm').on('tap','.flush_ing',function(){
//					$(this).next().show().siblings().hide();
//				})
//				mui('#flush_confirm').on('tap','.flush_complete',function(){
//					$(this).hide();
//					$("#flush_confirm").hide();
//				}) 
//				mui('#flush_confirm').on('tap','.icon-guanbi1',function(){
//					$("#flush_confirm").hide();
//					$("#flush_confirm").children().hide();
//				}) 
//			}) 

        //赠送好友
        mui('body').on('tap','.share_btn',function(){
            $("#confirm_bottom").show();
            mui('body').on('tap','#confirm_bottom',function(){
                $(this).hide();
            })
            mui('#confirm_bottom').on('tap','.child_part',function(e){
                e.stopPropagation();
                e.preventDefault();
                $('#confirm_bottom').hide();
                $("#share_result").show();
//					分享代码
//
                if($(this).index()==0){
                    $(".share_success").show().siblings().hide();
                }else{
                    $(".share_fail").show().siblings().hide();
                }

                mui('#share_result').on('tap','div',function(){
                    $('#share_result').hide().children().hide();
                })
            })
        })

        mui('body').on('tap','a',function(){
            if(this.href){
                window.location=this.href;
            }
        })
    })
</script>
<script src="__MOBILE__/static/order/js/scan.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>

</body>
</html>