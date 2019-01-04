<?php
/**
 * Created by tiway
 * Date: 2017/10/19
 * Time: 13:42
 */
namespace app\api\controller;

use extend\sendAPI;
use think\Exception;

class SendSms extends BaseApi
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 发送短信验证码
     * @param  [string] $tel     手机号
     * @param  [type] $content   短信内容
     * @return [type]            发送状态
     */
    public function verifyCode(){
        if(request()->isGet()){
            try{
                $mobile = input('user_phone');
                if(!preg_match("/^1[34578]\d{9}$/", $mobile))
                    throw new Exception('请填写正确手机号码');

//               $code = rand(100000,999999);
                $code = '123456';
                $sms = array(
                    'code'  => $code,
                    'mobile'=> $mobile
                );

                //为后期验证手机和验证码
                session('smscode',$sms);
               $content = '您的验证码为'.$code;
               $url 		= config('sms.url');//提交地址
               $username 	= config('sms.user_name');//用户名
               $password 	= config('sms.password');//原密码

               $sendAPI = new sendAPI($url, $username, $password);
               $data = array(
                   'content' 	=> $content.' 【外賣】',//短信内容
                   'mobile' 	=> $mobile,//手机号码
                   'productid' => '676767',//产品id
                   'xh'		=> ''//小号
               );
               $sendAPI->data = $data;//初始化数据包
               $res = $sendAPI->sendSMS('POST');//GET or POST

               $result = explode(',',$res);

               if($result[0] != 1)
                   throw new Exception('短信发送失败');

               return json($this->returnData([],501,'发送成功'));

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }

    }
}