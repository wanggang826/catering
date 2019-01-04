<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\phpStudy\WWW\catering\public\theme\admin\discounts_set\edit.html";i:1513576705;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\layout.html";i:1502172025;s:62:"D:\phpStudy\WWW\catering\public\theme\admin\layout\static.html";i:1503460468;s:58:"D:\phpStudy\WWW\catering\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<form class="form-horizontal js-ajax-form clearfix" action="<?php echo U('edit'); ?>" method='post'>
    <div style="border: 1px solid #a1a7ad;margin:20px 0">
        <h3 class="col-xs-12 control-label"><span class="pull-left">优惠买单金额设置</span></h3>
        <style>
            *{padding:0;margin:0;}
            .comment{font-size:14px;color:teal;}
            .comment li{float:left;}
            ul{list-style:none;}
        </style>

        <div>
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-12">
                <?php if(isset($base_config)): ?>
                <label class="i-lab">
                    <input type="radio" name="discount_enable" value="Y" class="mgr mgr-primary  mgr-lg" <?php if($base_config == 'Y'): ?>checkec<?php endif; ?>><span>允许优惠买单</span>
                </label>
                <label class="i-lab">
                    <input type="radio" name="discount_enable" value="N" checked class="mgr mgr-primary mgr-lg" <?php if($base_config == 'N'): ?>checkec<?php endif; ?> ><span>不允许优惠买单</span>
                </label>
                <?php else: ?>
                <label class="i-lab">
                    <input type="radio" name="discount_enable" value="Y" class="mgr mgr-primary  mgr-lg" checked><span>允许优惠买单</span>
                </label>
                <label class="i-lab">
                    <input type="radio" name="discount_enable" value="N" checked class="mgr mgr-primary mgr-lg" ><span>不允许优惠买单</span>
                </label>
                <?php endif; ?>

            </div>
        </div>

        <div class="row" >
            <div class="col-xs-12">
                <!--<label class="col-xs-2 control-label"></label>-->
                <div class="col-xs-11">
                    <table class="table" id="table1">
                        <thead>
                        <tr>
                            <th class="text-center">超过金额</th>
                            <th class="text-center">优惠金额</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if(count($discount_type1)>0): if(is_array($discount_type1) || $discount_type1 instanceof \think\Collection || $discount_type1 instanceof \think\Paginator): $i = 0; $__LIST__ = $discount_type1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td class="cl-id">
                                <input type="hidden" name="id[0][<?php echo $vo['id']; ?>]" class="form-control" value="<?php echo $vo['id']; ?>">
                                <input type="text" name="over_money[0][<?php echo $vo['id']; ?>]" class="form-control" value="<?php echo $vo['over_money']; ?>">
                            </td>
                            <td>
                                <input type="text" name="discount_money[0][<?php echo $vo['id']; ?>]" class="form-control" value="<?php echo $vo['discount_money']; ?>">
                            </td>
                            <td class="text-center">
                            <span class="btn-group">
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs add-btn " title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  del-btn" title="最少设置一个"><i class="fa fa-edit fa-fw" disabled="disabled"></i><span class="hidden-xs" disabled="disabled">移除</span></a>
                            </span>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                        <tr>
                            <td class="cl-id">
                                <input type="hidden" name="id[0][1]" class="form-control" value="">
                                <input type="text" name="over_money[0][1]" class="form-control" value="">
                            </td>
                            <td>
                                <input type="text" name="discount_money[0][1]" class="form-control" value="">
                            </td>
                            <td class="text-center">
                            <span class="btn-group">
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs add-btn " title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  del-btn" title="最少设置一个"><i class="fa fa-edit fa-fw" disabled="disabled"></i><span class="hidden-xs" disabled="disabled">移除</span></a>
                            </span>
                            </td>
                        </tr>

                        <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div style="border: 1px solid #a1a7ad;margin:20px 0">
        <h3 class="col-xs-12 control-label"><span class="pull-left">满减优惠设置</span></h3>

        <div class="row">
            <div class="col-xs-12">
                <!--<label class="col-xs-2 control-label"></label>-->
                <div class="col-xs-11">
                    <table class="table" id="table2">
                        <thead>
                        <tr>
                            <th class="text-center">超过金额</th>
                            <th class="text-center">优惠金额</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if(count($discount_type2)>0): if(is_array($discount_type2) || $discount_type2 instanceof \think\Collection || $discount_type2 instanceof \think\Paginator): $i = 0; $__LIST__ = $discount_type2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td class="cl-id">
                                <input type="hidden" name="id[1][<?php echo $vo['id']; ?>]" class="form-control" value="<?php echo $vo['id']; ?>">
                                <input type="text" name="over_money[1][<?php echo $vo['id']; ?>]" class="form-control" value="<?php echo $vo['over_money']; ?>">
                            </td>
                            <td>
                                <input type="text" name="discount_money[1][<?php echo $vo['id']; ?>]" class="form-control" value="<?php echo $vo['discount_money']; ?>">
                            </td>
                            <td class="text-center">
                            <span class="btn-group">
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs add-btn " title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  del-btn" title="最少设置一个"><i class="fa fa-edit fa-fw" disabled="disabled"></i><span class="hidden-xs" disabled="disabled">移除</span></a>
                            </span>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; else: ?>
                        <tr>
                            <td class="cl-id">
                                <input type="hidden" name="id[1][1]" class="form-control" value="">
                                <input type="text" name="over_money[1][1]" class="form-control" value="">
                            </td>
                            <td>
                                <input type="text" name="discount_money[1][1]" class="form-control" value="">
                            </td>
                            <td class="text-center">
                            <span class="btn-group">
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs add-btn " title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  del-btn" title="最少设置一个"><i class="fa fa-edit fa-fw" disabled="disabled"></i><span class="hidden-xs" disabled="disabled">移除</span></a>
                            </span>
                            </td>
                        </tr>
                        <?php endif; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div style="border: 1px solid #a1a7ad;margin:20px 0">
    <h3 class="col-xs-12 control-label"><span class="pull-left">其他费用设置</span></h3>

    <div class="form-group">
        <label for="delivery_fee" class="col-xs-2 control-label">外卖配送费</label>
        <div class="col-xs-4">
            <input type="text" name="delivery_fee" value="<?php echo isset($base_config) ? $base_config[1] : ''; ?>" class="form-control" id="delivery_fee">
        </div>
    </div>
    <div class="form-group">
        <label for="pack_fee" class="col-xs-2 control-label">外卖包装费</label>
        <div class="col-xs-4">
            <input type="text" name="pack_fee" value="<?php echo isset($base_config) ? $base_config[2] : ''; ?>" class="form-control" id="pack_fee">
        </div>
    </div>
    <div class="form-group">
        <label for="new_off" class="col-xs-2 control-label">新用户下单首次优惠</label>
        <div class="col-xs-4">
            <input type="text" name="new_off" value="<?php echo isset($base_config) ? $base_config[3] : ''; ?>" class="form-control" id="new_off">
        </div>
    </div>

    </div>

    <div style="border: 1px solid #a1a7ad;margin:20px 0">
        <h3 class="col-xs-12 control-label"><span class="pull-left">评论登记设置</span></h3>

        <div class="form-group row" id="comment_start">
            <div class="col-xs-4 row">
                <label for="new_off" class="col-xs-3 control-label">好评</label>
                <input type="hidden" name="good_comment" value="<?php echo $comment_star['good_comment']; ?>">
                <div class="col-xs-6" style="margin-top: 4px;">
                    <ul class="comment">
                        <?php $__FOR_START_7605__=1;$__FOR_END_7605__=$comment_star['good_comment'] + 1;for($i=$__FOR_START_7605__;$i < $__FOR_END_7605__;$i+=1){ ?>
                        <li <?php if($i == $comment_star['good_comment']): ?>class="active"<?php endif; ?> >★</li>
                        <?php } $__FOR_START_32406__=1;$__FOR_END_32406__=6 - intval($comment_star['good_comment']);for($i=$__FOR_START_32406__;$i < $__FOR_END_32406__;$i+=1){ ?>
                        <li>☆</li>
                        <?php } ?>
                    </ul>


                </div>
            </div>
            <div class="col-xs-4 row">
                <label for="new_off" class="col-xs-3 control-label">中评</label>
                <input type="hidden" name="mid_comment" value="<?php echo $comment_star['mid_comment']; ?>">
                <div class="col-xs-6" style="margin-top: 4px;">
                    <ul class="comment">
                        <?php $__FOR_START_15315__=1;$__FOR_END_15315__=$comment_star['mid_comment'] + 1;for($i=$__FOR_START_15315__;$i < $__FOR_END_15315__;$i+=1){ ?>
                        <li <?php if($i == $comment_star['mid_comment']): ?>class="active"<?php endif; ?> >★</li>
                        <?php } $__FOR_START_6732__=1;$__FOR_END_6732__=6 - intval($comment_star['mid_comment']);for($i=$__FOR_START_6732__;$i < $__FOR_END_6732__;$i+=1){ ?>
                        <li>☆</li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-xs-4 row">


                <label for="new_off" class="col-xs-3 control-label">差评</label>
                <input type="hidden" name="bad_comment" value="<?php echo $comment_star['bad_comment']; ?>">
                <div class="col-xs-6" style="margin-top: 4px;">
                    <ul class="comment">
                        <?php $__FOR_START_7351__=1;$__FOR_END_7351__=$comment_star['bad_comment'] + 1;for($i=$__FOR_START_7351__;$i < $__FOR_END_7351__;$i+=1){ ?>
                        <li <?php if($i == $comment_star['bad_comment']): ?>class="active"<?php endif; ?> >★</li>
                        <?php } $__FOR_START_4765__=1;$__FOR_END_4765__=6 - intval($comment_star['bad_comment']);for($i=$__FOR_START_4765__;$i < $__FOR_END_4765__;$i+=1){ ?>
                        <li>☆</li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-6 col-sm-6 control-label"></label>
        <div class="col-xs-6 col-sm-6">
            <button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button>
        </div>
    </div>
</form>
<script>
    $(function(){
        var num1 = $('#table1 tr').length;
        var num2 = $('#table2 tr').length;
        num1 = parseInt(num1);
        num2 = parseInt(num2);
        //优惠买单添加
        $('#table1').on('click','.add-btn',function(){
            var tr = '';
            tr += '<tr>'+
                '<td class="cl-id">'+
                '<input type="hidden" name="id[0]['+num1+']" class="form-control" value="'+num1+'">'+
                '<input type="text" name="over_money[0]['+num1+']" class="form-control" value="">'+
                '</td>'+
                '<td>'+
                '<input type="text" name="discount_money[0]['+num1+']" class="form-control" value="">'+
                '</td>'+
                '<td class="text-center">'+
                '<span class="btn-group">'+
                '<a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs add-btn " title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>'+
                '<a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  del-btn" title="最少设置一个"><i class="fa fa-edit fa-fw" disabled="disabled"></i><span class="hidden-xs" disabled="disabled">移除</span></a>'+
                '</span>'+
                '</td>'+
                '</tr>';
            num1 ++;

            $('#table1 tbody').append(tr);
        })

        //满减优惠
        $('#table2').on('click','.add-btn',function(){
            var tr = '';
            tr += '<tr>'+
                '<td class="cl-id">'+
                '<input type="hidden" name="id[1]['+num2+']" class="form-control" value="'+num2+'">'+
                '<input type="text" name="over_money[1]['+num2+']" class="form-control" value="">'+
                '</td>'+
                '<td>'+
                '<input type="text" name="discount_money[1]['+num2+']" class="form-control" value="">'+
                '</td>'+
                '<td class="text-center">'+
                '<span class="btn-group">'+
                '<a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs add-btn " title="添加"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">添加</span></a>'+
                '<a href="javascript:void(0);" class="btn btn-default btn-outline btn-xs  del-btn" title="最少设置一个"><i class="fa fa-edit fa-fw" disabled="disabled"></i><span class="hidden-xs" disabled="disabled">移除</span></a>'+
                '</span>'+
                '</td>'+
                '</tr>';
            num2 ++;

            $('#table2 tbody').append(tr);
        })
        //删除
        $('table').on('click','.del-btn',function(){
            var _this = $(this);
            var len = $('table tr').length;

            if(len == 2){
                layer.msg('已经是最后一个了！！');
            }else{
                _this.closest('tr').remove();
            }

        })

        //评论
        var wjx_k = "☆";
        var wjx_s = "★";
        //prevAll获取元素前面的兄弟节点，nextAll获取元素后面的所有兄弟节点
        //end 方法；返回上一层
        $("#comment_start li").on("mouseenter", function () {
            $(this).html(wjx_s).prevAll().html(wjx_s).end().nextAll().html(wjx_k);
        }).on("click", function () {
            var comment = $(this).index();
            comment = parseInt(comment) + 1;
            $(this).closest('.row').find('[name*=_comment]').attr('value',comment);
            $(this).addClass("active").siblings().removeClass("active")
        });
        $("#comment_start ul").on("mouseleave", function () {
            $("li").html(wjx_k);
            $(".active").text(wjx_s).prevAll().text(wjx_s);
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