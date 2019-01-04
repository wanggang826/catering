<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\www\alasika\public\theme\mobile\goods\goods_list.html";i:1505455963;s:53:"D:\www\alasika\public\theme\mobile\layout\layout.html";i:1505208863;}*/ ?>
<!DOCTYPE html>
<html style="background:#F0F2F5;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="__MOBILE__/static/js/mui.min.js"></script>
    <link href="__MOBILE__/static/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="__MOBILE__/static/iconfont/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__MOBILE__/static/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="__MOBILE__/static/css/_other.css"/>
    <script src="__MOBILE__/static/js/flexible.js"></script>
    <script src="__MOBILE__/static/js/jquery_min.js"></script>

    <script type="text/javascript" charset="utf-8">
        mui.init();
    </script>
</head>
<body>
<body>
	<div id="my_confirm">
		<div>
			<h3>确认放弃已选商品？</h3>
			<div><span class="cancel_btn">取消</span><span class="sure_btn">确定</span></div>
		</div>
	</div>
	<header class="mui-bar mui-bar-nav">
	    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	    <h1 class="mui-title">咖啡列表</h1>
	</header>
	<div class="mui-content need_bottom_50">
	    <div id="coffee_list">
			<ul class="show_content">
				<?php if(is_array($data['data']) || $data['data'] instanceof \think\Collection || $data['data'] instanceof \think\Paginator): if( count($data['data'])==0 ) : echo "" ;else: foreach($data['data'] as $key=>$vo): ?>
				<li>
					<div class="diy-content">
						<div class="diy-photo"><img src="/<?php echo $vo['images']; ?>"/><span class="num_label">9</span></div>
		    			<div class="con-middle">
							<h3 class="middle-title"><span><?php echo $vo['goods_name']; ?></span><?php echo $vo['goods_spell']; ?></h3>
		    				<div class="ellipsis">
								<?php if($vo['label']): ?>
		    					<p>
									<?php if(is_array($vo['label']) || $vo['label'] instanceof \think\Collection || $vo['label'] instanceof \think\Paginator): if( count($vo['label'])==0 ) : echo "" ;else: foreach($vo['label'] as $key=>$la): ?>
		    						<span><?php echo $la; ?></span>
									<?php endforeach; endif; else: echo "" ;endif; ?>
		    					</p>
								<?php endif; ?>
							</div>
		    				<p class="orange_color">
								<span>销量：</span>
								<span>68</span>
		    					&nbsp;&nbsp;&nbsp;&nbsp;
								<span>评价：</span>
								<span>9</span>
							</p>
		    			</div>
		    			<div class="con-right">
							<!--<div class="right-sale">APP专享<span>9</span>折</div>-->
							<div class="right-money"><em>¥</em><span class="single_price"><?php echo $vo['sale_price']; ?></span></div>
							<div class="right-total">
								<span class="mui-icon iconfont icon-zengjia js-del-btn"></span>
								<span class="single_num" goods_id="<?php echo $vo['goods_id']; ?>">0</span>
								<span class="mui-icon iconfont icon-jianshao"></span>
							</div>
		    			</div>
					</div>
		    	</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
	    </div>
	</div>
	<div class="footer_select" id="no_select">
		<div><span>暂无选购商品</span></div>
		<div><span>结算&nbsp;(&nbsp;0&nbsp;)</span></div>
	</div>
	<div class="footer_select" id="has_select">
		<div>总计：<span class="total_money">20</span>&nbsp;元</div>
		<div class="account_btn">结算&nbsp;(<span class="total_num">&nbsp;999&nbsp;</span>)</div>
	</div>
	<script>
		var url="<?php echo url('cart/buy_goods'); ?>";
	</script>
	<script src="<?php echo $js; ?>/coffee_list.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
</body>
</html>