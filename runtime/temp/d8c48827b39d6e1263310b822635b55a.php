<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"D:\www\alasika\public\theme\mobile\user\nickname.html";i:1505209306;s:53:"D:\www\alasika\public\theme\mobile\layout\layout.html";i:1505208863;s:53:"D:\www\alasika\public\theme\mobile\layout\footer.html";i:1505208868;}*/ ?>
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

    <title>昵称</title>
    <link rel="stylesheet" href="__MOBILE__/static/user/css/amend.css" />
	<header class="mui-bar mui-bar-nav my-nav">
	    <a class="mui-action-back mui-icon my-a
	    	mui-icon-left-nav mui-pull-left"></a>
	    <h1 class="mui-title denglu">昵称</h1>
	    <a class="mui-icon my-a mui-pull-right my-pull-right" onclick="submit()">保存</a>
	</header>
	<div class="mui-content">
		<form class="mui-input-group Dr amend_user Br">
		    <div class="mui-input-row shurukuang Dr">
		    	<input minlength='1' maxlength='8' type="text" class="mui-input-clear my-input amend-input" placeholder="请输入您的昵称" name="nickname" value="<?php echo $data['nickname']; ?>">
		    </div>
		</form>
	</div>
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
	<script>
        function submit() {
            $.ajax({
                type: "post",
                url: "<?php echo url('user/edit'); ?>",
                data: {"field":"nickname", "user_id": "<?php echo $data['id']; ?>", "nickname": $('input[name="nickname"]').val()},
                dataType: "json",
                success: function (data) {
                    mui.toast(data.msg, { duration:1600, type:'div' });
					setTimeout(function(){window.location.href = "<?php echo url('user/info'); ?>";}, 1000)
                }
            });
        }
	</script>
</body>
</html>