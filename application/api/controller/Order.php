<?php
/**
 * Created by PhpStorm.
 * User: tiway
 * Date: 2017/12/13
 * Time: 16:49
 */

namespace app\api\controller;


use app\admin\model\Comment;
use app\admin\model\CouponGet;
use app\admin\model\CouponLog;
use app\admin\model\DiscountsSet;
use app\admin\model\Member;
use app\admin\model\MemberAddress;
use app\admin\model\Queuing;
use app\common\model\Config;
use extend\UploadImg;
use think\Db;
use think\Exception;

class Order extends BaseApi
{
    private $order,$goods;

    public function __construct()
    {
        parent::__construct();
        $this->order = new \app\admin\model\Order();
        $this->goods = new \app\admin\model\Goods();
    }

    //排号
    public function waiting()
    {
        //当天凌晨时间戳，防止之前未过号
        $now_time = date('H',time());
        $time = time() - $now_time*3600;
        if(request()->isPost()){
            try{
                $num = input('num');
                if(empty($num))
                    throw new Exception('请选择就餐人数');

                if(empty($this->member_id))
                    return json($this->returnData([],'300','未登录'));
                //获得当前排队人数
                $counts = Queuing::where('create_time','egt',$time)->where('status',0)->count();
                //生成排号
                $sort_sn = 'W'.str_pad($counts,4,"0",STR_PAD_LEFT);
                //添加排号
                $model = new Queuing();
                $model->num = $num;
                $model->member_id  = $this->member_id;
                $model->before_num = $counts;
                $model->sort_sn = $sort_sn;
                $model->save();
                //返回
                $return_data = array(
                    'before_count'  => $counts,
                    'sort_sn'       => $sort_sn,
                    'num'           => $num,
                    'create_time'   => $model->create_time
                );

                return json($this->returnData($return_data,'500','预定成功'));

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
        //当前排号人数
        $counts = Queuing::where('create_time','egt',$time)->where('status',0)->count();
        return json($this->returnData(['counts'=>$counts]));
    }

    //我的排号详情
    public function waiting_detail()
    {
        if(request()->isGet()){
            $waiting_id = input('waiting_id');
            if(empty($waiting_id))
                return json($this->returnData([],404,'参数错误'));
            $waiting_info = Queuing::where('id',$waiting_id)->field('before_count,sort_sn,num,create_time')->find();
            return json($this->returnData($waiting_info));
        }
    }

    //排号列表
    public function waiting_list()
    {
        if(request()->isGet()){
            if(empty($this->member_id))
                return json($this->returnData([],'300','未登录'));
            //我的排号
            $list = Queuing::field('id,sort_sn,num,before_num,status,create_time')->where('member_id',$this->member_id)->select();

            return json($this->returnData($list));
        }
    }

    //排号删除
    public function waiting_del()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isPost()){
            $waiting_id = input('waiting_id');
            if(empty($waiting_id))
                return json($this->returnData([],404,'参数错误'));
            Queuing::where(['id'=>$waiting_id,'member_id'=>$this->member_id])->update(['delete_time'=>time()]);

            return json($this->returnData());
        }
    }

