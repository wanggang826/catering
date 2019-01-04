<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:49:"D:\www\alasika\public\theme\admin\Goods\edit.html";i:1505267753;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput.min.css" rel="stylesheet">

<script src="<?php echo $static_path; ?>plugins/fileinput/js/fileinput.js"></script>
<script src="<?php echo $static_path; ?>plugins/fileinput/js/locales/zh.js"></script>
<link href="<?php echo $static_path; ?>plugins/fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="<?php echo $static_path; ?>plugins/fileinput/themes/explorer/theme.js" type="text/javascript"></script>
<script src="<?php echo $static_path; ?>plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>


<style>
    .define_select{
        border: 1px solid #e5e6e7;
        padding: 6px 6px;
        font-size:14px;
        cursor: pointer;
    }
</style>
<form class="form-horizontal js-ajax-form clearfix" enctype="multipart/form-data" method='post' action='<?php echo url('edit_goods'); ?>' >
<input type="hidden" name="goods_id" value="<?php echo $goods['goods_id']; ?>">
<div class="form-group">
    <label for="goods_code" class="col-sm-2 control-label">商品编码</label>
    <div class="col-sm-4">
        <input type="text" name="goods_code" class="form-control" id="goods_code" value="<?php echo $goods['goods_code']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="cate" class="col-sm-2 control-label">商品分类</label>
    <div class="col-sm-4">
        <select id="cate" class="define_select" name="cate_id">
            <option value="" >请选择分类</option>
            <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['cate_id']; ?>" <?php if($goods['cate_id'] == $vo['cate_id']): ?>selected<?php endif; ?>><?php echo $vo['cate_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="goods_name" class="col-sm-2 control-label">商品名称</label>
    <div class="col-sm-4">
        <input type="text" name="goods_name" class="form-control" id="goods_name" value="<?php echo $goods['goods_name']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="goods_spell" class="col-sm-2 control-label">商品简称</label>
    <div class="col-sm-4">
        <input type="text" name="goods_spell" class="form-control" id="goods_spell" value="<?php echo $goods['goods_spell']; ?>">
    </div>
</div>

<div class="form-group">
    <label for="images" class="col-sm-2 control-label">商品图片</label>
    <div class="col-sm-8">
        <label class="control-label">选择文件</label>
        <input id="images" type="file" name="image_data[]" multiple>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label"></label>
    <div class="col-sm-6" id="file-fj">
    </div>
</div>

<div class="form-group">
    <label for="unit" class="col-sm-2 control-label">规格</label>
    <div class="col-sm-4">
        <input type="text" name="unit" class="form-control" id="unit" value="<?php echo $goods['unit']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="unit" class="col-sm-2 control-label">显示价格</label>
    <div class="col-sm-4">
        <input type="text" name="show_price" class="form-control" id="show_price" value="<?php echo $goods['show_price']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="unit" class="col-sm-2 control-label">建议售价</label>
    <div class="col-sm-4">
        <input type="text" name="sale_price" class="form-control" id="sale_price" value="<?php echo $goods['sale_price']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="net_quantity" class="col-sm-2 control-label">标签（用,分隔）</label>
    <div class="col-sm-4">
        <input type="text" name="label" class="form-control" id="label" value="<?php echo $goods['label']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="net_quantity" class="col-sm-2 control-label">净含量</label>
    <div class="col-sm-4">
        <input type="text" name="net_quantity" class="form-control" id="net_quantity" value="<?php echo $goods['net_quantity']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-2 control-label">描述</label>
    <div class="col-sm-4">
        <textarea class="layui-textarea" name="description" id="description" style="width: 350px;height:100px;"><?php echo $goods['description']; ?></textarea>
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-sm-2 control-label">备注</label>
    <div class="col-sm-4">
        <textarea class="layui-textarea" name="remark" id="remark" style="width: 350px;"><?php echo $goods['remark']; ?></textarea>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">状态</label>
    <div class="col-sm-4">
        <label class="i-lab"><input type="radio" name="status" value='1' class="mgr mgr-primary" <?php if($goods['status'] == 1): ?>checked<?php endif; ?>><span>启用</span></label>
        <label class="i-lab"><input type="radio" name="status" value='2' class="mgr mgr-primary" <?php if($goods['status'] == 2): ?>checked<?php endif; ?>><span>禁用</span></label>
    </div>
</div>

<div class="form-group">
    <label for="is_senior" class="col-sm-2 control-label">高级设置</label>
    <div class="col-sm-4">
        <label class="i-lab"><input type="radio" name="is_senior" value="2" class="mgr mgr-primary" <?php if($goods['is_senior'] == 2): ?>checked<?php endif; ?>><span>禁用</span></label>
        <label class="i-lab"><input type="radio" name="is_senior" value="1" class="mgr mgr-primary" <?php if($goods['is_senior'] == 1): ?>checked<?php endif; ?>><span>启用</span></label>
    </div>
