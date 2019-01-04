<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"D:\www\alasika\public\theme\admin\printing\printing_add.html";i:1503994481;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput-rtl.css" rel="stylesheet">
<script src="<?php echo $static_path; ?>plugins/fileinput/js/fileinput.js"></script>
<script src="<?php echo $static_path; ?>plugins/fileinput/js/locales/zh.js"></script>
<script src="<?php echo $static_path; ?>/js/checkForm.js"></script>
<form class="form-horizontal js-ajax-form clearfix" id="validate_form" action="<?php echo url('printing_add'); ?>" enctype="multipart/form-data">
   <div class="form-group">
        <label for="" class="col-sm-2 control-label">印花机编号</label>
        <div class="col-sm-4">
            <input type="text" name="printing_code" class="form-control" id="printing_code" placeholder="印花机编号" js-check="printing_code">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">启用状态</label>
        <div class="col-sm-4">
            <?php echo diction_option("status",1,'radio'); ?>
        </div>
    </div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">印花机型号</label>
    <div class="col-sm-4">
            <select   class="form-control"  name="model_id" js-check="model_id">
                <option value="">请选择印花机型号</option>
                <?php if(is_array($printing_model) || $printing_model instanceof \think\Collection || $printing_model instanceof \think\Paginator): if( count($printing_model)==0 ) : echo "" ;else: foreach($printing_model as $key=>$vo): ?>
                <option value="<?php echo $vo['model_id']; ?>"><?php echo $vo['model_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">控制端版本</label>
    <div class="col-sm-4">
        <input type="text" name="model_version" class="form-control" id="model_version" placeholder="控制端版本" js-check="model_version">
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">激活时间</label>
    <div class="col-sm-4">
        <input class="form-control i-date" istime="YYYY-MM-DD hh:mm:ss" placeholder="激活时间" id="LAY_demorange_s" name="active_time">
    </div>
</div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">描述</label>
        <div class="col-sm-4">
            <textarea rows="3" cols="30" name="description"></textarea>
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
<script src="<?php echo $static_path; ?>plugins/layui/laydate/laydate.js"></script>
<script type="text/javascript">
    /*
     * 验证
     * */
    function printing_code(e){
        var printing_code = $(e).val();
        if (printing_code == '') {
            return '请填写印花机编号!';
        }
        return true;
    }
    function model_id(e){
        var model_id = $(e).val();
        if (model_id == '') {
            return '请选择印花机型号!';
        }
        return true;
    }
    function model_version(e){
        var model_version = $(e).val();
        if (model_version == '') {
            return '请填写印花机端版本!';
        }
        return true;
    }
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