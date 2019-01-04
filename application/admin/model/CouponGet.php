<?php
namespace app\admin\model;

use think\Model;

class CouponGet extends Model{

    protected $type = [
        'create_time' => 'timestamp:Y-m-d',//转换时间戳
        'update_time'   =>  'timestamp:Y-m-d',//转换时间戳
    ];

    public function coupon()
    {
        return $this->belongsTo('coupon','coupon_id','id');
    }

    public function member()
    {

    }

}