    //订单生成
    public function goods_order()
    {
        if(request()->isPost()){
            Db::startTrans();
            try{
                $data = input();

                if(empty($this->member_id))
                    return json($this->returnData([],300));
                if(!in_array($data['type'],[0,1]))
                    throw new Exception('参数错误');

                if(empty($data['order_common']) && empty($data['order_discount']))
                    throw new Exception('您还未点餐');

                //生成订单ID
                $order_id = $this->order->order_add($data['type']);
                //订单总额
                $order_total = 0;
                //总折扣金额
                $goods_discount = 0;
                //总的未折扣价钱
                $no_discount_total = 0;
                //折扣商品
                if(!empty($data['order_discount'])){
                    $discount_ids = array_column($data['order_discount'],'goods_id');
                    $goods_info = $this->goods->field('goods_id,goods_price')->with(['discount'=>function($query){
                        $query->where('status',1)->field('id,goods_id,discount_price');
                    }])->where('goods_id','in',$discount_ids)->select();

                    foreach ($data['order_discount'] as $key => $value){
                        if($goods_info[$key]->discount){#折扣商品
                            if($value['num'] > 1){#多个折扣
                                $discount_res = $this->order->many_discount_goods($goods_info[$key],$order_id,$value['num']);
                                if(!$discount_res)
                                    throw new Exception('订单信息添加失败');
                                $goods_discount += $discount_res['discount_money'];
                                $no_discount_total += $discount_res['no_discount_total'];
                                $order_total += $discount_res['order_total'];
                            }
                            if($value['num'] == 1){#单个折扣
                                $discount_res = $this->order->only_discount_goods($goods_info[$key],$order_id);
                                if(!$discount_res)
                                    throw new Exception('订单信息添加失败');
                                $goods_discount += $discount_res['discount_money'];
                                $order_total += $discount_res['order_total'];
                            }
                        }

                    }
                }

                if(!empty($data['order_common'])){
                    //非折扣商品
                    $normal_ids = array_column($data['order_common'],'goods_id');
                    $goods_info = $this->goods->field('goods_id,goods_price')->with(['discount'=>function($query){
                        $query->where('status',1)->field('id,goods_id');
                    }])->where('goods_id','in',$normal_ids)->select();

                    foreach ($data['order_common'] as $key => $value){
                        $discount_res = $this->order->no_discount_goods($goods_info[$key], $order_id, $value['num']);
                        if (!$discount_res)
                            throw new Exception('订单信息添加失败');
                        $no_discount_total += $discount_res['no_discount_total'];
                        $order_total += $discount_res['no_discount_total'];
                    }
                }

                //满减优惠金额
                $discount_set_model = new DiscountsSet();
                $over_discount = $discount_set_model->total_discount($no_discount_total,1);

                //修改订单
                $order_old = $this->order->find($order_id);
                $order_total = $order_total + $order_old['packaging_fee'] + $order_old['delivery_fee'] - $order_old['new_fee'] - $over_discount;
                $order_update = array(
                    'order_price'   => $order_total,
                    'over_fee'      => $over_discount,
                    'discount'      => $goods_discount,
                );
                $res = $this->order->where('order_id',$order_id)->update($order_update);
                if(!$res)
                    throw new Exception("订单信息添加失败");

                //订单跟踪
                Db::name('order_tracking')->insertGetId(['order_id'=>$order_id,'mark'=>'订单提交']);

                // 提交事务
                Db::commit();
                return json($this->returnData(['order_id'=>$order_id]));

            }catch (\Exception $e){
                // 回滚事务
                Db::rollback();
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }

    //确认订单页面信息
    public function order_confirm_view()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isGet()){
            //订单信息
            $order_id = input('order_id');
            if(empty($order_id))
                return json($this->returnData([],404,'参数错误'));
            //行用户折扣金额
            $new_member_discount = Config::where('config_mark','NEW_OFF')->value('config_value');
            $order_info = $this->order
                ->field('order_id,order_sn,order_price,packaging_fee,type,delivery_fee,new_fee,over_fee,discount,address_id')
                ->with([
                    'orderInfo'=>function($query){
                        $query->field('order_id,goods_id,goods_count,goods_price')->with(['goods'=>function($q){
                            $q->field('goods_id,goods_name,goods_thumb');
                        },
                        ]);
                    },
                    'memberAddress'=>function($query1){
                        $query1->with('province,city,area')->field('id,name,mobile,province,city,area,address');
                    }])->find($order_id);

            //默认地址
            $address_default = MemberAddress::where(['member_id'=>$this->member_id])->with('province,city,area')->order('is_default desc')->find();

            return json($this->returnData(['order_info'=>$order_info,'address_default'=>$address_default,'new_member_discount'=>$new_member_discount]));
        }
    }

