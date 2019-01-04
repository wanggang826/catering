<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:66:"D:\phpStudy\WWW\catering\public\theme\admin\order\orderdetail.html";i:1514873676;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
    <div class="panel" style="border-bottom: 1px solid #e7eaec">
        <p style="margin:5px;font-size: 14px;color: #1ab394;font-weight:bold">订单详情</p>
    </div>
    <form role="form" action="" class="form-inline panel-body">
        <div class="form-group">
            <p class="form-control" style="width:280px;">订单编号：<?php echo $order['order_sn']; ?></p>
        </div>
        <div class="form-group">
            <p class="form-control" style="width:280px;" >下单时间：<?php echo $order['create_time']; ?></p>
        </div>
        <div class="form-group">
            <p class="form-control" > 下单用户：<?php echo $order['member_id']; ?></p>
        </div>
        <div class="form-group">
            <p class="form-control" >  联系电话：<?php echo $order['tel']; ?></p>
        </div>
        <div class="form-group">
            <p class="form-control" >订单金额：<?php echo $order['order_price']; ?></p>
        </div>
    </form>
    <br>
</div>
<br>
<div class="panel panel-default">
    <div class="panel" style="border-bottom: 1px solid #e7eaec">
        <p style="margin:5px;font-size: 14px;color: #1ab394;font-weight:bold">商品详情</p>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th >商品编码</th>
                <th >商品名称</th>
                <th >数量</th>
                <th >计量单位</th>
                <th >价格</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($order['orderInfo']) || $order['orderInfo'] instanceof \think\Collection || $order['orderInfo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $order['orderInfo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><?php echo $vo['goods']['goods_sn']; ?></td>
                <td><?php echo $vo['goods']['goods_name']; ?></td>
                <td><?php echo $vo['goods_count']; ?></td>
                <td><?php echo $vo['goods']['goods_unit']; ?></td>
                <td><?php echo $vo['goods']['goods_price']; ?></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel" style="border-bottom: 1px solid #e7eaec">
        <p style="margin:5px;font-size: 14px;color: #1ab394;font-weight:bold">其他费用</p>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th >费用名称</th>
                <th >金额</th>
            </tr>
            </thead>
            <tbody>
            <?php if($order['type'] == 1): ?>
            <tr>
                <td width="50%">包装费</td>
                <td>+￥<?php echo $order['new_fee']; ?></td>
            </tr>
            <tr>
                <td width="50%">配送费</td>
                <td>+￥<?php echo $order['new_fee']; ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <td width="50%">新用户立减</td>
                <td>-￥<?php echo $order['new_fee']; ?></td>
            </tr>
            <tr>
                <td width="50%">满减优惠</td>
                <td>-￥<?php echo $order['over_fee']; ?></td>
            </tr>
            <tr>
                <td width="50%">优惠券</td>
                <td>-￥<?php echo $order['coupon']; ?></td>
            </tr>
            <tr>
                <td width="50%">折扣商品</td>
                <td>-￥<?php echo $order['discount']; ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
<br>
<a href="<?php echo url($url); ?>" class="btn btn-success" js-title="返回列表" js-unique="true">
    &nbsp;返回列表
</a>




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