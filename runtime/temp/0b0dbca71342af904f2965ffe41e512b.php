<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:54:"D:\www\alasika\public\theme\admin\dictionary\edit.html";i:1502880105;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<form class="form-horizontal js-ajax-form clearfix" action='<?php echo url('edit'); ?>' method='post'>
<input type="hidden" name="id" class="form-control" id="id"  value="<?php echo $partition['id']; ?>">
<div class="form-group">
    <label for="di_encoding" class="col-sm-2 control-label">编码</label>
    <div class="col-sm-4">
        <input type="text" name="di_encoding" class="form-control" id="di_encoding" value="<?php echo $partition['di_encoding']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="di_name" class="col-sm-2 control-label">名称</label>
    <div class="col-sm-4">
        <input type="text" name="di_name" class="form-control" id="di_name"  value="<?php echo $partition['di_name']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="di_order" class="col-sm-2 control-label">显示顺序</label>
    <div class="col-sm-4">
        <input type="text" name="di_order" class="form-control" id="di_order"  value="<?php echo $partition['di_order']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="describe" class="col-sm-2 control-label">描述</label>
    <div class="col-sm-9">
        <textarea class="form-control" id="describe" name="describe" ><?php echo $partition['describe']; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="describe" class="col-sm-2 control-label">选项值</label>
    <div class="col-sm-9">
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th width="50"></th>
                <th width="50"></th>
                <th width="50"></th>
                <th width="150">编号</th>
                <th width="150">选项值</th>
            </tr>
            </thead>
            <tbody class="tbody">
            <?php if(is_array($partition['option_value']) || $partition['option_value'] instanceof \think\Collection || $partition['option_value'] instanceof \think\Paginator): if( count($partition['option_value'])==0 ) : echo "" ;else: foreach($partition['option_value'] as $k=>$ov): ?>
            <tr>
                <td>1</td>
                <td><a href="#" class="btn btn-danger btn-outline btn-xs" onclick="update.call(this)"><span class="hidden-xs">删除</span></a></td>
                <td><a href="#" class="btn btn-danger btn-outline btn-xs" onclick="add.call(this)"><span class="hidden-xs">添加</span></a></td>
                <td><input type="text" class="form-control" name="bian_hao[]" style="border: none" value="<?php echo $k; ?>"></td>
                <td><input type="text" class="form-control" name="xuan_xian[]" style="border: none" value="<?php echo $ov; ?>"></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
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
    //修改选项值的提交值名称
    var le = $(".tbody").children().length;
    for(var i=0;i<le;i++){
        var name = "bian_hao["+i+"]";
        var names = "xuan_xian["+i+"]";
        $('.tbody').find("tr").eq(i).find("td").eq(3).find("input").attr('name',name);
        $('.tbody').find("tr").eq(i).find("td").eq(4).find("input").attr('name',names);
    }

    for(var i=0;i < le;i++){
        var s = i+1;
        $('.tbody').find("tr").eq(i).find("td").eq(0).html(s);
    }
    var text = "<tr>\n" +
        "                    <td>1</td>\n" +
        "                    <td><a href=\"#\" class=\"btn btn-danger btn-outline btn-xs\" onclick=\"update.call(this)\"><span class=\"hidden-xs\">删除</span></a></td>\n" +
        "                    <td><a href=\"#\" class=\"btn btn-danger btn-outline btn-xs\" onclick=\"add.call(this)\"><span class=\"hidden-xs\">添加</span></a></td>\n" +
        "                    <td><input type=\"text\" class=\"form-control\" name=\"bian_hao[]\" style=\"border: none\"></td>\n" +
        "                    <td><input type=\"text\" class=\"form-control\" name=\"xuan_xian[]\" style=\"border: none\" ></td>\n" +
        "                </tr>";

    //删除选项值
    function update() {
        var ids = $(this).parents("tbody").children().length;
        if(ids > 1){
            $(this).parents("tr").remove();
        }
    }
    //动态添加选项值
    function add() {
        var ids = $(this).parents("tbody").children().length;
        var id = ids + 1;
        var name = "bian_hao["+ids+"]";
        var names = "xuan_xian["+ids+"]";
        $('.tbody').append(text);
        $('.tbody').find("tr").eq(ids).find("td").eq(0).html(id);
        $('.tbody').find("tr").eq(ids).find("td").eq(3).find("input").attr('name',name);
        $('.tbody').find("tr").eq(ids).find("td").eq(4).find("input").attr('name',names);
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