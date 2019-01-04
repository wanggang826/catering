<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:54:"D:\www\alasika\public\theme\admin\adv_matter\edit.html";i:1505116552;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput.min.css" rel="stylesheet">
<script src="<?php echo $static_path; ?>plugins/fileinput/js/fileinput.js"></script>
<script src="<?php echo $static_path; ?>plugins/fileinput/js/locales/zh.js"></script>
<form class="form-horizontal js-ajax-form clearfix" action='<?php echo url('edit'); ?>'>
<input type="hidden" name="adv_id" class="form-control" id="adv_id"  value="<?php echo $partition['adv_id']; ?>">
<div class="form-group">
    <label for="serial_numbe" class="col-sm-2 control-label">编号</label>
    <div class="col-sm-4">
        <input type="text" name="serial_numbe"  class="form-control" id="serial_numbe" value="<?php echo $partition['serial_numbe']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="ma_name" class="col-sm-2 control-label">名称</label>
    <div class="col-sm-4">
        <input type="text" name="ma_name" class="form-control" id="ma_name" value="<?php echo $partition['ma_name']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="adv_status" class="col-sm-2 control-label">状态</label>
    <div class="col-sm-4">
        <label class="i-lab"><input type="radio" name="adv_status" value='1' class="mgr mgr-primary" <?php if($partition['adv_status'] == 1): ?> checked<?php endif; ?>><span>启用</span></label>
        <label class="i-lab"><input type="radio" name="adv_status" value='2' class="mgr mgr-primary" <?php if($partition['adv_status'] == 2): ?> checked<?php endif; ?>><span>禁用</span></label>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">附件</label>
    <div class="col-sm-4" id="file-fj">
        <label class="control-label">选择文件</label>
        <input id="input-4" name="input-4" type="file" class="fileinput" file_name="material" file_type="image"  data-show-caption="true">
    </div>
</div>
<div class="form-group">
    <label for="remarks" class="col-sm-2 control-label">备注</label>
    <div class="col-sm-9">
        <textarea class="form-control" id="remarks" name="remarks"><?php echo $partition['remarks']; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <button type="submit" class="btn btn-primary js-submit-btn mr_3px">确认</button>
        <button type="reset" class="btn btn-primary">重置</button>
    </div>
</div>
</form>
<script type="text/javascript">
    var file_type=$(".fileinput").attr("file_type");
    if(file_type=='file'){
        var upload_url="<?php echo url('admin/publics/upload_file',array('type'=>'file')); ?>";
        var delete_url="<?php echo url('admin/publics/delete_file',array('type'=>'file')); ?>";
    }else{
        var upload_url="<?php echo url('admin/publics/upload_file'); ?>";
        var delete_url="<?php echo url('admin/publics/delete_file'); ?>";
    }
    var file_data=<?php echo $partition['show_image']; ?>;
</script>
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