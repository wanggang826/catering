<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\catering\public\theme\admin\waiting\takeoutOrder.html";i:1512547981;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
    <form role="form" action="<?php echo url('Waiting/takeoutOrder'); ?>" class="form-inline panel-body hidden-xs">
        <div class="form-group">
            订单号：<input type="text" placeholder="" id="order_sn" class="form-control" name="order_sn"
                       value="<?php echo input('order_sn'); ?>">
        </div>
        <div class="form-group">
            下单用户：<input type="text" placeholder="" id="member_id" class="form-control" name="member_id"
                        value="<?php echo input('member_id'); ?>">
        </div>
        <div class="form-group">
            联系电话：<input type="text" placeholder="" id="tel" class="form-control" name="tel"
                        value="<?php echo input('tel'); ?>">
        </div>
        <div class="form-group">

            <select name="status" onchange="this.form.submit();"  class="form-control" >
                <option value="">全部</option>
                <?php foreach($status as $k=>$v): ?>
                <option value="<?php echo $k; ?>" <?php if((input('status') != '') && (input('status') == $k)): ?> selected <?php endif; ?>><?php echo $v; ?></option>
                <?php endforeach; ?>
            </select>

        </div>
        <div class="form-group group1">
            <input type="text" class="form-control i-datestart laydate-icon" style="width: 150px; height: 34px;" name="start" id="start" placeholder="开始日期" onclick="laydate()" value="<?php echo input('start'); ?>">
        </div>
        <div class="form-group group2">
            <input type="text" class="form-control i-dateend laydate-icon" style="width: 150px; height: 34px;" name="end" id="end" placeholder="结束日期" onclick="laydate()" value="<?php echo input('end'); ?>">
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
        <?php if(input('status') == null): ?>
        <div class="pull-left btn-group hidden-xs" id="receive">
            <a href="<?php echo U('batchOperation'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="确定批量接单吗？">
                <i class="fa" aria-hidden="true"></i>&nbsp;批量接单
            </a>
        </div>

        <div class="pull-left btn-group hidden-xs" id="send">
            <a href="<?php echo U('batchOperation'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="确定批量接单吗？">
                <i class="fa" aria-hidden="true"></i>&nbsp;批量派送
            </a>
        </div>
        <?php elseif(input('status') == 1): ?>
        <div class="pull-left btn-group hidden-xs" >
            <a href="<?php echo U('batchOperation'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="确定批量接单吗？">
                <i class="fa" aria-hidden="true"></i>&nbsp;批量派送
            </a>
        </div>
        <?php else: ?>
        <div class="pull-left btn-group hidden-xs" >
            <a href="<?php echo U('batchOperation'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="确定批量接单吗？">
                <i class="fa" aria-hidden="true"></i>&nbsp;批量接单
            </a>
        </div>
        <?php endif; ?>
        <div class="pull-right">
            <?php echo $page; ?>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered table-condensed">
        <thead>
        <tr>
            <?php if(input('status') != null): ?>
            <th width='10'><input type="checkbox" class="my-all-check" name="input[]"></th>
            <?php else: ?>
            <th width='10'></th>
            <?php endif; ?>
            <th width="50">订单号</th>
            <th width="150">下单用户</th>
            <th width="150">联系电话</th>
            <th width="150">订单金额</th>
            <th width="150">下单时间</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td width='10'><input type="checkbox" value="<?php echo $vo['order_id']; ?>" id="checkOrder" class="i-checks" name="input[]"></td>
            <input type="hidden" value="<?php echo $vo['status']; ?>" id="status_<?php echo $vo['order_id']; ?>">
            <td><?php echo $vo['order_sn']; ?></td>
            <td><?php echo $vo['member_id']; ?></td>
            <td><?php echo $vo['tel']; ?></td>
            <td><?php echo $vo['order_price']; ?></td>
            <td><?php echo $vo['create_time']; ?></td>
            <td>
                <?php if($vo['status'] == 0): ?>
                <a href="<?php echo url('changeStatus',['table'=>'order', 'pk'=>'order_id', 'id'=>$vo['order_id'],'status'=>1, 'location'=>'takeoutOrder']); ?>" class="btn btn-default  btn-xs js-del-btn " js-title="接单" text="确定接单吗？"js-unique="true">
                    <span class="hidden-xs">接单</span>
                </a>
                <?php else: ?>
                <a href="<?php echo url('changeStatus',['table'=>'order', 'pk'=>'order_id', 'id'=>$vo['order_id'],'status'=>2, 'location'=>'takeoutOrder']); ?>" class="btn btn-default  btn-xs js-del-btn " js-title="派送" text="确定派送吗？"js-unique="true">
                    <span class="hidden-xs">派送</span>
                </a>
                <?php endif; ?>
                <a href="<?php echo url('orderDetail',['order_id'=>$vo['order_id'], 'location'=>'takeoutOrder']); ?>" class="btn btn-default  btn-xs"><span class="hidden-xs">查看</span></a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>


<script>
    var checkStatus = [];

    $('input[id="checkOrder"]').click(function () {
        if($('input[id="checkOrder"]').is(":checked") == true){
            var statusId = 'status_'+$(this).val();
            var status = $("input[id ="+statusId+"]").val();
            if(checkStatus.length == 0){
                checkStatus.push(status);
            }else if($.inArray(status, checkStatus) == -1){    //如果选择的是不一样的类型
                var msg = "待接单";
                if(status == 0){
                    msg = '待派送'
                }
                layer.alert("请统一选择"+msg+"的订单", {icon: 6});
                return false;
            }
            if(status == 0){
                $('#send').hide();
                $('#receive').show();
            }else if(status == 1){
                $('#receive').hide();
                $('#send').show();
            }
        }else{
            checkStatus = [];
            $('#receive').show();
            $('#send').show();
        }
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