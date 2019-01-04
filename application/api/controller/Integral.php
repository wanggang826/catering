<?php
namespace app\api\controller;


use app\admin\model\LottoSet;
use app\admin\model\Member;

class Integral extends BaseApi{

    private $integral;

    public function __construct()
    {
        parent::__construct();
        $this->integral = new \app\admin\model\Integral();
    }


    //我的积分
    public function my_integral()
    {
        if(request()->isGet()){
            if(empty($this->member_id))
                return json($this->returnData([],300));
            //抽奖优惠券
            $coupons = LottoSet::field('coupon_id,odds')->with('coupon')->select();
            //积分数
            $integrals = Member::where('id',$this->member_id)->value('integral');

            $return_data = array(
                'coupons'   => $coupons,
                'integrals' => $integrals,
            );
            return json($this->returnData($return_data));
        }
    }
    
    //积分抽奖
    public function lotto_integral()
    {
        if(request()->isPost()){
            if(empty($this->member_id))
                return json($this->returnData([],300));
            //抽奖
            $odds = LottoSet::column('odds');
            sort($odds);
            $new_array = array();
            dump($odds);die();
            //

        }
    }

    //积分记录
    public function integral_list()
    {
        if(request()->isGet()){
            if(empty($this->member_id))
                return json($this->returnData([],300));
            $integral_model = $this->integral;
            $data = input();
            if(isValue($data,'type')){
                if($data['type'] == 'all'){
                    $integral_model = $integral_model->where('type','in',[0,1]);
                }else{
                    $integral_model = $integral_model->where('type',$data['type']);
                }
            }
            if(isValue($data,'start_time') && isValue($data,'end_time')){
                $data['start_time'] =strtotime($data['start_time']);
                $data['end_time'] =strtotime($data['end_time']);
                $integral_model = $integral_model->where('create_time','between',[$data['start_time'],$data['end_time']]);
            }
            $integrals = $integral_model
                ->field('id,integral,type,integral_residue,create_time')
                ->where('member_id',$this->member_id)
                ->order('id desc')
                ->select();
            return json($this->returnData($integrals));
        }
    }


    function array_isum($input,$start,$num){
        $temp = array_slice($input, $start,$num);
        return array_sum($temp);
    }


}