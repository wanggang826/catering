<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:61:"D:\www\alasika\public\theme\admin\publish_adv\add_device.html";i:1503460468;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
    <div class="panel panel-default">
    <form role="form" action="<?php echo url('add_material'); ?>" class="form-inline panel-body ">
        <div class="form-group" style="display: inline-block">
            <label for="ex1" class="sr-only">型号名称</label>
            <input type="text" name="container_code" class="form-control" id="container_code" value="<?php echo input('container_code'); ?>" placeholder="型号名称">
        </div>
        <select class="form-control" name="status">
            <option value="">状态</option>
            <option <?php if(input('status') == 0 && input('status') != ''): ?>selected="selected"<?php endif; ?> value="0">禁用</option>
            <option <?php if(input('status') == 1): ?>selected="selected"<?php endif; ?> value="1">启用</option>
        </select>
        <!--<div class="form-group">-->
        <!--<label for="ex3" class="sr-only">选项值</label>-->
        <!--<input type="text" placeholder="选项值搜索" id="ex3" class="form-control" name="option_value" value="<?php echo input('option_value'); ?>">-->
        <!--</div>-->
        <div class="form-group pull-right" style="margin-bottom: 10px!important;;">
            <div class="btn-group">
                <button class="btn btn-primary btn-outline btn-w-m btn-rec">
                    <i class="fa fa-search"></i><span class="btn-desc">&nbsp;查询</span>
                </button>
                <a href="<?php echo url(''); ?>" class="btn btn-default btn-outline btn-rec">
                    <i class="fa fa-refresh"></i><span class="btn-desc">&nbsp;重置</span>
                </a>
            </div>
        </div>
    </form>
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered table-condensed">
        <input type="hidden" name="material_id" value="1">
        <thead>
        <tr>
            <th width='1'><input type="checkbox" class="my-all-check"></th>
            <th width="50">ID</th>
            <th width="150">售货机编号</th>
            <th width="150">点位名称</th>
        </tr>
        </thead>
        <tbody id="leg">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td width='1'><input type="checkbox" value="<?php echo $vo['id']; ?>" class="i-checks" name="checkbox"></td>
                    <td><?php echo $vo['id']; ?></td>
                    <td><?php echo $vo['device_code']; ?></td>
                    <td><?php echo $vo['point_name']; ?></td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<div style="height: 30px;" id="transmit">
    <a href="#" class="btn btn-default  pull-right">
        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;确定
    </a>
</div>


<div class="pages">
    <div class="plist"><?php echo $page; ?></div>
</div>
<script type="text/javascript">
    //提交数据
    $('#transmit').click(function () {
        var le = $('#leg').children('tr').length;
        var id = new Array();
        var i = 0;
        $.each($('input[name=checkbox]:checked'),function(){
            if(i<le){
                id[i] = $(this).val();
                i++;
            }
        });
        $.ajax({
            type: "POST",
            url: "<?php echo url('device_add'); ?>",
            data: {'id':id},
            success: function(a) {
                if (a.status == 1) {
                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                    layer.msg('添加成功！', {icon: 6,shade: [0.7,'#000'],time:2000});
                    parent.$('#parentIframes').html(a.res);
                    parent.$('#device_number').val(a.num);
                    parent.$('#device_id').val(a.id);
                    parent.layer.close(index);
                } else {
                    layer.alert(a.res, {icon: 0});
                }
            },
            dataType: "json"
        })
    });



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