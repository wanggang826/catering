<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:52:"D:\www\alasika\public\theme\admin\device\manage.html";i:1504076831;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
    <form method="get" id="query_data">
    <div class="panel-footer clearfix ">
        <div class="pull-left btn-group hidden-xs" >
            <a href="<?php echo url('device_add'); ?>" js-title="新增" class="btn btn-default js-window-load" js-title="新增" js-unique="true" js-width="60%" js-height="80%">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
            </a>
            <a href="<?php echo url('del_device'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="删除后将无法恢复，请谨慎操作">
                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;批量删除
            </a>
            <a href="javascript:export_device()" class="btn btn-default btn-outline">
                <i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;导出
            </a>
        </div>
        <div class="pull-right">
            <select class="form-control" name="status">
                <?php echo diction_option("status",input('status')); ?>
            </select>
                <input type="text" name="query_condition" class="form-control" id="container_code" value="<?php echo input('query_condition'); ?>" placeholder="编号/点位">
                <button class="btn btn-primary btn-outline btn-w-m btn-rec" type="submit">
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
        <thead>
            <tr>
                <th width="1"><input type="checkbox" class="my-all-check" name="input[]"></th>
                <th width="240">操作</th>
                <th width="150" class="hidden-xs">咖啡机编号</th>
                <th width="150">所在点位</th>
                <th width="150" class="hidden-xs">机型图片</th>
                <th width="150" class="hidden-xs">控制端型号</th>
                <th width="150" class="hidden-xs">控制端版本号</th>
                <th width="150" class="hidden-xs">绑定印花机编号</th>
                <th width="150" class="hidden-xs">咖啡机容量</th>
                <th width="200" class="hidden-xs">备注</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($data) > 0): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
        <tr>
            <td><input type="checkbox" class="i-checks" value="<?php echo $vo['id']; ?>" name="input[]"></td>
            <td>
                <span class="btn-group">
                    <a href="<?php echo url('device_edit',array('id'=>$vo['id'])); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="编辑"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">编辑</span></a>
                    <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): if( count($status)==0 ) : echo "" ;else: foreach($status as $key=>$item): if($vo['status'] != $key): ?>
                    <a href="<?php echo U('printing_edit',['id'=>$vo['id'],'status'=>$key,'update_status'=>1]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="启用后可以正常展示"><i class="fa <?php if($vo['status'] == 1): ?>fa-times<?php else: ?>fa-check<?php endif; ?> fa-fw"></i><span class="hidden-xs"><?php echo $item; ?></span></a>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <a href="<?php echo url('del_device',['id'=>$vo['id']]); ?>" class="btn  btn-danger btn-outline btn-xs js-del-btn" text="删除后将无法恢复,请谨慎操作！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a>
                </span>
            </td>
            <td><?php echo $vo['device_code']; ?></td>
            <td><?php echo $vo['point_name']; ?></td>
            <td><?php if($vo['image']): ?>预览<img class="hover_img" src="/<?php echo $vo['image']; ?>"><?php endif; ?></td>
            <td><?php echo $vo['control_name']; ?></td>
            <td><?php echo $vo['control_version']; ?></td>
            <td><?php echo $vo['printing_code']; ?></td>
            <td><?php echo $vo['capacity']; ?></td>
            <td><?php echo $vo['description']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; else: ?>
        <tr>
            <td colspan="10">暂无数据</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="pages">
        <?php echo $data->render(); ?>
    </div>
    </div>
    <script type="text/javascript">
        $(function(){
            document.onkeydown = function(e){
                var ev = document.all ? window.event : e;
                if(ev.keyCode==13) {

                    $('#query_data').submit();

                }
            }
        });
         function export_device(a){
             var form=$("#query_data").serialize();
             var url="<?php echo url('',array('is_export'=>1)); ?>?"+form;
             //console.log(url);
             window.open(url)
             /*$.get("",form,function (data) {
                console.log(data)
             },"json")*/
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