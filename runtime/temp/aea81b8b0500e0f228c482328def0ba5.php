<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\catering\public\theme\admin\goods\discountChoice.html";i:1513151022;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
    <form role="form" action="" class="form-inline panel-body hidden-xs">
        <div class="form-group">
            商品名称：
            <input type="text" class="form-control" name="goods_name" value="<?php echo input('goods_name'); ?>" placeholder="搜索...">
        </div>
        <div class="form-group pull-right">
            <div class="btn-group">
                <button class="btn btn-primary btn-outline btn-w-m btn-rec">
                    <i class="fa fa-search"></i><span class="btn-desc">&nbsp;查询</span>
                </button>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered table-condensed">
        <thead>
        <tr>
            <th width='10'></th>
            <th width="150">商品编码</th>
            <th width="150">商品名称</th>
            <th width="150">原价</th>
            <th width="150">计量单位</th>
            <th width="150">折扣</th>
            <th width="150">折扣价</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($goodsList) || $goodsList instanceof \think\Collection || $goodsList instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td width='10'><input type="checkbox" name="goods_id" value="<?php echo $vo['goods_id']; ?>"  class="i-checks"  /></td>
            <td><?php echo $vo['goods_sn']; ?></td>
            <td><?php echo $vo['goods_name']; ?></td>
            <td id="goods_price"><?php echo $vo['goods_price']; ?></td>
            <td><?php echo $vo['goods_unit']; ?></td>
            <td><input type="text" name="discount"></td>
            <td><input type="text" name="discount_price"  readonly></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<div class="btn-group">
    <button class="btn btn-primary " id="yes">
        <span class="btn-desc">&nbsp;提交</span>
    </button>
</div>


<script>
    $(function () {

        $('input[name="discount"]').click(function(){
            if($(this).parent().siblings().find("input[type=checkbox]").is(":checked")) {
                $(this).removeAttr("readonly");
            }else{
                $(this).attr("readonly", "false")
            }
        });

        $('input[name="discount"]').each(function () {
            $(this).blur(function(){
                if($(this).parent().siblings().find("input[name='goods_id']").is(':checked')){
                    var goods_price = $(this).parent().parent().find('#goods_price').text();
                    var discount = $(this).val();
                    if(discount ==""){
                        layer.alert("请设置折扣数字", {icon: 1});
                        $('#yes').css('cursor', 'not-allowed');
                        return false;
                    }else{
                        var reg = /^[1-9]{1}(\.{1}[1-9]{1})?$/;
                        if(reg.test(discount)){  //匹配成功则赋值
                            var real_price = (goods_price * discount /10).toFixed(2);
                            $(this).parent().parent().find('input[name="discount_price"]').val(real_price);
                            $('#yes').css('cursor', '');
                        }else{
                            layer.alert("请设置折扣为1到9的数", {icon: 1});
                            $('#yes').css('cursor', 'not-allowed');
                            return false;
                        }
                    }

                }

            });
        });

        var s = $("input[name='goods_id']");
        //input框的颜色鼠标手势设置不可点击和深色背景（点击了选中则切换为可输入和更换背景色）
        s.each(function(i) {
            var dis_input = $(this).parent().siblings().find("input[name='discount']");
            var price_input = $(this).parent().siblings().find("input[name='discount_price']");
            dis_input.css('background-color', '#EAEAEA');
            price_input.css('background-color', '#EAEAEA');

            dis_input.css('cursor', 'not-allowed');
            price_input.css('cursor', 'not-allowed');

            $(this).click(function () {
                if($(this).is(':checked')){
                    dis_input.css('background-color', '#FFFFFF');
                    dis_input.css('cursor', 'text');
                }else{
                    dis_input.val("");
                    price_input.val("");
                    dis_input.css('background-color', '#EAEAEA');
                    price_input.css('background-color', '#EAEAEA');
                    dis_input.css('cursor', 'not-allowed');
                    price_input.css('cursor', 'not-allowed');
                }
            })
        });

        var checkData = [];
        //提交按钮点击事件收集选中和填写的数据，ajax请求后台写入
        $("#yes").click(function () {
            s.each(function(i) {
                if($(this).is(':checked')){
                    var discount = $(this).parent().siblings().find("input[name='discount']").val();
                    if(discount == ""){
                        return
                    }

                }
            });

            if(checkData == ""){
                layer.alert("请添加折扣数据", {icon: 1});
                return
            }
            $.ajax({
                type: "post",
                url: "makeDiscount",
                data: {"checkData": checkData},
                dataType: "json",
                success: function (data) {
                    layer.alert(data.msg, {icon: 1});
                    function loc(){
                        window.location.reload()
                    }
                    setTimeout(loc,1000)
                }
            });
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