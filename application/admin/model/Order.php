<?php

namespace app\admin\model;

use app\common\model\Config;
use think\Db;
use think\Model;
// use think\Validate;
use traits\model\SoftDelete;

/**
 * 菜单模型类
 * @author huangwei
 * @version 2017/5/8
 */
class Order extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段
    protected $table = 'cy_order';

    public function orderInfo()
    {
        return $this->hasMany('OrderInfo','order_id','order_id');
    }

    public function member()
    {
        return $this->belongsTo('Member','member_id','id');
    }

    public function memberAddress()
    {
        return $this->hasOne('MemberAddress','id','address_id');
    }

    public function getList($map, $map1=[])
    {
        $pageSize = session('pageSize');
        if ($pageSize != input('pageSize') && !empty(input('pageSize'))) {
            session('pageSize', input('pageSize'));
            $pageSize = session('pageSize');
        }
        if($map['a.type'] == 0){  //堂吃
            $res = $this->alias('a')->where($map)->where($map1)->join('cy_member c','a.member_id = c.id')->order('a.create_time asc')->paginate($pageSize);
        }else{
            $res = $this->alias('a')->where($map)->where($map1)->join('cy_member_address c','a.address_id = c.id')->order('a.create_time asc')->paginate($pageSize);
        }
        return $res;
    }

    public function orderDetail($order_id)
    {
        $res = $this->where(['order_id' => $order_id])->find()->toArray();
        $orderInfo = Db::table('cy_order_info')->where(['order_id' => $order_id])->select();
        foreach ($orderInfo as $k => $v) {
            $orderInfo[$k]['goods'] = Db::table('cy_goods')->where(['goods_id' => $v['goods_id']])->field('goods_sn, goods_name, goods_price, goods_unit')->find();
        }
        $res['memberAddress'] = Db::table('cy_member_address')->where('id', $res['address_id'])->find();
        $res['phone'] = Db::table('cy_member')->where('id', $res['member_id'])->value('user_phone');

        $res['orderInfo'] = $orderInfo;

        return $res;
    }
    
    //生成订单
    public function order_add($type)
    {
        if($type == 1){
            //打包费
            $packaging_fee = Db::name('config')->where('config_mark','PACK_FEE')->value('config_value');
            //配送费
            $delivery_fee = $this->has_delivery_fee();
        }else{
            $packaging_fee = 0;
            $delivery_fee  = 0;
        }

        //是否新用户免减
        $order_model = new Order();
        $order_model->member_id     = session('member_id');
        $order_model->order_sn      = get_order_sn();
        $order_model->type          = $type;
        $order_model->packaging_fee = $packaging_fee;
        $order_model->delivery_fee  = $delivery_fee;
        $order_model->new_fee       = $this->has_new_discount();
        $order_model->save();

        return $order_model->order_id;
    }

    //是否新用户免减
    public function has_new_discount()
    {
        $member_id = session('member_id');
        $discount_money = 0;
        if(!empty($member_id)){
            $counts = Order::where('member_id',$member_id)->count();
            if($counts == 0){
                $discount_money = Db::name('config')->where('config_mark','NEW_OFF')->value('config_value');
            }
        }
        return $discount_money;
    }
    
    //配送费
    public function has_delivery_fee()
    {
        $delivery_fee = Db::name('config')->where('config_mark','DELIVERY_FEE')->value('config_value');
        return $delivery_fee;
    }

    //单个折扣商品
    public function only_discount_goods($goods_info,$order_id)
    {
        //折扣金额
        $discount_money = $goods_info['goods_price'] - $goods_info['discount']['discount_price'];
        //商品总额
        $order_total = $goods_info['discount']['discount_price'];
        //添加order_info
        $order_info_model = new OrderInfo();
        $add_data = array(
            'order_id'      => $order_id,
            'goods_id'      => $goods_info['goods_id'],
            'goods_count'      => 1,
            'goods_price'      => $goods_info['goods_price'],
        );
        $res = $order_info_model->save($add_data);
        if($res)  return ['discount_money'=>$discount_money,'order_total'=>$order_total];

        return false;
    }

    //多个折扣商品
    public function many_discount_goods($goods_info,$order_id,$num)
    {
        //折扣金额
        $discount_money = $goods_info['goods_price'] - $goods_info['discount']['discount_price'];
        //未折扣金额
        $no_discount_total = $goods_info['goods_price'] * ($num-1);
        //商品总额
        $order_total = $goods_info['discount']['discount_price'] + $no_discount_total ;
        //添加order_info
        $order_info_model = new OrderInfo();
        $add_data = array(
            'order_id'      => $order_id,
            'goods_id'      => $goods_info['goods_id'],
            'goods_count'      => $num,
            'goods_price'      => $goods_info['goods_price'],
        );
        $res = $order_info_model->save($add_data);
        if($res)  return ['discount_money'=>$discount_money,'no_discount_total'=>$no_discount_total,'order_total'=>$order_total];

        return false;
    }

    //非折扣商品
    public function no_discount_goods($goods_info,$order_id,$num)
    {
        //未折扣金额
        $no_discount_total = $goods_info['goods_price'] * $num;
        //添加order_info
        $order_info_model = new OrderInfo();
        $add_data = array(
            'order_id'         => $order_id,
            'goods_id'         => $goods_info['goods_id'],
            'goods_count'      => $num,
            'goods_price'      => $goods_info['goods_price'],
        );
        $res = $order_info_model->save($add_data);
        if($res)  return ['no_discount_total'=>$no_discount_total];

        return false;
    }

    //支付宝退款
    public function ali_refund($order_info)
    {

    }


}