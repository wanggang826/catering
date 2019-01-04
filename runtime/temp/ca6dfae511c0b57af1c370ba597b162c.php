<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"D:\phpStudy\WWW\catering\public\theme\admin\index\main.html";i:1514459249;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<div class="panel panel-default" style="margin-top: -2px;border: 0px; ">
	<div class="table-responsive" >
		<table class="table " style="border: 0">
            <tbody>
                <tr>
                <td colspan="2" align="center" style="border: 0px" height="100px"><div style="border: 2px solid #2F4F4F;height: 55%;width:75%;border-radius: 10px;padding-left:10px;margin-left: -25px;"><p style="float: left;height:80%;padding-top:2%;font-size:16px;"><i class="fa fa-fw fa-lg fa-user"></i><b>用户数</b></p><p style="float: right;height:80%;padding-top:2%;font-size:16px;padding-right: 10px;"><b><?php echo $member_count; ?></b></p></div></td>
                <td colspan="2" align="center" style="border: 0px" height="100px"><div style="border: 2px solid #2F4F4F;height: 55%;width:75%;border-radius: 10px;margin-left: -25px;"><p style="float: left;height:80%;padding-top:2%;font-size:16px;padding-left: 10px;"><i class="fa fa-fw fa-lg fa-industry"></i><b>今日订单笔数/金额</b></p><p style="float: right;height:80%;padding-top:2%;font-size:16px;padding-right: 10px;"><b><?php echo $order_count; ?>/<?php echo $total_price; ?></b></p></div></td>
                </tr>
                <tr >
                    <td align="center" style="border: 0px" height="100px">
                        <a href="<?php echo url('waiting/queuinglist'); ?>">
                        <div style="width: 220px;height: 160px;background-color: #2F4F4F;margin-top: 30px;margin-bottom:30px;border-radius: 10px;">
                            <p style="height: 40%;padding-top:10%;border-bottom: 1px solid #999999;color: #ffffff;font-size: 18px">排号列表</p>
                            <p style="height: 60%;padding-bottom:25%;color: #ffffff;font-size: 26px;font-weight:bold"><?php echo $queuing_count; ?></p>
                        </div>
                        </a>
                    </td>
                    <td align="center" style="border: 0px">
                        <a href="<?php echo url('waiting/eatinorder',array('type'=>0)); ?>">
                        <div style="width: 220px;height: 160px;background-color: #2F4F4F;border-radius: 10px;" >
                            <p style="height: 40%;padding-top:10%;border-bottom: 1px solid #999999;color: #ffffff;font-size: 18px">堂吃订单</p>
                            <p style="height: 60%;padding-bottom:25%;color: #ffffff;font-size: 26px;font-weight:bold"><?php echo $t_order_count; ?></p>
                        </div>
                        </a>
                    </td>
                    <td align="center" style="border: 0px">
                        <a href="<?php echo url('waiting/takeoutorder',array('type'=>1)); ?>">
                        <div style="width: 220px;height: 160px;background-color: #2F4F4F;border-radius: 10px;" >
                            <p style="height: 40%;padding-top:10%;border-bottom: 1px solid #999999;color: #ffffff;font-size: 18px">外卖订单</p>
                            <p style="height: 60%;padding-bottom:25%;color: #ffffff;font-size: 26px;font-weight:bold"><?php echo $w_order_count; ?></p>
                        </div>
                        </a>
                    </td>
                    <td align="center" style="border: 0px">
                        <a href="<?php echo url('reserve/index'); ?>">
                        <div style="width: 220px;height: 160px;background-color: #2F4F4F;border-radius: 10px;" >
                            <p style="height: 40%;padding-top:10%;border-bottom: 1px solid #999999;color: #ffffff;font-size: 18px">预定列表</p>
                            <p style="height: 60%;padding-bottom:25%;color: #ffffff;font-size: 26px;font-weight:bold"><?php echo $reserve_count; ?></p>
                        </div>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
	</div>
</div>
<div class="panel panel-default" style="margin-top: 40px;padding-bottom:40px ">
    <div class="panel" style="border-bottom: 1px solid #e7eaec;border-top: 1px solid #e7eaec">
        <p style="margin:10px;font-size: 14px;color: #1ab394;font-weight:bold">本月销售趋势图</p>
        <p class="pull-left" style="margin:10px;padding:10px;font-weight:bold;font-size: 14px;"><span style="padding-right:100px;">堂吃笔数/金额：<?php echo $mt_order_count; ?>/￥<?php echo $mt_order_price; ?></span><span>外卖笔数/金额：<?php echo $mw_order_count; ?>/￥<?php echo $mw_order_price; ?></span></p>
        <p class="pull-right" style="margin:10px;padding:10px;font-weight:bold;font-size: 14px;">日期：<?php echo $date; ?></p>
    </div>
    <div class="table-responsive" >
      
        <div style="height: 350px;margin-left:50px;margin-right:50px;margin-top:40px;margin-bottom: 30px;text-align: center;" id="image">
        </div>
    </div>
</div>
<script src="<?php echo $js; ?>/echarts.js"></script>
<script type="text/javascript">
//获取当前月天数
function mGetDate(){
     var date = new Date();
     var year = date.getFullYear();
     var month = date.getMonth()+1;
     var d = new Date(year, month, 0);
     return d.getDate();
}
$(function(){
    var aa = 1;
    $.ajax({
        url:"<?php echo url('Index/main'); ?>",
        data:{aa:aa},
        type:"post",
        dataType:"json",
        success:function(msg){
            console.log(msg);
            var datstr   = [];
            var daycount = mGetDate();
            for (var i = 1; i <= msg.arr_t.length; i++) {
                datstr[i-1] = i+"号";
            }
            var myChart = echarts.init(document.getElementById('image'));
            option = {
                title: {
                    text: '销售额统计图'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data:['外卖','堂吃']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: datstr
                },
                yAxis: {
                    name: '金额(元)',
                    type: 'value'
                },
                series: [
                    {
                        name:'外卖',
                        type:'line',
                        // smooth: true,
                        data:msg.arr_w
                    },
                    {
                        name:'堂吃',
                        type:'line',
                        // smooth: true,
                        data:msg.arr_t
                    }
                ]
            };
            myChart.setOption(option);
        },
        error:function(){
            console.log(22);
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