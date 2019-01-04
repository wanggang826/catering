<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"D:\www\alasika\public\theme\mobile\user\login.html";i:1505209300;s:53:"D:\www\alasika\public\theme\mobile\layout\layout.html";i:1505208863;s:53:"D:\www\alasika\public\theme\mobile\layout\footer.html";i:1505210465;}*/ ?>
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
<title>个人中心</title>
<link rel="stylesheet" href="__MOBILE__/static/user/css/center.css" />
<header class="mui-bar mui-bar-nav my-nav">
	    <h1 class="mui-title denglu">个人中心</h1>
	</header>
		<div class="mui-content">
			<div class="center-logo">
				<img src="__MOBILE__/static/user/img/logo.png" alt="" />
			</div>
			<div class="center">
				<div class="center-top">
					<a class="border-a">登录</a>
					<a>注册</a>
				</div>
				<div class="center-center">
					<input type="number" name="phone" id="phone" placeholder="请输入手机号"/>
					<input class="center-input" type="number" name="code" placeholder="请输入验证码"/><button style="top:0" class="center-a" id="code" onclick="send_code()">获取验证码</button>
				</div>
				<div class="center-bottom" onclick="form_submit()">
					<a >提交</a>
				</div>
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
		var data=1;
		mui('body').on('tap','a',function(){
			if(this.href){
				window.location.href=this.href;
			}else{
				return false;
			}	
		})
		mui('body').on('tap','a',function(){
			$(this).addClass('border-a');
			$(this).siblings('a').removeClass('border-a');
		})

        var countdown = 60;
        function set_time(obj) { //发送验证码倒计时
            if (countdown == 0) {
                obj.attr('disabled',false);
                obj.html("获取验证码");
                countdown = 60;
                return;
            } else {
                obj.attr('disabled',true);
                obj.html("重新发送(" + countdown + ")");
                countdown--;
            }
            setTimeout(function() {set_time(obj) },1000)
        }
        function send_code(){
            var obj = $("#code");
			set_time(obj);
            $.ajax({
                type: "get",
                url: "get_code",
                data: {"phone": $('#phone').val()},
                dataType: "json",
                success: function (data) {
                    if(data.code < 0){
                        mui.toast(data.msg, { duration:1600, type:'div' });
                        countdown = 0;
                    }
                }
            });
        }
		function form_submit() {
            $.ajax({
                type: "get",
                url: "login",
                data: {"phone": $('#phone').val(), "code": $('input[name="code"]').val()},
                dataType: "json",
                success: function (data) {
                    if(data.code < 0){
                        mui.toast(data.msg, { duration:1600, type:'div' });
                    }else{
                        window.location.href='<?php echo url("user/index"); ?>';
                    }
                }
            });

        }

	</script>

</body>
</html>