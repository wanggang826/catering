<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:48:"D:\www\alasika\public\theme\admin\Point\add.html";i:1503473518;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
    #allmap {width:100%;height:500px;}
    .define_select{
        border: 1px solid #e5e6e7;
        padding: 6px 6px;
        font-size:14px;
        cursor: pointer;
    }
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=RHbjk3GObLnlkQhftRZHuyCHG3xZkca6"></script>
<form class="form-horizontal js-ajax-form clearfix" action='<?php echo url('add_point'); ?>' method='post'>

<!-- 自定义大小 -->
<div class="form-group">
    <label for="point_name" class="col-sm-2 control-label">点位名称</label>
    <div class="col-sm-4">
        <input type="text" name="point_name" class="form-control" id="point_name" placeholder="分区名称">
    </div>
</div>
<div class="form-group">
    <label for="point_code" class="col-sm-2 control-label">点位编号</label>
    <div class="col-sm-4">
        <input type="text" name="point_code" class="form-control" id="point_code" placeholder="点位编号">
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">状态</label>
    <div class="col-sm-4">
        <label class="i-lab"><input type="radio" name="status" value='1' class="mgr mgr-primary" checked><span>启用</span></label>
        <label class="i-lab"><input type="radio" name="status" value='2' class="mgr mgr-primary" ><span>禁用</span></label>
    </div>
</div>
<div class="form-group">
    <label for="provinces" class="col-sm-2 control-label">省份</label>
    <div class="col-sm-4">
    <select id="provinces" class="form-control" name="province_id">
        <option value="" >请选择省份</option>
        <?php if(is_array($provinces) || $provinces instanceof \think\Collection || $provinces instanceof \think\Paginator): $i = 0; $__LIST__ = $provinces;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <option value="<?php echo $vo['area_id']; ?>"><?php echo $vo['area_name']; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </div>
</div>
<div class="form-group">
    <label for="cities" class="col-sm-2 control-label">城市</label>
    <div class="col-sm-4">
    <select id="cities" class="form-control" name="city_id">
        <option value="">请选择城市</option>
        <?php if(is_array($cities) || $cities instanceof \think\Collection || $cities instanceof \think\Paginator): $i = 0; $__LIST__ = $cities;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <option value="<?php echo $vo['area_id']; ?>"><?php echo $vo['area_name']; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </div>
</div>
<div class="form-group">
    <label for="counties" class="col-sm-2 control-label">县区</label>
    <div class="col-sm-4">
    <select id="counties" class="form-control" name="county_id">
        <option value="">请选择县区</option>
        <?php if(is_array($counties) || $counties instanceof \think\Collection || $counties instanceof \think\Paginator): $i = 0; $__LIST__ = $counties;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <option value="<?php echo $vo['area_id']; ?>"><?php echo $vo['area_name']; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
    </div>
</div>
<div class="form-group">
    <label for="partitions" class="col-sm-2 control-label">分区</label>
    <div class="col-sm-4">
        <select id="partitions" class="define_select" name="partition_id">
            <option value="" >请选择分区</option>
            <?php if(is_array($partitions) || $partitions instanceof \think\Collection || $partitions instanceof \think\Paginator): $i = 0; $__LIST__ = $partitions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['partition_id']; ?>"><?php echo $vo['partition_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="lines" class="col-sm-2 control-label">线路</label>
    <div class="col-sm-4">
        <select id="lines" class="define_select" name="line_id">
            <option value="" >请选择线路</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="location" class="col-sm-2 control-label">摆放位置</label>
    <div class="col-sm-4">
        <input type="text" name="location" class="form-control" id="location" placeholder="摆放位置">
    </div>
</div>

<div class="form-group">
    <label for="machine_code" class="col-sm-2 control-label">咖啡机编号</label>
    <div class="col-sm-4">
        <input type="text" name="machine_code" class="form-control" id="machine_code" placeholder="咖啡机编号">
    </div>
