<?php
namespace app\api\controller;

use app\admin\model\Banner;
use app\admin\model\Comment;
use app\admin\model\Coupon;
use app\admin\model\DiscountGoods;
use app\admin\model\DiscountsSet;
use app\common\model\Config;
use think\Exception;

class Index extends BaseApi{


    //首页
    public function index()
    {
        if(request()->isGet()){
            //banners
            $banners = Banner::field('id,image')->where('status',1)->select();
            //满减活动
            $activities = DiscountsSet::field('id,over_money,discount_money')->where('type',1)->select();
            //餐厅信息
            $dining_info = Config::where('config_mark','DINING_SET')->value('config_value');
            $dining_info = unserialize($dining_info);
            //好评数
            $comment_model = new Comment();
            $good_rate = $comment_model->get_good_comment();

            $re_data = array(
                'banners'     => $banners,
                'activities'  => $activities,
                'dining_info' => $dining_info,
                'good_rate'   => $good_rate
            );
            return json($this->returnData($re_data));
        }
    }

    //活动
    public function activities()
    {
        if(request()->isGet()){
            //满减
            $discounts = DiscountsSet::field('id,over_money,discount_money')->where('type',1)->select();
            //新用户立减
            $new_user_dis = Config::where('config_mark','NEW_OFF')->value('config_value');
            //最大折扣值
            $max_discount = DiscountGoods::min('discount');
            //是否有优惠券信息
            $coupons = Coupon::where('valid_end','gt',time())->count();
            $has_coupon = 'N';
            if($coupons > 0){
                $has_coupon = 'Y';
            }
            //餐厅信息
            $dining_info = Config::where('config_mark','DINING_SET')->value('config_value');
            $dining_info = unserialize($dining_info);
            //餐厅名称
            $dining_name = $dining_info['dining_name'];
            //餐厅描述
            $dining_desc = $dining_info['dining_desc'];
            //好评数
            $comment_model = new Comment();
            $good_rate = $comment_model->get_good_comment();

            $return_data = array(
                'dining_name'       => $dining_name,
                'discounts'         => $discounts,
                'new_user_dis'      => $new_user_dis,
                'max_discount'      => $max_discount,
                'has_coupon'        => $has_coupon,
                'dining_desc'       => $dining_desc,
                'good_rate'         => $good_rate
            );
            return json($this->returnData($return_data));
        }
    }


}