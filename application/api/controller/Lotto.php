<?php
namespace app\api\controller;
use app\admin\model\CouponGet;
use app\admin\model\LottoSet;
use app\admin\model\Member;
use app\admin\model\Opinion;
use app\admin\model\OpinionType;
use app\common\model\Config;
use extend\UploadImg;
use think\Exception;

class Lotto extends BaseApi{

    private $lotto_set,$config;

    public function __construct()
    {
        parent::__construct();
       $this->lotto_set = new LottoSet();
       $this->config = new Config();
    }

    public function lotto_view()
    {

        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isGet()){
            //抽奖一次消耗积分
            $integral_need = $this->config->where('config_mark','INTEGRAL_NEED')->value('config_value');
            //优惠券有效期
            $valid_time = $this->config->where('config_mark','VALID_TIME')->value('config_value');
            //用户积分
            $integrals = Member::where('id',$this->member_id)->value('integral');
            //奖品及概率
            $lotto = LottoSet::field('id,coupon_id,odds')->with('coupon')->select();
            //不中奖概率
            $wining = LottoSet::sum('odds');
            if($wining < 100){
                $not_wining = 100 - $wining;
            }else{
                $not_wining = 0;
            }

            $return_data = array(
                'integral_need'  => $integral_need,
                'valid_time'     => $valid_time,
                'integrals'      => $integrals,
                'lotto'          => $lotto,
                'not_wining'     => $not_wining,
//                'is_exist'       => 'Y',
            );
            return json($return_data);

        }
    }

    public function get_lotto()
    {
        if(request()->isPost()){
            try{
                if(empty($this->member_id))
                    throw new Exception('您还未登录，请重新登录');
                //抽奖一次消耗积分
                $integral_need = $this->config->where('config_mark','INTEGRAL_NEED')->value('config_value');
                $integral_total = Member::where('id',$this->member_id)->value('integral');
                if($integral_total < $integral_need)
                    throw new Exception('您的积分不足'.$integral_need);
                //优惠券有效期
                $valid_time = $this->config->where('config_mark','VALID_TIME')->value('config_value');

                //奖品及概率
                $lotto = LottoSet::field('id,coupon_id,odds')->order('odds')->with('coupon')->select();

                //随机数
                $rand_num = rand(0,10000);
                $dot_num = $rand_num/100;
                $left_dot = 0;
                if(!empty($lotto)){
                    foreach ($lotto as $key => $value){
                        $right_dot = $left_dot + $value['odds'];
                        if($dot_num <= $right_dot){
                            $lotto_info = $value;
                            break;
                        }
                        $left_dot = $right_dot;
                    }
                    if(!isset($lotto_info)){
                        //不中奖概率
                        $wining = LottoSet::sum('odds');
                        if($wining < 100){
                            $not_wining = 100 - $wining;
                        }
                        $lotto_info = ['id'=>0,'coupon_id'=>0,'odds'=>$not_wining];
                    }
                }


                //积分扣减
                Member::where('id',$this->member_id)->setDec('integral',$integral_need);
                //积分记录
                $integral_log = array(
                    'member_id' => $this->member_id,
                    'integral' => -$integral_need,
                    'type' => 1,
                    'integral_residue' => $integral_total- $integral_need,
                );
                $integral_model = new \app\admin\model\Integral();
                $integral_model->save($integral_log);

                if($lotto_info['id'] != 0){
                    //添加优惠券信息
                    $coupon_get = array(
                        'coupon_id'     => $lotto_info['coupon_id'],
                        'member_id'     => $this->member_id,
                        'valid_start'   => time(),
                        'valid_end'     => time() + $valid_time*86400
                    );
                    $coupon_get_model = new CouponGet();
                    $coupon_get_model->save($coupon_get);
                }

                return json($this->returnData($lotto_info));

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }


            return $lotto_info;
        }
    }


}