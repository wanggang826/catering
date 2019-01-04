<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:54:"D:\www\alasika\public\theme\admin\publish_adv\add.html";i:1503460468;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<form class="form-horizontal js-ajax-form clearfix" action='<?php echo url('add'); ?>'>
<div class="form-group">
    <label for="serial_number" class="col-sm-2 control-label">编号</label>
    <div class="col-sm-4">
        <input type="text" name="serial_number" class="form-control" id="serial_number" placeholder="编号">
    </div>
</div>
<div class="form-group">
    <label for="publish_name" class="col-sm-2 control-label">名称</label>
    <div class="col-sm-4">
        <input type="text" name="publish_name" class="form-control" id="publish_name" placeholder="名称">
    </div>
</div>
<div class="form-group">
    <label for="status" class="col-sm-2 control-label">状态</label>
    <div class="col-sm-4">
        <select   class="form-control"  name="status" id="status">
            <option value="1">启用</option>
            <option value="2">禁用</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="location" class="col-sm-2 control-label">广告位置</label>
    <div class="col-sm-4">
        <select   class="form-control"  name="location" id="location">
            <option value="">选择广告位置</option>
            <?php if(is_array($location) || $location instanceof \think\Collection || $location instanceof \think\Paginator): if( count($location)==0 ) : echo "" ;else: foreach($location as $k=>$ov): ?>
                <option value="<?php echo $k; ?>"><?php echo $ov; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="take_effect_time" class="col-sm-2 control-label">生效时间</label>
    <div class="col-sm-4">
        <input type="text" name="take_effect_time" class="form-control i-datestart" id="take_effect_time" placeholder="生效时间" >
    </div>
</div>
<div class="form-group">
    <label for="time" class="col-sm-2 control-label">时长</label>
    <div class="col-sm-4">
        <input type="text" name="time" class="form-control" id="time" placeholder="时长">
    </div>
</div>
<div class="form-group">
    <label for="matter_number" class="col-sm-2 control-label">素材数量</label>
    <div class="col-sm-4">
        <input type="text" name="matter_number" style="background-color: #ffffff" readonly="readonly" class="form-control" id="matter_number" placeholder="素材数量">
    </div>
</div>
<div class="form-group">
    <label for="device_number" class="col-sm-2 control-label">咖啡机数量</label>
    <div class="col-sm-4">
        <input type="text" name="device_number" style="background-color: #ffffff" readonly="readonly" class="form-control" id="device_number" placeholder="咖啡机数量">
    </div>
</div>
<div class="form-group">
    <label for="create_time" class="col-sm-2 control-label">创建时间</label>
    <div class="col-sm-4">
        <input type="text" name="create_time" class="form-control" style="background-color: #ffffff" readonly="readonly" id="create_time" placeholder="创建时间" >
    </div>
</div>
<div class="form-group">
    <label for="remarks" class="col-sm-2 control-label">备注</label>
    <div class="col-sm-4">
        <input type="text" name="remarks" class="form-control" id="remarks" placeholder="备注" >
    </div>
</div>
<input type="hidden" id="advertising_id" name="advertising_id" value="">
<input type="hidden" id="device_id" name="device_id" value="">
<div class="form-group">
    <label for="describe" class="col-sm-2 control-label">选择素材</label>
    <div class="col-sm-9">
        <div >
            <a href="#" js-title="新增" id="add_material" class="btn btn-default">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
            </a>
        </div>
        <table class="table table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <th width="50"></th>
                    <th width="150">素材编号</th>
                    <th width="150">素材名称</th>
                    <th width="150">时长</th>
                </tr>
                </thead>
                <tbody class="tbody" id="parentIframe">

                </tbody>
        </table>
    </div>
</div>
<div class="form-group">
    <label for="describe" class="col-sm-2 control-label">选择售货机</label>
    <div class="col-sm-9">
        <div >
            <a href="#" js-title="新增" id="add_device" class="btn btn-default">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
            </a>
        </div>
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th width="50"></th>
                <th width="150">售货机编号</th>
                <th width="150">点位名称</th>
            </tr>
            </thead>
            <tbody class="tbody" id="parentIframes">

            </tbody>
        </table>
    </div>
</div>
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <button type="submit" class="btn btn-primary js-submit-btn mr_3px">确认</button>
        <button type="reset" class="btn btn-primary">重置</button>
    </div>
</div>
</form>
<script type="text/javascript">
    $('#add_material').click(function () {
        layer.open({
            type: 2,
            title: false,
            area: ['80%', '80%'],
            shade: 0.8,
            closeBtn: 0,
            shadeClose: true,
            content: '<?php echo url('add_material'); ?>'
        });
    })
    $('#add_device').click(function () {
        layer.open({
            type: 2,
            title: false,
            area: ['80%', '80%'],
            shade: 0.8,
            closeBtn: 0,
            shadeClose: true,
            content: '<?php echo url('add_device'); ?>'
        });

    })

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