<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\catering\public\theme\admin\opinion\opinion_type.html";i:1512987785;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<form class="form-horizontal js-ajax-form clearfix" action="<?php echo U('opinion_type'); ?>" method='post'>
<!-- 自定义大小 -->
    <div class="form-group">
        <h1 for="user_sn" class="text-center ">意见反馈类型维护</h1>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>反馈类型名称</th>
            <th></th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($types)): if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td class="cl-id"><?php echo $vo['id']; ?></td>
                <td scope="row">
                    <input type="hidden" name="id[<?php echo $vo['id']; ?>]" value="<?php echo $vo['id']; ?>">
                    <input type="text" name="name[<?php echo $vo['id']; ?>]" class="form-control" value="<?php echo $vo['name']; ?>">
                </td>
                <td></td>
                <td>
                    <span class="btn-group">
                        <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs add-btn " title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>
                        <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  del-btn" title="最少设置一个"><i class="fa fa-edit fa-fw" disabled="disabled"></i><span class="hidden-xs" disabled="disabled">移除</span></a>
                    </span>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; else: ?>
        <tr>
            <td class="cl-id">1</td>
            <td scope="row">
                <input type="hidden" name="id[1]" value="1">
                <input type="text" name="name[1]" class="form-control" value="">
            </td>
            <td></td>
            <td>
                    <span class="btn-group">
                        <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs add-btn " title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>
                        <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  del-btn" title="最少设置一个"><i class="fa fa-edit fa-fw" disabled="disabled"></i><span class="hidden-xs" disabled="disabled">移除</span></a>
                    </span>
            </td>
        </tr>
        <?php endif; ?>

        </tbody>
    </table>

    <div class="form-group">
        <label class="col-sm-4 control-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button>
        </div>
    </div>
</form>
<script>
    $(function(){
        var num = $('table .cl-id:last').text();
        num = parseInt(num) + 1;
        //添加
        $('table').on('click','.add-btn',function(){
            var tr = '';
            tr += '<tr>'+
                '<td class="cl-id">'+num+'</td>'+
                '<td scope="row">'+
                '<input type="hidden" name="id['+num+']" value="'+num+'">'+
                '<input type="text" name="name['+num+']" class="form-control" value="">'+
                '</td>'+
                '<td></td>'+
                '<td>'+
                '<span class="btn-group">'+
                '<a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  add-btn" title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>'+
                '<a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs del-btn" title="移除"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">移除</span></a>'+
                '</span>'+
                '</td>'+
                '</tr>';
            num ++;

            $('tbody').append(tr);
        })
        //删除
        $('table').on('click','.del-btn',function(){
            var _this = $(this);
            var len = $('table tr').length;

            if(len == 2){
                layer.msg('已经是最后一个了！！');
            }else{
                _this.closest('tr').detach();
            }

        })


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