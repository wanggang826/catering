<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"D:\phpStudy\WWW\catering\public\theme\admin\publics\login.html";i:1512097839;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $admin_title; ?> - 登录</title>
    <link rel="shortcut icon" href="<?php echo $static_path; ?>favicon.ico">
    <link href="<?php echo $static_path; ?>css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo $static_path; ?>js/jquery.min.js"></script>
    <!-- bootstrap -->
    <link href="<?php echo $static_path; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo $static_path; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
    <link href="<?php echo $css; ?>animate.css" rel="stylesheet">
    <link href="<?php echo $css; ?>style.css" rel="stylesheet">
    <script>
        if(window.top !== window.self){ window.top.location = window.location;}
    </script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <!-- <h1 class="logo-name"><img src=""></h1> -->
            </div>
            <h3>餐饮管理后台登录</h3>

            <form class="m-t js-ajax-form" name="form" action="<?php echo url('login'); ?>" method="post" >
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="帐号" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b js-submit-btn">登 录</button>

                <p class="text-muted text-center">
                   <!-- <a href="login.html#"><small>忘记密码了？</small></a>-->
                </p>
            </form>
        </div>
    </div>

</body>
<style type="text/css">
    .logo-name img{
        width: 100px;
        height: 100px;
        margin-bottom: -45px
    }
</style>
<script src="<?php echo $static_path; ?>plugins/layui/layer/layer.js"></script>
<script src="<?php echo $static_path; ?>js/layer.com.js"></script>
<script src="<?php echo $static_path; ?>js/common.js"></script>
</html>
