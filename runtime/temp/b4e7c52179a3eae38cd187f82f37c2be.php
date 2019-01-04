<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"D:\phpStudy\WWW\catering\public\theme\admin\admins\add.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <title><?php echo $admin_title; ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- 引入公共css/js -->
<!-- 字体图标 -->
<!-- <link rel="shortcut icon" href="<?php echo $public_path; ?>favicon.ico"> -->
<link href="<?php echo $static_path; ?>css/font-awesome.min.css" rel="stylesheet">
<!-- JQuery -->
<script src="<?php echo $static_path; ?>js/jquery.min.js"></script>
<script src="<?php echo $static_path; ?>plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- bootstrap -->
<link href="<?php echo $static_path; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo $static_path; ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- 自定义样式 -->
<link href="<?php echo $css; ?>animate.css" rel="stylesheet">
<link href="<?php echo $css; ?>style.css" rel="stylesheet">

<!-- checkbox 和radio 美化 -->
<link href="<?php echo $static_path; ?>css/input.css" rel="stylesheet">
<!-- <link href="<?php echo $static_path; ?>/css/checkbox.css" rel="stylesheet">
<script src="<?php echo $static_path; ?>/js/checkbox.js"></script> -->

<!-- select 美化 -->
<link href="<?php echo $static_path; ?>css/select.css" rel="stylesheet">
<link href="<?php echo $static_path; ?>plugins/jquery/scrollbar.css" rel="stylesheet">
<script src="<?php echo $static_path; ?>plugins/jquery/scrollbar.js"></script>
<script src="<?php echo $static_path; ?>js/select.js"></script>

<link href="<?php echo $static_path; ?>css/common.css" rel="stylesheet">

<link href="<?php echo $static_path; ?>plugins/editor/wangEditor.min.css" rel="stylesheet">

<!-- jquery tableEport -->
<link href="<?php echo $css; ?>tableexport.min.css" rel="stylesheet">
    <style>
        .layout-return-btn{
            position: relative;
            top: -8px;
            left: -6px;
            margin: 0!important;
        }
        body{
            height: 1vh;
        }
    </style>
</head>
<body class="gray-bg  animated fadeIn">
    <div class="wrapper wrapper-content ibox float-e-margins" >
        <div class="ibox-title visible-lg">
            <!-- <h5> -->
                <ul class="breadcrumb inline pull-left" >
                    <li><?php echo $menu['pmenu']; ?></li>
                    <li><?php echo $menu['menu_name']; ?></li>
                </ul>
            <!-- </h5> -->
            <a class="pull-right btn btn-default btn-xs" title="刷新当前" href=""><i class="fa fa-refresh"></i></a>
        </div>
        <div class="ibox-content">
<form class="form-horizontal js-ajax-form clearfix" action='<?php echo url('add'); ?>' method='post'>
    <!-- 自定义大小 -->
    <div class="form-group">
        <label for="account" class="col-sm-2 control-label">帐号</label>
        <div class="col-sm-4">
            <input type="text" name="account" class="form-control" id="account" placeholder="帐号以字母开头，只允许字母、数字和下划线">
        </div>
    </div>
    <div class="form-group">
        <label for="nickname" class="col-sm-2 control-label">昵称</label>
        <div class="col-sm-4">
            <input type="text" name="nickname" class="form-control" id="nickname" placeholder="昵称">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-4">
            <input type="password" name="password" class="form-control" id="password" placeholder="密码">
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">手机</label>
        <div class="col-sm-4">
            <input type="tel" name="phone" class="form-control" id="phone" placeholder="手机">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-4">
            <input type="email" name="email" class="form-control" id="email" placeholder="邮箱">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">用户组</label>
        <div class="col-sm-4">
            <select class="i-select form-control" name="group">
                <?php if(is_array($authGroup) || $authGroup instanceof \think\Collection || $authGroup instanceof \think\Paginator): $i = 0; $__LIST__ = $authGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['group_id']; ?>"><?php echo $vo['group_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">状态</label>
        <div class="col-sm-4">
              <label class="i-lab"><input type="radio" name="status" value='1' class="mgr mgr-primary" checked><span>正常</span></label>
              <label class="i-lab"><input type="radio" name="status" value='0' class="mgr mgr-primary" ><span>禁用</span></label>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label"></label>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button>
            <button type="reset" class="btn btn-info">重置</button>
        </div>
    </div>
</form>
        </div>
    </div>
</body>
<!-- 全局js -->
<script src="<?php echo $static_path; ?>plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- 第三方插件，加载进度条 -->
<script src="<?php echo $static_path; ?>plugins/pace/pace.min.js"></script>

<!-- layui -->
<script src="<?php echo $static_path; ?>plugins/layui/layer/layer.js"></script>
<script src="<?php echo $static_path; ?>plugins/layui/laydate/laydate.js"></script>

<!-- 自定义js -->
<script src="<?php echo $static_path; ?>js/layer.com.js"></script>
<script src="<?php echo $static_path; ?>js/common.js"></script>
<script src="<?php echo $static_path; ?>js/vue.js"></script>
<script src="<?php echo $js; ?>hplus.js"></script>
<script src="<?php echo $js; ?>contabs.js"></script>

<!-- Jquery-tableExport -->
<script src="<?php echo $js; ?>tableexport.min.js"></script>
<script src="<?php echo $js; ?>FileSaver.min.js"></script>
<script src="<?php echo $js; ?>blob.js"></script>
<script src="<?php echo $js; ?>xlsx.core.min.js"></script>

</html>
<style type="text/css">
    .panel-heading{
        display: none;
    }
    .panel-footer{
        background-color: #fff;
        border: none
    }
    .panel-body.form-inline .form-group{
        margin-right: 10px!important;
        margin-bottom: 10px!important;

    }
    .panel-body.form-inline .form-group .form-control{
        width: 200px;
    }
    .panel-body.form-inline .form-group.group1 .form-control,
    .panel-body.form-inline .form-group.group2 .form-control
    {
        width: 205px;
    }
    .panel-body.form-inline{
        padding-bottom: 0;
    }
    .panel-body.form-inline .form-group.pull-right {
        margin: 0!important;
    }
    .panel-body.form-inline .form-group.group1{
        margin-right: 0px!important;
    }
</style>
<script type="text/javascript">
    // 页面初始化
    $(function(){
        $('a').click(function(){
            $(this).blur();
        })
        $('.city-picker-span').css('width', '');
    })

</script>