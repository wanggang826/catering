<?php 
//此配置文件由系统生成，修改无效
return [
	'web_url'=>'127.0.0.88',//当前网站域名，请谨慎修改

	'web_status'=>'1',//配置站点是否开启0-关闭，1-开启

	'web_admin_name'=>' 后台管理',//后台名称

	'static_url'=>'127.0.0.88',//静态资源服务器，请谨慎修改

	'web_desc'=>'我还没有.',//888888888

	'web_admin_desc'=>'后台管理',//后台描述

	'login_timeout'=>'0',//登录超时时间

	'beat_time'=>'30000',//后台登录超时验证时间间隔

	'check_scene'=>'always',//后台访问权限验证方式

	'default_img'=>'/config/1498463598_DEFAULT_IMG1.png',//图片文件不存在时默认显示图片

	'web_logo'=>'/config/2017/06/1496906081WEB_LOGO1.png',//网站logo

	'qr_code'=>'/config/1497252222_QR_CODE1.png',//商城二维码

	'email_smtpsecure'=>'ssl',//使用安全协议

	'email_host'=>'smtp.163.com',//服务器

	'email_port'=>'465',//邮件发送端口

	'email_username'=>'wanggang19910826@163.com',//邮件发送用户名

	'email_password'=>'wanggang826',//邮件发送密码

	'email_from'=>'wanggang19910826@163.com',//邮件发送者地址

	'email_fromname'=>'wanggang19910826@163.com',//邮件发送者用户名

	'email_subject'=>'邮箱验证码',//邮件标题

	'email_body'=>'您好: 你正在{$act}，验证码为{$code}，您也可以点击{$link}下面完成操作',//邮件内容

	'email_code_time'=>'600',//验证码有效期

	'upload_root_path'=>'public/upload',//上传文件的根目录

	'enc_path'=>'/enclosure/',//上传附件目录

	'goods_img'=>'/goods/',//商品图片上传路径

	'img_path'=>'/image/',//普通图片上传路径

	'dining_set'=>'a:5:{s:11:"dining_name";s:10:"柳巷香d";s:5:"phone";s:11:"13548875418";s:14:"business_hours";s:46:"工作日：9:00-21:00  周末：12：00-00:00";s:7:"address";s:13:"民治大道2";s:11:"dining_desc";s:13:"民治大道2";}',//餐厅信息

	'about_us'=>'<p>呵呵呵呵或或或<img src="/ueditor/php/upload/image/20171205/1512462606249455.png" title="1512462606249455.png" alt="pic-logo.png"/><img src="/ueditor/php/upload/image/20171212/1513041328149707.jpg" title="1513041328149707.jpg" alt="04.jpg"/></p>',//关于我们

	'integral_need'=>'200',//抽奖一次消耗积分

	'valid_time'=>'8',//优惠券有效期

	'discount_enable'=>'N',//是否允许优惠买单，Y是，N否

	'delivery_fee'=>'5',//外卖配送费

	'pack_fee'=>'8',//外卖打包费

	'new_off'=>'7',//首单优惠

	'comment_star'=>'a:3:{s:12:"good_comment";s:1:"4";s:11:"mid_comment";s:1:"3";s:11:"bad_comment";s:1:"2";}',//评论等级

	'ali_pay'=>'a:8:{s:10:"notify_url";a:3:{s:4:"name";s:18:"异步通知地址";s:4:"desc";s:18:"异步通知地址";s:3:"val";s:50:"http://essj.baogt.com/mobile/pay/alipay_notify_url";}s:6:"app_id";a:3:{s:4:"name";s:5:"appid";s:4:"desc";s:20:"绑定支付的APPID";s:3:"val";s:16:"2017101909390719";}s:10:"return_url";a:3:{s:4:"name";s:12:"同步跳转";s:4:"desc";s:12:"同步跳转";s:3:"val";s:50:"http://essj.baogt.com/mobile/pay/alipay_return_url";}s:7:"charset";a:3:{s:4:"name";s:12:"编码格式";s:4:"desc";s:12:"编码格式";s:3:"val";s:5:"UTF-8";}s:9:"sign_type";a:3:{s:4:"name";s:12:"签名方式";s:4:"desc";s:12:"签名方式";s:3:"val";s:4:"RSA2";}s:10:"gatewayUrl";a:3:{s:4:"name";s:15:"支付宝网关";s:4:"desc";s:15:"支付宝网关";s:3:"val";s:37:"https://openapi.alipay.com/gateway.do";}s:20:"merchant_private_key";a:3:{s:4:"name";s:12:"商户私钥";s:4:"desc";s:42:"商户私钥，您的原始格式RSA私钥";s:3:"val";s:1616:"MIIEpQIBAAKCAQEAwjnNaZvBL2DNmr+dWsW/cNzACmEvpKkuWqyOWHpwf35F92Ge 4TATm+YMO0YZLRsRyOMLnftk97cbivQsqu8c7OV4UUH03F+dbwutJ3hfjOjfqVRb 6OBHT3R2JYpDL/nvzdlhBkhiqI8Tqb4FUkJiYyMqXSSUGBK9ijKzUw2Ih9/ySABS pXEB1bHcLNgM/8ZeZdJy2iLxlmeEOcJVauLnjkssjZ3kctcSA18Rvh7iOJ0fPOzi evPYjHg9HBDRz1tH7W8aVpIjn8bBK2QxpMKnfJHD1q2M/U+/HQXu7g2xZuCBxsAz DpS1i/rBqNgOQAjGFrnDSh3JPJt0T2E17jt/3QIDAQABAoIBADV6bum+PiIKeHI8 glolCsJLtgDlo5WmE6JZ0tPf2qvwG9myommEsFGDtSh486OsyWfTxDYaq0FdxJKt CsOCFSfRQyC0lXQ8S3/w6httFHobAMKB/NCROHFTMtjBSiCio/m8+e8d7TRWOObK 8HIm3ypG23pMAQ7j0haEQUYD+uzWLNC6VBq2nET3S88wIODLW1PRPpLufKOB9RKY KJDynDSf+Pthpxhu2ZMYAax0JD+dKoo6nlW1r51dhQP0/62LdqjIIzeu7Ccnfz4j NtY1Ehr4DEPfl2JO0ErNQynHrlO5JVodCkpX2LirHD9Q2rlIDJzYiBswk9fS+dpR hTISDOECgYEA6k88APQkyscsGZMgrVxWbKL2YK0Ccz0JSRbfEX5zWF/0tWJ3q9Gf c5Q3mpAiPVXWuyo1Dkp/pd8/wUsu83V5vNyaWWdqxjEQSP302vRg2HUU3Rco0cIu aY8EHe9/So8Oq7OI7WUy7Y/Bjz0xnDfGzf+squW5FcWTaHmp0G2lv6UCgYEA1DSl qfZDeezHQ3ryNIMEaDQ0JqjSBL2Eo/f0kiXY2enbEx5YBi4xG2f3qNOl8/sAA+yC ynA1eUTq7vaMRVbX0oj+6qyWaDL6MP5XtDAbUxCX92PqqNir2/5t5D7EiXBVs3hK fUvyL/BAj6K4wo3qEcijj4lXFM8Mct56f+jeSdkCgYEAoiwVK9PPY0pXi5v5kgPH DYn9XQxiFcC5HI1n94O98fz4MlLk4VdFNYnwslnwWOOArCqabjnB/9x1FCQlavx0 NfO6IQcjL+nli5+6SZG7NhZTSnMtHYF4/jaucsnBIKnDTbQFocnZZfOJ1MpV+/ne 79V2fRJi+F63mCgdENXTUsECgYEAwDRvWOKVe3nbgmN5vdZtx3SBSALhNynxWhLc kwN0xuvqYga5898i24/v4hrR1YsjGGrAjFvWE2E46fimVKe0FB3Bxw1LrlV+B6JY Df0EwtfkzU7S3NxjzX9GSdYQbewxs7zgu1xuoL0bvP3GG3Iu8KyqePgMx+xBeknI 6tIhhQECgYEAosy+lDqWcGgtbkFfBZb4gYAKyurGynmDwrrbSxj+1eJE3un8BOTt AWjdxlQQiCgAjs9kdb91LAi7xpiTOWsX8UOaVU2AV4BxlB1v2980S9XnHchaqHRE +H8yCg7pZlYP1f1GPgTF+I/vBPuGmzwtrrpPa5rvRX1AO5BmSWHQe4c=";}s:17:"alipay_public_key";a:3:{s:4:"name";s:15:"支付宝公钥";s:4:"desc";s:51:"支付宝公钥,对应APPID下的支付宝公钥。";s:3:"val";s:392:"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzKq2V9EuXo01hgZNsK2uJAf11DHNHyD+7ekzU2Q4TUhfaFY24mVr5Fuv/DvubJEP10Nu00Nsje3NBKM/Z2dxxquAN3CkoRy7RvChW/KksyVNH7VKnp6blmqsCFh2xLv+2T3oLd1VTTj2+WxVqi+Gu8+r3nyMEUBeby3knEur/NdzNSho7l/Q2zte9oFNdgMKZlOXWFvVG5hnZURJPHJBzlI/eyjOrGaL5+WRI9XUHPMAtuSZtenj8ul7gv1VjLLeHWCcM1WirOBFgXinaPCWLLGhRSkf5N17GW51M+ZLY3TWqdkpo0oRcMt+jPeVfv9hyi/XalwLMqLMa04gMffuLQIDAQAB";}}',//支付宝配置

	'wx_pay'=>'a:4:{s:6:"app_id";a:3:{s:4:"name";s:5:"appid";s:4:"desc";s:20:"绑定支付的APPID";s:3:"val";s:18:"wx426b3015555a46be";}s:6:"mch_id";a:3:{s:4:"name";s:9:"商户号";s:4:"desc";s:8:"商户id";s:3:"val";s:10:"1900009851";}s:10:"app_secret";a:3:{s:4:"name";s:6:"secret";s:4:"desc";s:18:"公众账号secret";s:3:"val";s:32:"7813490da6f1265e4901ffb80afaa36f";}s:3:"key";a:3:{s:4:"name";s:6:"密钥";s:4:"desc";s:18:"商户支付密钥";s:3:"val";s:32:"8934e7d15453e97507ef794cf7b0519d";}}',//微信支付配置

];