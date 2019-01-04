<?php
namespace app\admin\controller;

use app\admin\model\OrderInfo;
use think\Db;
use think\Exception;
use vendor\alipay\AlipayTradeService;
use vendor\WxPayConfig;
use vendor\WxPayRefund;

/**
 * 订单控制器
 * @author  huangwei
 * @version 2017/8/12
 */
class Order extends AdminBase{

    /**
     * 订单列表
     */
    public function eatinList()
    {
        $map = ['a.type' => 0];  //筛选条件数组
        $map1 = [];
        $pageParam = [];   //分页条件数组
        if(input('status') != null){
            $map['a.status'] = input('status');
            $pageParam['status'] = input('status');
        }
        !empty(input('order_sn')) && $map['a.order_sn'] = ['like', '%'.input('order_sn').'%'];
        !empty(input('mobile')) && $map1['c.mobile'] = ['like', '%'.input('mobile').'%'];
        !empty(input('nickname')) && $map1['c.nickname'] = ['like', '%'.input('nickname').'%'];

        $start = input('start');
        $end = input('end');
        $pageParam['start'] = $start;
        $pageParam['end'] = $end;
        if (!empty($start) && !empty($end)) {
            $map['a.create_time'] = [['>=', strtotime($start)], ['<=', strtotime($end)]];
        }else{
            if (!empty($start)) {
                $map['a.create_time'] = ['>=', strtotime($start)];
            }
            if (!empty($end)) {
                $map['a.create_time'] = ['<=', strtotime('+1 day', strtotime(input('end')))];
            }
        }
        $type = 0;
        $list = model('order')->getList($map,$map1);
        $url = 'eatinList';
        $status = [0 => '未处理', 1 => '已处理'];
        $page = $list->appends($pageParam)->render();
        return view('', compact('list', 'page', 'status', 'type', 'url'));
    }

    /**
     * 订单列表
     */
    public function takeoutList()
    {
        $map = ['a.type' => 1];  //筛选条件数组
        $map1 = [];  //筛选条件数组
        $pageParam = [];   //分页条件数组
        if(input('status') != null){
            $map['a.status'] = input('status');
            $pageParam['status'] = input('status');
        }
        !empty(input('order_sn')) && $map['a.order_sn'] = ['like', '%'.input('order_sn').'%'];
        !empty(input('mobile')) && $map1['c.mobile'] = ['like', '%'.input('mobile').'%'];
        !empty(input('name')) && $map1['c.name'] = ['like', '%'.input('name').'%'];

        $start = input('start');
        $end = input('end');
        $pageParam['start'] = $start;
        $pageParam['end'] = $end;
        if (!empty($start) && !empty($end)) {
            $map['a.create_time'] = [['>=', strtotime($start)], ['<=', strtotime($end)]];
        }else{
            if (!empty($start)) {
                $map['a.create_time'] = ['>=', strtotime($start)];
            }
            if (!empty($end)) {
                $map['a.create_time'] = ['<=', strtotime('+1 day', strtotime(input('end')))];
            }
        }
        $type = 1;
        $url = 'takeoutList';
        $list = model('order')->getList($map,$map1);
        $status = [0 => '待接单', 1 => '待派送', 2=>'派送中', 3=>'已完成'];
        $page = $list->appends($pageParam)->render();
        return view('', compact('list', 'page', 'status', 'type','url'));
    }


    /**
     * 订单详情
     */
    public function orderDetail()
    {
        $order_id = input('order_id');
        $type = input('type');
        $url = input('url');
        $order = model('order')->orderDetail($order_id);
        $status = [0 => '待接单', 1 => '待派送', 2=>'派送中', 3=>'已完成'];
        if($type == 0){
            $status = [0 => '未处理', 1 => '已处理'];
        }
        $order['statusStr'] = $status[$order['status']];
        return view('', compact('order', 'type', 'url'));
    }

