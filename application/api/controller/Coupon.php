<?php
namespace app\api\controller;
use app\admin\model\CouponGet;
use think\Exception;

class Coupon extends BaseApi{

    private $coupon_get;

    public function __construct()
    {
        parent::__construct();
        $this->coupon_get = new CouponGet();
    }


}