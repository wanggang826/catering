<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"D:\www\alasika\public\theme\admin\device\control_add.html";i:1503906251;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput.min.css" rel="stylesheet">
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput-rtl.css" rel="stylesheet">
<script src="<?php echo $static_path; ?>plugins/fileinput/js/fileinput.js"></script>
<script src="<?php echo $static_path; ?>plugins/fileinput/js/locales/zh.js"></script>
<script src="<?php echo $static_path; ?>/js/checkForm.js"></script>
<script src="<?php echo $static_path; ?>js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
<form class="form-horizontal js-ajax-form clearfix" id="validate_form" action='<?php echo url('control_add'); ?>' enctype="multipart/form-data">
   <div class="form-group">
        <label for="" class="col-sm-2 control-label">控制端型号</label>
        <div class="col-sm-4">
            <input type="text" name="control_name" class="form-control" id="control_name" placeholder="控制端型号" js-check="control_name">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">启用状态</label>
        <div class="col-sm-4">
			<select   class="form-control"  name="status" id="status">
                <option value="0">禁用</option>
                <option value="1" selected="selected">启用</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">适配厂家</label>
        <div class="col-sm-4">
            <select   class="form-control"  name="manufacturer_id" js-check="manufacturer_id">
                <option value="">适配厂家</option>
                <?php if(is_array($manufacturer) || $manufacturer instanceof \think\Collection || $manufacturer instanceof \think\Paginator): if( count($manufacturer)==0 ) : echo "" ;else: foreach($manufacturer as $key=>$vo): ?>
                    <option value="<?php echo $vo['factor_id']; ?>"><?php echo $vo['factor_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">工控机型号</label>
        <div class="col-sm-4">
            <input type="text" name="IPC" class="form-control" id="IPC" placeholder="工控机型号" js-check="IPC">
        </div>
    </div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">适配系统</label>
    <div class="col-sm-4">
        <select   class="form-control"  name="system_id" js-check="system_id">
            <option value="">适配系统</option>
            <option value="1">Android</option>
            <option value="2">Windows</option>
            <option value="3">Linux</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">显示屏尺寸</label>
    <div class="col-sm-4">
        <input type="text" name="display_size" class="form-control" id="display_size" placeholder="显示屏尺寸" js-check="display_size">
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">显示屏分辨率</label>
    <div class="col-sm-4">
        <select   class="form-control"  name="resolution_id" js-check="resolution_id">
            <option value="">显示屏分辨率</option>
            <option value="1">1024*600</option>
            <option value="2">1920*1080</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">显示屏方向</label>
    <div class="col-sm-4">
        <select   class="form-control"  name="direction_id" js-check="direction_id">
            <option value="">显示屏方向</option>
            <option value="1">竖</option>
            <option value="2">横</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">图片</label>
    <div class="col-sm-4" id="file-fj">
        <label class="control-label">选择图片</label>
        <input id="input-4" name="input-4" type="file" class="fileinput" file_name="image" file_type="image"  data-show-caption="true"><!-- multiple -->
    </div>
</div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">备注</label>
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

<script type="text/javascript">
    /*
     * 验证
     * */
    function control_name(e){
        var control_name = $(e).val();
        if (control_name == '') {
            return '请填写控制端型号!';
        }
        return true;
    }
    function manufacturer_id(e){
        var manufacturer_id = $(e).val();
        if (manufacturer_id == '') {
            return '请选择适配厂家!';
        }
        return true;
    }
    function IPC(e){
        var IPC = $(e).val();
        if (IPC == '') {
            return '请填写工控机型号!';
        }
        return true;
    }
    function system_id(e){
        var system_id = $(e).val();
        if (system_id == '') {
            return '请选择适配系统!';
        }
        return true;
    }
    function display_size(e){
        var display_size = $(e).val();
        if (display_size == '') {
            return '请填写显示器屏幕尺寸!';
        }
        return true;
    }
    function resolution_id(e){
        var resolution_id = $(e).val();
        if (resolution_id == '') {
            return '请选择屏幕分辨率!';
        }
        return true;
    }
    function direction_id(e){
        var direction_id = $(e).val();
        if (direction_id == '') {
            return '请填写显示器方向!';
        }
        return true;
    }
    var file_type=$(".fileinput").attr("file_type");
    if(file_type=='file'){
        var upload_url="<?php echo url('admin/publics/upload_file',array('type'=>'file')); ?>";
        var delete_url="<?php echo url('admin/publics/delete_file',array('type'=>'file')); ?>";
    }else{
        var upload_url="<?php echo url('admin/publics/upload_file'); ?>";
        var delete_url="<?php echo url('admin/publics/delete_file'); ?>";
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