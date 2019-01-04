<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:66:"D:\phpStudy\WWW\catering\public\theme\admin\config\dining_set.html";i:1513678214;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<script src="<?php echo $static_path; ?>/js/uploadImg.js"></script>
<form class="form-horizontal js-ajax-form clearfix" action="<?php echo U('dining_set'); ?>" method='post'>
<!-- 自定义大小 -->
    <div class="col-sm-12 row">
        <div class="form-group" style="margin:80px auto;">
            <h1 for="user_sn" class="text-center ">餐厅信息</h1>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="user_sn" class="col-sm-4 control-label">餐厅名称</label>
                    <div class="col-sm-5">
                        <input type="text" name="dining_name" class="form-control" id="user_sn" value="<?php echo isset($data) ? $data['dining_name'] : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nickname" class="col-sm-4 control-label">联系方式</label>
                    <div class="col-sm-5">
                        <input type="text" name="phone" class="form-control" id="nickname" value="<?php echo isset($data) ? $data['phone'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="business_hours" class="col-sm-4 control-label">服务时间</label>
                    <div class="col-sm-5">
                        <input type="text" name="business_hours" class="form-control" id="business_hours" value="<?php echo isset($data) ? $data['business_hours'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="room_min" class="col-xs-4 control-label">包间人数</label>
                    <div class="col-xs-5" style="width:60%;">
                        <ul class="list-inline">
                            <li><input type="text" name="room_min" width="20px" placeholder="包间最小人数" class="form-control" id="room_min" value="<?php echo isset($room_info['room_min']) ? $room_info['room_min'] : ''; ?>"></li>
                            <li>--</li>
                            <li><input type="text" name="room_max" width="20px" placeholder="包间最大人数"  class="form-control" id="room_max" value="<?php echo isset($room_info['room_max']) ? $room_info['room_max'] : ''; ?>"></li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <label for="business_hours" class="col-sm-4 control-label">最多提前预定天数</label>
                    <div class="col-sm-5">
                        <input type="number" name="max_days" class="form-control" id="max_days" value="<?php echo isset($max_day) ? $max_day: ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_max" class="col-sm-4 control-label">预定时间开始时间</label>
                    <div class="col-sm-5">
                        <ul class="list-inline">
                            <li>
                                <select class=" form-control" name="begin_hour" id="begin_hour" >
                                    <?php $__FOR_START_20533__=1;$__FOR_END_20533__=25;for($i=$__FOR_START_20533__;$i < $__FOR_END_20533__;$i+=1){ ?>
                                        <option value="<?php echo $i; ?>"<?php if($time_info['begin_hour'] == $i): ?>selected<?php endif; ?>><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <select class=" form-control" name="begin_min" >
                                    <option value="30" <?php if($time_info['begin_min'] == '30'): ?>selected<?php endif; ?>>30</option>
                                    <option value="0" <?php if($time_info['begin_min'] == '00'): ?>selected<?php endif; ?>>00</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <label for="room_max" class="col-sm-4 control-label">预定时间结束时间</label>
                    <div class="col-sm-5">
                        <ul class="list-inline">
                            <li>
                                <select class=" form-control" name="end_hour" id="end_hour" >
                                    <?php $__FOR_START_8675__=1;$__FOR_END_8675__=25;for($i=$__FOR_START_8675__;$i < $__FOR_END_8675__;$i+=1){ ?>
                                    <option value="<?php echo $i; ?>" <?php if($time_info['end_hour'] == $i): ?>selected<?php endif; ?>><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <select class=" form-control" name="end_min" >
                                    <option value="30" <?php if($time_info['end_min'] == '30'): ?>selected<?php endif; ?>>30</option>
                                    <option value="0" <?php if($time_info['end_min'] == '00'): ?>selected<?php endif; ?>>00</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-2 control-label">餐厅图片</label>
                    <div class="img_cont">
                        <div class="img_prev" id="img_prev" <?php if(isset($data['image'])): ?>style="display: none"<?php endif; ?>></div>
                        <input type="file" name="image" id="image"  value=""/>
                        <?php if(isset($data['image'])): ?>
                            <img src="__UPLOAD__<?php echo $data['image']; ?>" id="img-before" title="移除并修改">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">详细地址</label>
            <div class="col-sm-8">
                <textarea name="address"  placeholder="备注长度不可大于240个字符" class="form-control"><?php echo isset($data['address']) ? $data['address'] : ''; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">餐厅介绍</label>
            <div class="col-sm-8">
                <textarea name="dining_desc"  placeholder="备注长度不可大于240个字符" class="form-control"><?php echo isset($data['address']) ? $data['address'] : ''; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button>

            </div>
        </div>
    </div>

</form>

<script type="text/javascript">
    $(function(){
        //新增banner
        $('#image').imgUpload({
            width:375,//预览宽度
            height:188,//预览高度
            maxSize: 500,//允许上传最大值(KB)
            imgWidth:375,//图片上传宽度
            imgHeight:188,//图片上传高度
            allowedNum:1,//允许上传最大数量
            files:{
                1:'{getImg}',
            }
        })

        $('#img-before').on('click',function(){
//            console.log('ok');
            $('#img_prev').show();
            $(this).hide();
        })

        $('#room_max').on('blur',function(){
            var min = $('#room_min').val();
            var max = $(this).val();
            if(parseInt(min) > parseInt(max)){
                layer.msg('预定最小人数大于最大人数')
            }
        })

        $('#end_hour').on('change',function(){
            var begin_val = $('#begin_hour').val();
            var end_val = $(this).val();
            if(parseInt(end_val) < parseInt(begin_val)){
                layer.msg('预定结束时间大于开始时间')
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