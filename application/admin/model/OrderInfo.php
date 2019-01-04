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
class OrderInfo extends Model
{
    use SoftDelete;

    public function goods()
    {
        return $this->hasOne('Goods','goods_id','goods_id');
    }


}