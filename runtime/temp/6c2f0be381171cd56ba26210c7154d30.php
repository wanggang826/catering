<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:50:"D:\www\alasika\public\theme\admin\goods\index.html";i:1503460468;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
    <div class="panel-heading hidden-xs">条件搜索</div>
    <form role="form" action="<?php echo url('Goods/index'); ?>" class="form-inline panel-body hidden-xs">
        <div class="form-group">
            <input type="text" placeholder="编号/名称" id="goods_name" class="form-control" name="goods_name" value="<?php echo input('goods_name'); ?>">
        </div>

        <div class="form-group">
            <label for="status" class="sr-only">状态</label>
            <select id="status" class="form-control"  name="status" onchange="this.form.submit()">
                <option value="">状态</option>
                <option value="1" <?php if(input('status') == 1): ?> selected="selected" <?php endif; ?>>启用</option>
                <option value="2" <?php if(input('status') == 2): ?> selected="selected" <?php endif; ?>>禁用</option>
            </select>
        </div>
        <div class="form-group">
            <select id="cate_id" class="form-control" style="width: 170px" name="cate_id">
                <option value="">请选择分类</option>
                <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['cate_id']; ?>" <?php if(input('cate_id') == $vo['cate_id']): ?> selected<?php endif; ?>><?php echo $vo['cate_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <div class="form-group pull-right">
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
    <div class="panel-footer clearfix ">
        <div class="pull-left btn-group hidden-xs" >
            <a href="<?php echo url('goods/add_goods'); ?>" class="btn btn-default js-window-load" js-title="新增商品" js-unique="true">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
            </a>
            <a href="<?php echo U('del_goods'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="删除后将无法恢复，请谨慎操作">
                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;批量删除
            </a>
        </div>
        <a href="<?php echo url('export_goods'); ?>" class="btn btn-outline btn-default" text="确定导出？">
            <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;导出
        </a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered table-condensed">
        <thead>
        <tr>
            <th width='1'><input type="checkbox" class="my-all-check" name="input[]"></th>
            <th width="50">ID</th>
            <th width="150">操作</th>
            <th width="150">商品编码</th>
            <th width="150">商品名称</th>
            <th width="100">商品简称</th>
            <th width="100">商品分类</th>
            <th width="100">图片</th>
            <th width="80">建议售价</th>
            <th width="100">规格</th>
            <th width="100">净含量</th>
            <th width="100">描述</th>
            <th width="50">状态</th>
            <th width="100">备注</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td width='1'><input type="checkbox" value="<?php echo $vo['goods_id']; ?>" class="i-checks" name="input[]"></td>
            <td><?php echo $vo['goods_id']; ?></td>
            <td >
                <span class="btn-group">
                    <a href="<?php echo url('edit_goods',['goods_id'=>$vo['goods_id'],'page'=>$nowpage]); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="编辑"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">编辑</span></a>
                    <?php if($vo['status'] == 1): ?>
                    <a href="<?php echo url('change_status',['goods_id'=>$vo['goods_id'],'status'=>2]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="禁用后该点位将无法展示"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">禁用</span></a>
                    <?php elseif($vo['status'] == 2): ?>
                    <a href="<?php echo url('change_status',['goods_id'=>$vo['goods_id'],'status'=>1]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="启用后该点位可以正常展示 "><i class="fa fa-check fa-fw"></i><span class="hidden-xs">启用</span></a>
                    <?php endif; ?>
                    <a href="<?php echo url('del_goods',['goods_id'=>$vo['goods_id']]); ?>" class="btn  btn-danger btn-outline btn-xs js-del-btn" text="删除后将无法恢复,请谨慎操作！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a>
                </span>
            </td>
            <td><?php echo $vo['goods_code']; ?></td>
            <td><?php echo $vo['goods_name']; ?></td>
            <td><?php echo $vo['goods_spell']; ?></td>
            <td><?php echo $vo['cate_name']; ?></td>
            <td><?php if($vo['images']): ?>预览<img class="hover_img" src="<?php echo $vo['images']; ?>"><?php endif; ?></td>
            <td><?php echo $vo['sale_price']; ?></td>
            <td><?php echo $vo['unit']; ?></td>
            <td><?php echo $vo['net_quantity']; ?></td>
            <td><?php echo $vo['description']; ?></td>
            <td><?php echo text_status($vo['status']); ?></td>
            <td><?php echo $vo['remark']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>

<div class="pages">
    <div class="plist" ><?php echo $page; ?></div>
</div>


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