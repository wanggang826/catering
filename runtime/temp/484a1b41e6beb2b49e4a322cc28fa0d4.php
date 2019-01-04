<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"D:\www\alasika\public\theme\admin\device\container_add.html";i:1503018907;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput.min.css" rel="stylesheet">
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput-rtl.css" rel="stylesheet">
<script src="<?php echo $static_path; ?>plugins/fileinput/js/fileinput.js"></script>
<script src="<?php echo $static_path; ?>plugins/fileinput/js/locales/zh.js"></script>
<script src="<?php echo $static_path; ?>/js/checkForm.js"></script>
<script src="<?php echo $static_path; ?>js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
<form class="form-horizontal js-ajax-form clearfix" id="validate_form" action='<?php echo url('container_add'); ?>' enctype="multipart/form-data">
   <div class="form-group">
        <label for="" class="col-sm-2 control-label">型号名称</label>
        <div class="col-sm-4">
            <input type="text" name="container_code" class="form-control" id="container_code" placeholder="型号名称" js-check="container_code">
        </div>
    </div>

    <div class="form-group">
        <label for="" class="col-sm-2 control-label">货柜类型</label>
        <div class="col-sm-4">
            <select   class="form-control"  name="type_id" id="type_id" js-check="type_id">
                <option value="">货柜类型</option>
                <option value="1">弹簧机</option>
                <option value="2">格子机</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">启用状态</label>
        <div class="col-sm-4">
			<select   class="form-control"  name="status" id="status">
                <option value="0">禁用</option>
                <option value="1" selected="selected">启用</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">生成厂家</label>
        <div class="col-sm-4">
            <select   class="form-control"  name="manufacturer_id" js-check="manufacturer_id">
                <option value="">生成厂家</option>
                <?php if(is_array($manufacturer) || $manufacturer instanceof \think\Collection || $manufacturer instanceof \think\Paginator): if( count($manufacturer)==0 ) : echo "" ;else: foreach($manufacturer as $key=>$facturer): ?>
                <option value="<?php echo $facturer['factor_id']; ?>"><?php echo $facturer['factor_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">附件</label>
        <div class="col-sm-4">
            <label class="control-label">选择文件</label>
            <input id="input-4" name="enclosure[]" type="file" multiple class="file-loading" data-show-caption="true">
        </div>
    </div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label"></label>
    <div class="col-sm-6" id="file-fj">
    </div>
</div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">备注</label>
        <div class="col-sm-4">
            <textarea rows="3" cols="30" name="description"></textarea>
        </div>
    </div>
    <div class="form-group">
        <table>
            <?php $__FOR_START_21654__=1;$__FOR_END_21654__=11;for($y=$__FOR_START_21654__;$y < $__FOR_END_21654__;$y+=1){ ?>
            <tr>
                <?php $__FOR_START_23805__=1;$__FOR_END_23805__=11;for($i=$__FOR_START_23805__;$i < $__FOR_END_23805__;$i+=1){ ?>
                <td><div name="aisle-data" dblclick="open_aisle(this)">
                    <input type="text" value="<?php echo $y; ?>-<?php echo $i; ?>" name="aisle" readonly="readonly">:<input type="number" min="0" max="99" value="0" readonly="readonly" name="aisle[<?php echo $y; ?>-<?php echo $i; ?>]">
                </div>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
    </div>
    
    <div class="form-group">
        <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary js-submit-btn mr_3px">确认</button>
            <button type="reset" class="btn btn-primary">重置</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    /*
     * 验证
     * */
    function container_code(e){
        var container_code = $(e).val();
        if (container_code == '') {
            return '请填写型号名称!';
        }
        return true;
    }

    function type_id(e){
        var type_id = $(e).val();
        if (type_id == '') {
            return '请选择货柜类型!';
        }
        return true;
    }
    function manufacturer_id(e){
        var manufacturer_id = $(e).val();
        if (manufacturer_id == '') {
            return '请选择生产厂家!';
        }
        return true;
    }

    $(document).on('ready', function() {
        $("div[name='aisle-data']").dblclick(function () {
            $(this).find("input").eq(1).removeAttr("readonly").val(10);
        })
        $(document).on('ready', function() {
            var url="<?php echo url('admin/publics/upload_file'); ?>";
            var delete_url="<?php echo url('admin/publics/delete_file'); ?>";
            $("#input-4").fileinput({
                uploadUrl: url, //上传的地址
                deleteUrl:delete_url,
                dropZoneEnabled: false,
                showPreview :false,
                //allowedFileExtensions : ['jpg', 'png','gif'],//接收的文件后缀,
                maxFileCount: 10,
                maxFileSize : 5000,
                enctype: 'multipart/form-data',
                showUpload: true, //是否显示上传按钮
                showCaption: false,//是否显示标题
                browseClass: "btn btn-primary", //按钮样式
                showRemove: true,
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
                msgFilesTooMany: "选择上传的文件数量(10) 超过允许的最大数值5M！",
                language: 'zh', //设置语言
            });
            $('#input-4').on('fileuploaded', function(event,data, previewId, index) {
                //console.log(data);
                if (data.response == undefined || data.response=='') {
                    layer.alert('文件上传失败');
                    return;
                }else {
                    var file='<div id="'+previewId+'"><input type="text" name="enclosure['+data.response.getFilename+']" readonly="readonly" value="'+data.response.getSaveName+'"><button type="button" onclick="delfj(\''+encodeURI(data.response.getSaveName)+'\',\''+previewId+'\')">删除</button></div>';
                    $("#file-fj").prepend(file);
                }
            });
            $("#input-4").on("filesuccessremove",function(event, data, previewId){
                console.log(event)
                //console.log(List);
            });
        }); })


    function delfj(filename,previewId) {
        var url="<?php echo url('admin/publics/delete_file'); ?>";
        $.post(url,{'filename':decodeURI(filename)},function (res) {
            if(res){
                $("#"+previewId).remove();
            }else {
                layer.alert("删除失败");
            }
        },"json")
    }
    function escapeHtml(string) {
        var entityMap = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': '&quot;',
            "'": '&#39;',
            "/": '&#x2F;'
        };
        return String(string).replace(/[&<>"'\/]/g, function (s) {
            return entityMap[s];
        });
    }
</script>



<script src="<?php echo $static_path; ?>/js/uploadImg.js"></script>
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput.min.css" rel="stylesheet">
<link href="<?php echo $static_path; ?>plugins/fileinput/css/fileinput-rtl.css" rel="stylesheet">
<script src="<?php echo $static_path; ?>plugins/fileinput/js/fileinput.js"></script>
<script src="<?php echo $static_path; ?>plugins/fileinput/js/locales/zh.js"></script>
<script src="<?php echo $static_path; ?>/js/checkForm.js"></script>
<script src="<?php echo $static_path; ?>js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
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