</div>
<div id="senior">
    <div class="form-group">
        <label for="tag" class="col-sm-2 control-label">商品标签</label>
        <div class="col-sm-4">
            <select id="tag" class="define_select" name="tag_id">
                <option value="" >请选择标签</option>
                <?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['tag_id']; ?>" <?php if($goods['tag_id'] == $vo['tag_id']): ?>selected<?php endif; ?>><?php echo $vo['tag_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="brand" class="col-sm-2 control-label">商品品牌</label>
        <div class="col-sm-4">
            <select id="brand" class="define_select" name="brand_id">
                <option value="" >请选择品牌</option>
                <?php if(is_array($brands) || $brands instanceof \think\Collection || $brands instanceof \think\Paginator): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['brand_id']; ?>"  <?php if($goods['brand_id'] == $vo['brand_id']): ?>selected<?php endif; ?>><?php echo $vo['brand_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="origin" class="col-sm-2 control-label">商品产地</label>
        <div class="col-sm-4">
            <select id="origin" class="define_select" name="origin_id">
                <option value="" >请选择产地</option>
                <?php if(is_array($origins) || $origins instanceof \think\Collection || $origins instanceof \think\Paginator): $i = 0; $__LIST__ = $origins;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['origin_id']; ?>" <?php if($goods['origin_id'] == $vo['origin_id']): ?>selected<?php endif; ?>><?php echo $vo['origin_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="effect" class="col-sm-2 control-label">商品功效</label>
        <div class="col-sm-4">
            <select id="effect" class="define_select" name="effect_id">
                <option value="" >请选择功效</option>
                <?php if(is_array($effects) || $effects instanceof \think\Collection || $effects instanceof \think\Paginator): $i = 0; $__LIST__ = $effects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['effect_id']; ?>" <?php if($goods['effect_id'] == $vo['effect_id']): ?>selected<?php endif; ?>><?php echo $vo['effect_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="introduce" class="col-sm-2 control-label">产品介绍</label>
        <div class="col-sm-10">
            <script class="layui-textarea" name="introduce" id="introduce">
                <?php echo $goods['introduce']; ?>
            </script>
            <script type="text/javascript" src="<?php echo $static_path; ?>plugins/ueditor/ueditor.config.js"></script>
            <script type="text/javascript" src="<?php echo $static_path; ?>plugins/ueditor/ueditor.all.min.js"></script>
            <script type="text/javascript" src="<?php echo $static_path; ?>plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
            <script id="editor" name="introduce" type="text/plain" style="width:850px;height:550px;"></script>
            <script type="text/javascript">
            var ue = UE.getEditor('introduce',{
                toolbars: [
                    ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                        'directionalityltr', 'directionalityrtl', 'indent', '|',
                        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                        'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
                        'horizontal', 'date', 'time', 'spechars',  'wordimage', '|',
                        'preview', 'searchreplace'
                    ]
                ],
                initialFrameHeight:400,
                initialFrameWidth:800,
                maximumWords:200
            });
            </script>
        </div>
    </div>
    <div class="form-group">
        <label for="ingredient" class="col-sm-2 control-label">主要成分</label>
        <div class="col-sm-4">
            <input type="text" name="ingredient" class="form-control" id="ingredient" value="<?php echo $goods['ingredient']; ?>">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <button type="submit" class="btn btn-info js-submit-btn mr_3px">确认</button>
        <button type="reset" name="reset" class="btn btn-info">重置</button>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#senior').css('display','none');
        $('input[name="is_senior"]:checked').val() == 1 && $('#senior').css('display','block');;
        $('input[name="is_senior"]').click(function(){
            $(this).val()==1 && $('#senior').css('display','block');
            $(this).val()==2 && $('#senior').css('display','none');
        });
        $('button[name="reset"]').click(function(){
            $('#senior').css('display','none');
        });

        $("#images").fileinput({
            uploadUrl:  "<?php echo url('Goods/add_pic'); ?>",//上传的地址
            uploadAsync: false,    //是否一部 开启异步，也就是每一个图片都会请求一次上传地址，这里设置成同步
            dropZoneEnabled: false,
            showPreview :true,
            allowedFileExtensions : ['jpg', 'png','gif'],//接收的文件后缀,
            maxFileCount: 10,
            maxFileSize : 5000,
            enctype: 'multipart/form-data',
            showCaption: true,//是否显示标题
            browseClass: "btn btn-primary", //按钮样式
            showRemove: true,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            msgFilesTooMany: "选择上传的文件数量(10) 超过允许的最大数值5M！",
            language: 'zh', //设置语言
            overwriteInitial: false,
            //预览图的设置
            initialPreviewAsData: true,     //是否开启预览图
            initialPreview:<?php echo $goods['goods_pics']; ?>,   //预览图的json数组
            initialPreviewConfig:      //预览图配置
//                {
//                    caption: '',    //预览图的名字
//                    width: '120px',   //宽度
//                    url: "<?php echo url('Goods/del_pic'); ?>",  //后台请求的删除方法
//                    key: 100,
//                },
//                {
//                    caption: '',
//                    width: '120px',
//                    url: "<?php echo url('Goods/del_pic'); ?>",
//                    key: 80,
//                }
                <?php echo $goods['previewConfig']; ?>,    //一个json数据，预览图默认的配置，里面包含图片的pic_id，删除请求的后台del_pic方法
            layoutTemplates: {
                //actionDelete: '',//预览图的删除按钮隐藏
                actionUpload: ''//去掉预览图单独上传的按钮，这里采用几张图一起提交到后台
            }
        });
        $('#images').on('filebeforedelete', function() {
            var aborted = !window.confirm('确定删除商品的这张图片吗？');
            return aborted;
        });

        $('#images').on('filebatchuploadsuccess', function(event,data, previewId, index) {
            //alert(data.response);
            var file="<input type='hidden' name='pic' readonly='readonly' value='"+data.response+"'>";
            $(this.form).prepend(file);
        });

        //        $('#images').on('filebeforedelete', function() {
//            window.layer.confirm('确定删除这张图片吗？',{
//                    btn: ['确定','取消']
//                }, //按钮
//                function() {
//                    return false;
//                },function () {
//                    return true;
//                })
//        });

    });
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