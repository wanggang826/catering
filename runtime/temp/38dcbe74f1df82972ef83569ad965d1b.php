<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:49:"D:\www\alasika\public\theme\admin\user\index.html";i:1503460468;s:52:"D:\www\alasika\public\theme\admin\layout\layout.html";i:1502172025;s:52:"D:\www\alasika\public\theme\admin\layout\static.html";i:1503460468;s:48:"D:\www\alasika\public\theme\admin\layout\js.html";i:1503460468;}*/ ?>
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
    <form role="form" action="<?php echo url('User/index'); ?>" class="panel-body hidden-xs form-inline">
         <div class="form-group group1">
           <input type="text" name="start_time" class="form-control i-datestart"  id="date3" placeholder="注册日期" value="<?php echo input('start_time'); ?>">
        </div>
        <div class="form-group group2">
           <input type="text" name="end_time" class="form-control i-dateend" id="date3" placeholder="至今" value="<?php echo input('end_time'); ?>">
        </div>

        <div class="form-group">
            <select class=" form-control" name="status" >
                <option value="">状态</option>
                <option value="2" <?php if(input('status') == 2): ?> selected<?php endif; ?> selected >启用</option>
                <option value="1" <?php if(input('status') == 1): ?> selected<?php endif; ?>>禁用</option>
            </select>
        </div>
        
       
        <div class="form-group">
            <input type="text" placeholder="员工姓名" id="ex1" class="form-control" name="username" value="<?php echo input('username'); ?>">
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
        <div class="btn-group pull-left hidden-xs">
            <div class="btn-group pull-left hidden-xs">
	            <a href="<?php echo U('User/add_user'); ?>" class="btn btn-outline btn-default js-window-load" js-title="新增会员" js-unique="true">
	                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;新增
	            </a>
	            <a href="<?php echo U('User/del_user'); ?>" class="btn btn-outline btn-default js-del-btn del-all" text="删除后将无法恢复，请谨慎操作">
	                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;批量删除
	            </a>
        	</div>
            <a href="<?php echo url('User/export'); ?>"  class="btn btn-outline btn-default" text="">
                <i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;导出
            </a>
        </div>
        <div class="pull-right">
        <?php echo $lists->render(); ?>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered table-condensed table-striped" id="sample001" data-name="cool-table">
    <thead>
        <tr>
            <th width='1'><input type="checkbox" class="my-all-check" name="input[]"></th>
            <th width="240">操作</th>
            <th width="150" class="hidden-xs">员工姓名</th>
            <th width="150">所属角色</th>
            <th width="150" class="hidden-xs">账户名称</th>
            <th width="150" class="hidden-xs">所属机构</th>
            <th width="150" class="hidden-xs">区域编码</th>
            <th width="150" class="hidden-xs">状态</th>
            <th width="150" class="hidden-xs">描述</th>
            <th width="150" class="hidden-xs">创建时间</th>
            <th width="150" class="hidden-xs">更新时间</th>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		<tr>
			<td width='1'><input type="checkbox" class="i-checks" value="<?php echo $vo['id']; ?>" name="input[]"></td>
			<td>
				<span class="btn-group">
                    <a href="<?php echo url('User/edit_user',['id'=>$vo['id'],'page'=>$nowpage,'group_id'=>$vo['group_id'],'agent_id'=>$vo['agent_id']]); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="编辑"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">编辑</span></a>
                    <a href="<?php echo url('User/set_pwd',['id'=>$vo['id']]); ?>" class="btn btn-default btn-outline btn-xs js-window-load" title="重置密码"><i class="fa fa-edit fa-fw"></i><span class="hidden-xs">重置密码</span></a>
                    <?php if($vo['status'] == 1): ?>
                    <a href="<?php echo U('User/user_status',['id'=>$vo['id'],'status'=>2]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="启用后该会员可以正常展示"><i class="fa fa-check fa-fw"></i><span class="hidden-xs">启用</span></a>
                    <?php elseif($vo['status'] == 2): ?>
                    <a href="<?php echo U('User/user_status',['id'=>$vo['id'],'status'=>1]); ?>" js-color="#eea236" class="btn btn-default btn-outline btn-xs js-del-btn" text="禁用后该会员将无法展示！"><i class="fa fa-times fa-fw"></i><span class="hidden-xs">禁用</span></a>
                    <?php endif; ?>
                    <a href="<?php echo url('del_user',['id'=>$vo['id']]); ?>" class="btn  btn-danger btn-outline btn-xs js-del-btn" text="删除后将无法恢复,请谨慎操作！"><i class="fa fa-trash-o fa-fw"></i><span class="hidden-xs">删除</span></a>
                </span>
			</td>
			<td><?php echo $vo['username']; ?></td>
			<td><?php echo $vo['group_id']; ?></td>
			<td><?php echo $vo['nickname']; ?></td>
			<td><?php echo $vo['agent_id']; ?></td>
			<td><?php echo $vo['area_code']; ?></td>
			<td><?php echo $vo['statusname']; ?></td>
			<td><?php echo $vo['des']; ?></td>
			<td><?php echo $vo['create_time']; ?></td>
			<td><?php echo $vo['update_time']; ?></td>
		</tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
</div>
<script type="text/javascript">
function page_size(){
    $('.pagesize_form').submit();
}
//全选/反选
$("#all").click(function(){
    if(this.checked){
        $("#list :checkbox").prop("checked", true);
    }else{
        $("#list :checkbox").prop("checked", false);
    }
});
</script>
<script type="text/javascript">
    $(function(){
        $("table").tableExport({formats:["xlsx"]});
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