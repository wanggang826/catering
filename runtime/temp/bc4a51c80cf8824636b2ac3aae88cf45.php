<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"D:\phpStudy\WWW\catering\public\theme\admin\member\edit.html";i:1512380502;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<script src="<?php echo $static_path; ?>/js/uploadImg.js"></script>
<form class="form-horizontal js-ajax-form clearfix" action="<?php echo url('edit'); ?>" method='post' enctype=multipart/form-data>
    <!-- 自定义大小 -->
    <div class="row">
        <div class="col-xs-6 col-sm-6">
            <div class="form-group">
                <label for="user_sn" class="col-sm-2 control-label">用户ID</label>
                <div class="col-sm-10">
                    <input type="text" name="user_sn" class="form-control" id="user_sn" value="<?php echo isset($data) ? $data['user_sn'] : ''; ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="nickname" class="col-sm-2 control-label">昵称</label>
                <div class="col-sm-10">
                    <input type="text" name="nickname" class="form-control" id="nickname" value="<?php echo isset($data) ? $data['nickname'] : ''; ?>" readonly >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">性别</label>
                <div class="col-sm-10">
                    <?php if(isset($data)): ?>
                    <label class="i-lab">
                        <input type="radio" name="sex" value='male' class="mgr mgr-primary  mgr-lg" <?php if($data['sex'] == 'male'): ?> checked<?php endif; ?>><span>男性</span>
                    </label>
                    <label class="i-lab">
                        <input type="radio" name="sex" value='female' class="mgr mgr-primary mgr-lg" <?php if($data['sex'] == 'female'): ?> checked<?php endif; ?>><span>女性</span>
                    </label>
                    <label class="i-lab">
                        <input type="radio" name="sex" value='none' class="mgr mgr-primary mgr-lg" <?php if($data['sex'] == 'none'): ?> checked<?php endif; ?>><span>未知</span>
                    </label>
                    <?php else: ?>
                    <label class="i-lab">
                        <input type="radio" name="sex" value='male' class="mgr mgr-primary  mgr-lg" readonly><span>男性</span>
                    </label>
                    <label class="i-lab">
                        <input type="radio" name="sex" value='female' class="mgr mgr-primary mgr-lg" readonly><span>女性</span>
                    </label>
                    <label class="i-lab">
                        <input type="radio" name="sex" value='none' class="mgr mgr-primary mgr-lg" readonly><span>未知</span>
                    </label>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="user_phone" class="col-sm-2 control-label">手机号码</label>
                <div class="col-sm-10">
                    <input type="text" name="user_phone" class="form-control" id="user_phone" value="<?php echo isset($data) ? $data['user_phone'] : ''; ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="create_time" class="col-sm-2 control-label">注册时间</label>
                <div class="col-sm-10">
                    <input type="text" name="weixinid" class="form-control" id="create_time" value="<?php echo isset($data) ? $data['create_time'] : ''; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6">
            <?php if(isset($data)): ?>
                <img style="margin: 17px 60px;width: 200px;" src="__UPLOAD__<?php echo $data['image']; ?>">
            <?php else: ?>
                <img style="margin: 17px 60px;width: 200px;" src="">
            <?php endif; ?>

        </div>
    </div>

<?php if(isset($addresses)): ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>收货人</th>
                <th>联系方式</th>
                <th>详细地址</th>
                <th>是否默认</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($addresses) || $addresses instanceof \think\Collection || $addresses instanceof \think\Paginator): $i = 0; $__LIST__ = $addresses;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><?php echo $vo['name']; ?></td>
                <td><?php echo $vo['mobile']; ?></td>
                <td><?php echo $vo['address']; ?></td>
                <td>
                    <?php if($vo['is_default'] == 1): ?>
                        是
                    <?php else: ?>
                        否
                    <?php endif; ?>
                </td>

            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

    <div class="form-group">
        <label class="col-xs-6 col-sm-6 control-label"></label>
        <div class="col-xs-6 col-sm-6">
            <a href="<?php echo url('index'); ?>" class="btn btn-info mr_3px">返回列表</a>
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