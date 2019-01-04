<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"D:\www\alasika\public\theme\admin\custom_service\order.html";i:1503460468;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
    <form role="form" action="<?php echo url('CustomService/order'); ?>" method="post" class="panel-body hidden-xs form-inline">
         <div class="form-group group1">
           <input type="text" name="start_time" class="form-control i-datestart" id="date3" placeholder="创建时间" value="<?php echo input('start_time'); ?>">
        </div>
        <div class="form-group group2">
           <input type="text" name="end_time" class="form-control i-dateend" id="date3" placeholder="至今" value="<?php echo input('end_time'); ?>">
        </div>

        <div class="form-group">
            <select class=" form-control" name="payment" >
                <option value="">支付方式</option>
                <option value="1" <?php if(input('payment') == 1): ?> selected<?php endif; ?>>微信</option>
                <option value="2" <?php if(input('payment') == 2): ?> selected<?php endif; ?>>支付宝</option>
                <option value="3" <?php if(input('payment') == 3): ?> selected<?php endif; ?>>现金</option>
                <option value="4" <?php if(input('payment') == 4): ?> selected<?php endif; ?>>柜台poss卡支付</option>
                <option value="5" <?php if(input('payment') == 5): ?> selected<?php endif; ?>>会员支付</option>
            </select>
        </div>
		<div class="form-group">
            <select class=" form-control" name="status" >
                <option value="">退款状态</option>
                <option value="1" <?php if(input('status') == 1): ?> selected<?php endif; ?>>退款中</option>
                <option value="2" <?php if(input('status') == 2): ?> selected<?php endif; ?>>退款失败</option>
                <option value="3" <?php if(input('status') == 3): ?> selected<?php endif; ?>>退款成功</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" placeholder="交易号" id="ex1" class="form-control" name="trade_id" value="<?php echo input('trade_id'); ?>">
        </div>
        
       
        <div class="form-group pull-right">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary btn-outline btn-w-m btn-rec">
                    <i class="fa fa-search"></i><span class="btn-desc">&nbsp;查询</span>
                </button>
                <a href="<?php echo url(''); ?>" class="btn btn-default btn-outline btn-rec">
                    <i class="fa fa-refresh"></i><span class="btn-desc">&nbsp;重置</span>
                </a>
            </div>
        </div>
    </form>

    <div class="panel-footer clearfix ">
        <div class="btn-group pull-left hidden-xs">
            <a href="<?php echo url('CustomService/export'); ?>" class="btn btn-outline btn-default" text="">
                <i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;导出
            </a>
        </div>
        <div class="pull-right">
        <?php echo $lists->render(); ?>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered table-condensed">
    <thead>
        <tr>
        	<th width="50">操作</th>
            <th width="150" class="hidden-xs">交易号</th>
            <th width="150">商品名称</th>
            <th width="150" class="hidden-xs">编号</th>
            <th width="150" class="hidden-xs">交易时间</th>
            <th width="150" class="hidden-xs">交易方式</th>
            <th width="150" class="hidden-xs">交易金额/元</th>
            <th width="150" class="hidden-xs">单价/元</th>
            <th width="150" class="hidden-xs">数量</th>
            <th width="150" class="hidden-xs">成功数</th>
            <th width="150" class="hidden-xs">失败数</th>
            <th width="150" class="hidden-xs">货道号</th>
            <th width="150" class="hidden-xs">支付状态</th>
            <th width="150" class="hidden-xs">订单状态</th>
            <th width="150" class="hidden-xs">出货状态</th>
            <th width="150" class="hidden-xs">退款状态</th>
            <th width="150" class="hidden-xs">交易售货机</th>
            <th width="150" class="hidden-xs">所属点位</th>
            <th width="150" class="hidden-xs">所属分区</th>
            <th width="150" class="hidden-xs">所属路线</th>
            <th width="150" class="hidden-xs">售货机型号</th>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<tr>
			<td>
				<span class="btn-group">
                    <a href="<?php echo U('CustomService/output_status',['id'=>$vo['id'],'status'=>3]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="是否确定要退款?!">
                        <i class="fa fa-pencil fa-fw"></i><span class="hidden-xs">退款</span>
                    </a>

                    <!-- <a href="<?php echo url('del_servicer',['id'=>$vo['id']]); ?>" class="btn  btn-danger btn-outline btn-xs js-del-btn" text="删除后将无法恢复,请谨慎操作！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a> -->
                </span>
			</td>
			<td><?php echo $vo['trade_id']; ?></td>
			<td><?php echo $vo['goods_name']; ?></td>
			<td><?php echo $vo['order_id']; ?></td>
			<td><?php echo $vo['trade_time']; ?></td>
			<td><?php echo $vo['payment']; ?></td>
			<td><?php echo $vo['trade_money']; ?></td>
			<td><?php echo $vo['price']; ?></td>
			<td><?php echo $vo['num']; ?></td>
			<td><?php echo $vo['success_num']; ?></td>
			<td><?php echo $vo['error_num']; ?></td>
			<td><?php echo $vo['goods_number']; ?></td>
			<td><?php echo $vo['pay_status']; ?></td>
			<td><?php echo $vo['order_status']; ?></td>
			<td><?php echo $vo['output_status']; ?></td>
			<td><?php echo $vo['status_name']; ?></td>
			<td><?php echo $vo['device_code']; ?></td>
			<td><?php echo $vo['point_name']; ?></td>
			<td><?php echo $vo['partition_name']; ?></td>
			<td><?php echo $vo['line_name']; ?></td>
			<td><?php echo $vo['model_name']; ?></td>
		</tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
</div>
<script type="text/javascript">
function page_size(){
    $('.pagesize_form').submit();
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