    //取消订单列表
    public function orderCancelList()
    {
        $data = input();
        $model = new \app\admin\model\Order();
        $model = $model->alias('O')
            ->field('O.order_id,O.order_sn,O.member_id,O.order_price,O.type,O.create_time,O.status')
            ->join('cy_member M','M.id = O.member_id');
        if(isValue($data,'order_sn')){
            $model = $model->where('O.order_sn','like','%'.(string)$data['order_sn'].'%');
        }
        if(isValue($data,'nickname')){
            $nickname = $data['nickname'];
            $model = $model -> where('M.nickname','like','%'.$nickname.'%');
        }

        $list = $model
            ->where('O.status','in',[11,12,13])->paginate();
        return view(['list'=>$list]);
    }

    //取消订单
    public function orderWithdraw()
    {

        try{
            $order_id   = input('order_id');
            if(empty($order_id))
                throw new Exception('参数错误');
            $order_info = \app\admin\model\Order::where(['status'=>11,'order_id'=>$order_id])->find();
            if(empty($order_info))
                throw new Exception('不存在该订单');
            $out_trade_no  = $order_info['order_sn'];
            $refund_amount = $order_info['order_price'];

            Db::startTrans();
            //支付宝退款
            if($order_info['pay_type'] == 1){
                $config      = $this->_get_config('ALI_PAY');
                vendor('alipay.AlipayTradeRefundContentBuilder');
                $refundRequestBuilder = new  \AlipayTradeRefundContentBuilder();
                $refundRequestBuilder->setOutTradeNo($out_trade_no);
                $refundRequestBuilder->setRefundAmount($refund_amount);

                $refundResponse = new AlipayTradeService($config);
                $result = $refundResponse->Refund($refundRequestBuilder);
                if($result->code != 10000)
                    throw new Exception('退款失败');
            }elseif($order_info['pay_type'] == 2){#微信
                $this->_setPayConfig($this->_get_config('WX_PAY'));
                $nonce_str = md5($out_trade_no.time());
                $input = new WxPayRefund();
                'appid,mch_id,nonce_str,sign';
                $input->SetAppid(APPID);
                $input->SetMch_id(MCHID);
                $input->SetNonce_str($nonce_str);
                $input->SetOut_trade_no($out_trade_no);
                $input->SetTotal_fee($refund_amount);
                $input->SetRefund_fee($refund_amount);
                WxPayApi::refund($input);

            }

            //修改订单状态
            \app\admin\model\Order::where('order_id',$order_id)->update(['status'=>12]);
            //添加操作记录
            $log_add = array(
                'member_id' => $order_info['member_id'],
                'order_id'  => $order_id,
                'hand_by'   => session('islogin'),
            );
            //订单操作记录
            Db::name('WithdrawLog')->insertGetId($log_add);
            //订单跟踪
            Db::name('order_tracking')->insertGetId(['order_id'=>$order_id,'mark'=>'订单退款完成']);

            Db::commit();
            Api()->setApi('url',input('location'))->ApiSuccess();
        }catch (\Exception $e){
            Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
        }

    }


    //查询支付配置
    private function _get_config($type ='WX_PAY'){
        $pay_config = model('config')->where(['config_mark'=>$type])->find()->toArray();
        $configs    = unserialize($pay_config['config_value']);
        $config     = array();
        foreach ($configs as $key => $value) {
            $config[$key] = $value['val'];
        }
        return $config;
    }

    //支付常量设置
    private function _setPayConfig($config){
        if(isset($config['mch_id'])){
            define('APPID',$config['app_id']);
            define('MCHID',$config['mch_id']);
            define('KEY',$config['key']);
            define('APPSECRET',$config['app_secret']);
        }
//        define('NOTIFY_URL', 'http://essj.baogt.com/mobile/pay/winxpay_notify');
//        define('SSLCERT_PATH','../cert/apiclient_cert.pem');
//        define('SSLKEY_PATH','../cert/apiclient_key.pem');
        define('CURL_PROXY_HOST',"0.0.0.0");
        define('CURL_PROXY_PORT',0);
        define('REPORT_LEVENL',1);
    }



}