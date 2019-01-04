<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class LottoSet extends Model{
    use SoftDelete;

    public function coupon()
    {
        return $this->hasMany('Coupon','id','coupon_id')->field('id,money');
    }

}