    //确认订单提交
    public function order_confirm()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isPost()){
            $data = input();
            try{
                if(empty($data['order_id']))
                    throw new Exception('参数错误');
                if(empty($data['total_money']))
                    throw new Exception('参数错误');
                $order_info = $this->order->find($data['order_id']);
                if($order_info['type'] == 1){
                    if(empty($data['address_id']))
                        throw new Exception('请选择外卖收货地址');
                    $res = MemberAddress::where(['id'=>$data['address_id'],'member_id'=>$this->member_id])->find();
                    if(!$res)
                        throw new Exception('您选择的地址不存在');
                }

                //优惠券
                $coupon_money = 0;
                if(!empty($data['coupon_get_id'])){
                    //优惠券信息
                    $map = array(
                        'id'        => $data['coupon_get_id'],
                        'member_id' => $this->member_id,
                        'is_used'   => 'N'
                    );

                    $coupon_info = CouponGet::where($map)
                        ->field('id,coupon_id')
                        ->with(['coupon'=>function($query){
                            $query->field('id,money,valid_start,valid_end');
                        }])->find();
                    if(!$coupon_info)
                        throw new Exception('不存在该优惠券');

                    //优惠金额
                    $coupon_money = $coupon_info['coupon']['money'];
                }

                $total_order = $order_info['order_price'] - $coupon_money;
                $total_order = round($total_order,2);
                //金额验证
                if($data['total_money'] > $total_order + 0.01 || $data['total_money'] < $total_order - 0.01)
                    throw new Exception('金额计算不对，请联系管理员');
                //修改订单
                $order_info = \app\admin\model\Order::get($data['order_id']);
                $order_info -> order_price = $total_order;
                $order_info -> coupon = $coupon_money;
                $order_info -> coupon_get_id = $data['coupon_get_id'];
                $order_info -> address_id = empty($data['address_id']) ? 0 : $data['address_id'];
                $order_info -> seat_num = empty($data['seat_num']) ? 0 : $data['seat_num'];
                $order_info->save();

                //餐厅名称
                $re_data = array(
                    'order_id'      => $order_info->order_id,
                    'order_sn'      => $order_info->order_sn,
                    'total_money'   => $order_info->order_price,
                );

                return json($this->returnData($re_data));

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }

        }
    }

    //订单列表
    public function order_list()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isGet()){
            $order_type = input('order_type');
            if(empty($order_type))
                return json($this->returnData([],404,'参数错误'));
            if ($order_type == 'unfinished') {
                $order_info = $this->order->where(['type' => 1, 'member_id' => $this->member_id])->where('status', 'in', [0, 1, 2])
                    ->field('order_id,order_sn,order_price,create_time,type,status')
                    ->select();
            }
            if ($order_type == 'finished') {
                $order_info = $this->order->where(['type' => 0, 'member_id' => $this->member_id])->where('status', 'in', [0,1, 2])->whereOr(function ($query) {
                    $query->where(['type' => 1, 'member_id' => $this->member_id])->where('status', 'in', [3, 4]);
                })
                    ->field('order_id,order_sn,order_price,create_time,type,status')
                    ->select();
            }

            return json($this->returnData($order_info));
        }
    }

    //取消订单
    public function order_cancel()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isPost()){
            $order_id = input('order_id');
            //验证用户并修改订单状态
            $res = \app\admin\model\Order::where(['order_id'=>$order_id,'member_id'=>$this->member_id])->update(['status'=>11]);
            if(!$res)
                return json($this->returnData([],404,'取消订单失败'));

            //订单跟踪
            Db::name('order_tracking')->insertGetId(['order_id'=>$order_id,'mark'=>'订单已取消']);

            return json($this->returnData());
        }

    }

    //确认收货
    public function order_receive()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isPost()){
            try{
                $order_id = input('order_id');
                if(empty($order_id))
                    throw new Exception('参数错误');
                $type = $this->order->where('order_id',$order_id)->value('type');
                if(!in_array($type,[1,2]))
                    throw new Exception('参数错误');
                if($type == 0){
                    $res = $this->order->where(['order_id'=>$order_id,'member_id'=>$this->member_id])->update(['status'=>1]);
                }
                if($type == 1){
                    $res = $this->order->where(['order_id'=>$order_id,'member_id'=>$this->member_id])->update(['status'=>3]);
                }

                if(empty($res))
                    throw new Exception('操作失败');

                //订单跟踪
                Db::name('order_tracking')->insertGetId(['order_id'=>$order_id,'mark'=>'订单完成']);

                return json($this->returnData());
            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }

        }
    }

    //删除订单
    public function order_del()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isPost()){
            $order_id = input('order_id');
            $this->order->where('order_id',$order_id)->update(['delete_time'=>time()]);
            return json($this->returnData());
        }
    }

    //订单评论
    public function order_comment()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        $order_id = input('order_id');
        if(empty($order_id))
            return json($this->returnData([],404,'参数错误'));
        if(request()->isPost()){
            try{
                $goods_info = input();
                if(empty($goods_info['goods_info']))
                    throw new Exception('请提交评论内容');
                $add_data = array();
                $i = 0;
                foreach ($goods_info['goods_info'] as $key => $value){
                    if(empty($value['goods_id']))
                        throw new Exception('参数错误');
                    if(empty($value['score']))
                        throw new Exception('选择商品品论星级');
                    if(isset($value['images'])){
                        $img_arr = array();
                        foreach ($value['images'][0] as $k => $val){
                            $img_arr['uploadImg']['comment_img'][$k] = $val;
                        }
                        $year = date('Y/m',time());
                        //上传图片 返回图片名称 数组
                        $res  = UploadImg::upload("comment/$year",'time',$img_arr)->getMsg();
                        if(isset($res['info']['comment_img'])){
                            $comment_imgs = array();
                            foreach ($img_arr['uploadImg']['comment_img'] as $k => $v) {
                                $comment_imgs['com_img'.($k+1)] =  "/comment/".$year."/".$res['info']['comment_img'][$i];
                                $i++;
                            }
                        }
                        unset($value['images'][0]);
                    }
                    if(isset($value['img_str'])){
                        if(!empty($value['img_str'])){
                            foreach ($value['img_str'] as $k => $val){
                                $comment_imgs['com_img'.($k+1)] = $val;
                            }
                        }
                    }

                    //添加评论
                    $add_data[] = array(
                        'member_id' =>$this->member_id,
                        'goods_id'  => $value['goods_id'],
                        'order_id'  => $order_id,
                        'score'     => $value['score'],
                        'content'   => $value['content'],
                        'com_img1'  => isset($comment_imgs['com_img1'])? $comment_imgs['com_img1'] :'',
                        'com_img2'  => isset($comment_imgs['com_img2'])? $comment_imgs['com_img2'] :'',
                        'com_img3'  => isset($comment_imgs['com_img3'])? $comment_imgs['com_img3'] :'',
                        'com_img4'  => isset($comment_imgs['com_img4'])? $comment_imgs['com_img4'] :'',
                    );
                    unset($comment_imgs);
                    sleep(1);
                }
                //添加
                $comment_model = new Comment();
                $res = $comment_model->saveAll($add_data);
                if(empty($res))
                    throw new Exception('操作失败');

                //修改订单状态
                $type = $this->order->where('order_id',$order_id)->value('type');

                if($type == 0){
                    $this->order->where('order_id',$order_id)->update(['status'=>2]);
                }else if($type == 1){
                    $this->order->where('order_id',$order_id)->update(['status'=>4]);
                }

                //赠送积分
                $integrals_get = 0;

                //评论对应星星数
                $stars = Config::where('config_mark','COMMENT_STAR')->value('config_value');
                $stars = unserialize($stars);

                //评论获得积分
                $integrals = Config::where('config_mark','COMMENT_INTEGRAL')->value('config_value');
                $integrals = unserialize($integrals);

                foreach ($res as $value){
                    if($value['score'] >= $stars['good_comment']){
                        $integrals_get += $integrals['good_comment'];
                    }elseif ($value['score'] <= $stars['bad_comment']){
                        $integrals_get += $integrals['bad_comment'];
                    }else{
                        $integrals_get += $integrals['mid_comment'];
                    }
                }

                //添加用户积分
                Member::where('id',$this->member_id)->setInc('integral', $integrals_get);

                return json($this->returnData(['integral_get'=>$integrals_get]));
            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }

        }

        //评论商品
        $goods_info = $this->order
            ->field('order_id')
            ->with([
                'orderInfo'=>function($query){
                    $query->field('order_id,goods_id,goods_count,goods_price')->with(['goods'=>function($q){
                        $q->field('goods_id,goods_name,goods_thumb');
                    },
                    ]);
                },
            ])->find($order_id);

        return json($this->returnData($goods_info));
    }

    //订单详情
    public function order_detail()
    {
//        if(empty($this->member_id))
//            return json($this->returnData([],300));
        if(request()->isGet()){
            //订单信息
            $order_id = input('order_id');
            if(empty($order_id))
                return json($this->returnData([],404,'参数错误'));
            $order_info = $this->order
                ->field('order_id,order_sn,type,status,order_price,packaging_fee,delivery_fee,new_fee,over_fee,discount,coupon,address_id,create_time')
                ->with([
                    'orderInfo'=>function($query){
                        $query->field('order_id,goods_id,goods_count,goods_price')->with(['goods'=>function($q){
                            $q->field('goods_id,goods_name,goods_thumb');
                        },
                        ]);
                    },
                    'memberAddress'=>function($query1){
                        $query1->field('id,name,mobile,province,city,area,address')->with('province,city,area');
                    }])->find($order_id);

            //联系电话
            $dining_info = Config::where('config_mark','DINING_SET')->value('config_value');
            $dining_info = unserialize($dining_info);
            $connect_phone = $dining_info['phone'];

            $re_data = array(
                'order_info'    => $order_info,
                'connect_phone' => $connect_phone

            );

            return json($this->returnData($re_data));
        }
    }

    //优惠买单
    public function order_offline()
    {
        $discounts_set_model = new DiscountsSet();
        if(empty($this->member_id))
            throw new Exception([],300,'您还未登录');
        if(request()->isPost()){
            try{
                $money = input('money');
                $confirm_discount = input('discount_money');
                if(empty($money))
                    throw new Exception('请输入金额');
                $discount_money = $discounts_set_model->total_discount($money,0);
                dump($$discount_money);
                $pay_money = $money-$discount_money;

                if($confirm_discount != $pay_money )
                    throw new Exception('金额不匹配');
                $order_model = new \app\admin\model\Order();
                $order_model->member_id   = $this->member_id;
                $order_model->order_sn    = 'O'.date('YmdHis',time());
                $order_model->order_price = $pay_money;
                $order_model->type        = 0;
                $order_model->status      = 10;
                $order_model->save();
                $order_id = $order_model->order_id;
                $order_sn = $order_model->order_sn;

                return json($this->returnData(['order_id'=>$order_id,'order_sn'=>$order_sn,'total_money'=>$pay_money]));

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }

        //優惠優惠
        $discounts = $discounts_set_model->field('over_money,discount_money')->order('over_money desc')->where('type',0)->select();

        return json($this->returnData($discounts));
    }

    //订单跟踪
    public function order_tracking()
    {
        if(request()->isGet()){
            $order_id = input('order_id');
            //订单跟踪
            $list = Db::name('order_tracking')->order('id')->where('order_id',$order_id)->select();

            return json($this->returnData($list));
        }
    }


}