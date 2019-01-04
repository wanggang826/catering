<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:49:"D:\www\alasika\public\theme\mobile\user\info.html";i:1505209285;s:53:"D:\www\alasika\public\theme\mobile\layout\layout.html";i:1505208863;s:53:"D:\www\alasika\public\theme\mobile\layout\footer.html";i:1505208868;}*/ ?>
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
	<title>个人信息</title>
	<link rel="stylesheet" href="__MOBILE__/static/user/css/install.css" />
	<header class="mui-bar mui-bar-nav my-nav">
	    <a class="mui-action-back mui-icon my-a
	    	mui-icon-left-nav mui-pull-left"></a>
	    <h1 class="mui-title denglu">个人信息</h1>
	</header>
	<div class="mui-content">
	    <ul class="mui-table-view">
		    <li class="mui-table-view-cell xinxi-li">
		        <a class="mui-navigate-right my-tou" id="headImage"><span>头像</span><img class="fright" src="__MOBILE__/static/user/img/touxiang.png"/></a>
		    </li>
		    <li class="mui-table-view-cell">
		        <a href="<?php echo url('nickname',['user_id'=>$info['id']]); ?>" class="mui-navigate-right">昵称<span class="fright"><?php echo $info['nickname']; ?></span></a>
		    </li>
		    <li class="mui-table-view-cell sex-li">
		        <a class="mui-navigate-right">性别<span class="fright"><?php echo text_sex($info['sex'] ); ?></span></a>
		    </li>
		   	<li class="mui-table-view-cell">
		        <a href="<?php echo url('self',['user_id'=>$info['id']]); ?>" class="mui-navigate-right">个人介绍<span class="fright">（不超过15个字）</span></a>
		    </li>
		</ul>
		<ul class="mui-table-view amend-phone">
		    <li class="mui-table-view-cell xinxi-li">
		        <a href="<?php echo url('phone',['user_id'=>$info['id']]); ?>" class="mui-navigate-right">修改手机号码</a>
		    </li>
		</ul>
		<div class="install-btn btn-eixt"><a>退出登录</a></div>
	</div>
	<div class="my-backdrop xinxi-backdrop baocun">
		<div class="install-div">
			<span>保存成功</span><a class="iconfont icon-duihao"></a>
		</div>
	</div>

	<div class="mui-backdrop sex-backdrop">
		<div class="xiangji" id="sex">
			<p data-sex="2" class="sex-p"><a>女</a></p>
			<p data-sex="1" class="sex-p"><a>男</a></p>
			<p class="quxiao"><a>取消</a></p>
		</div>
	</div>

	<div class="mui-backdrop xinxi-backdrop xiang">
		<div class="xiangji">
			<p><a>相机选取</a></p>
			<p><a>从相册选取</a></p>
		</div>
	</div>
	<div class="mui-backdrop exit-backdrop">
		<div class="xiangji">
			<p class="exit-p exit-active"><a href="<?php echo url('logout'); ?>">退出登录</a></p>
			<p class="exit-quxiao"><a>取消</a></p>
		</div>
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
	<script type="text/javascript" src="__MOBILE__/static/user/js/install.js"></script>

	<script type="text/javascript">
        mui('body').on('tap','.sex-p',function () {
                var sex = $(this).data('sex');
                if(sex == ''){
                    return
                }
                $.ajax({
                    type: "post",
                    url: "<?php echo url('user/edit'); ?>",
                    data: {"field" : "sex", "user_id": "<?php echo $info['id']; ?>", "sex": sex},
                    dataType: "json",
                    success: function (data) {
                        mui.toast(data.msg, { duration:1000, type:'div' });
                        setTimeout(function(){window.location.href = '<?php echo url("index"); ?>';}, 1000)
                    }
                });
            })
	</script>




















</body>
</html>