</div>
<div class="form-group">
    <label for="address" class="col-sm-2 control-label">详细地址</label>
    <div class="col-sm-4">
        <input type="text" name="address" id="address" class="form-control" id="address" placeholder="详细地址">
    </div>
</div>
<div class="form-group">
    <label for="longitude" class="col-sm-2 control-label">经度</label>
    <div class="col-sm-4">
        <input type="text" name="longitude" class="form-control" id="longitude" placeholder="经度">
    </div>
</div>
<div class="form-group">
    <label for="latitude" class="col-sm-2 control-label">纬度</label>
    <div class="col-sm-4">
        <input type="text" name="latitude" class="form-control" id="latitude" placeholder="纬度">
    </div>
</div>
<div class="form-group">
    <label for="remark" class="col-sm-2 control-label">备注</label>
    <div class="col-sm-4">
        <textarea type="text" name="remark" class="form-control" id="remark" placeholder="汉字50以内，英文或数字100以内。"></textarea>
    </div>
</div>

<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button>
        <button type="reset" class="btn btn-info">重置</button>
    </div>
</div>
</form>
<div id="allmap"></div>
<script type="text/javascript">
        //省市县区分区四级联动
        $("#provinces").change(function() {
            //  加载所有的市
            $.ajax({
                type: "get",
                url: "get_areas",
                data: {"parent_id": $(this).val(), "area_type": "2"},  // area_type=3表示查询市
                dataType: "json",
                success: function (data) {
                    $("#cities").html("<option value=''>请选择城市</option>");
                    $("#counties").html("<option value=''>请选择县区</option>");
                    $.each(data, function (i, item) {
                        $("#cities").append("<option value='" + item.area_id + "'>" + item.area_name + "</option>");
                    });
                }
            });
        });

    $("#cities").change(function() {
        //  加载所有的县区
        $.ajax({
            type: "get",
            url: "get_areas",
            data: {"parent_id": $(this).val(), "area_type": "3"},   // area_type=3表示查询县区
            dataType: "json",
            success: function (data) {
                $("#counties").html("<option value=''>请选择县区</option>");
                $.each(data, function (i, item) {
                    $("#counties").append("<option value='" + item.area_id + "'>" + item.area_name + "</option>");
                });
            }
        });
    });


    //分区加载线路
    $("#partitions").change(function() {
        //  加载所有的县区
        $.ajax({
            type: "get",
            url: "get_lines",
            data: {"partition_id": $(this).val()},   // area_type=3表示查询县区
            dataType: "json",
            success: function (data) {
                $("#lines").html("<option value=''>请选择线路</option>");
                $.each(data, function (i, item) {
                    $("#lines").append("<option value='" + item.line_id + "'>" + item.line_name + "</option>");
                });
            }
        });
    });


$(function () {
    // 百度地图API功能
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(114.0361976624,22.5385616321);
    map.centerAndZoom(point,12);
    map.enableScrollWheelZoom(true);
    var geoc = new BMap.Geocoder();

    map.addEventListener("click", function(e){
        var pt = e.point;
        map.clearOverlays();
        map.addOverlay(new BMap.Marker(pt));
        $('#longitude').val(pt.lng);
        $('#latitude').val(pt.lat);
        geoc.getLocation(pt, function(rs){
            var addComp = rs.addressComponents;
            $('#address').val(addComp.province+addComp.city+addComp.district+addComp.street);
            $('#pro_txt').val(addComp.province);
            $('#city_txt').val(addComp.city);
            $('#county_txt').val(addComp.district);
        });
    });
    $("#address").focusout(function () {
        var address=$(this).val();
        if(address!=''){
            // 百度地图API功能
            // 创建地址解析器实例
            var myGeo = new BMap.Geocoder();
            // 将地址解析结果显示在地图上,并调整地图视野

            myGeo.getPoint(address, function(point){
                if (point) {
                    map.centerAndZoom(point, 16);
                    map.addOverlay(new BMap.Marker(point));
                    $('#longitude').val(point.lng);
                    $('#latitude').val(point.lat);
                }else{
                    layer.alert("您选择地址没有解析到结果!");
                }
            }, address);
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