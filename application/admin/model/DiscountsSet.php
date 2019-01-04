<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class DiscountsSet extends Model{
   use SoftDelete;

    //優惠
    public function total_discount($total_money,$type)
    {
        $discount_money = $this->where('type', $type)->where('over_money', 'elt', $total_money)->order('over_money desc')->value('discount_money');
        if (!empty($discount_money)){
            return $discount_money;
        }

        return $discount_money = 0;
    }

}