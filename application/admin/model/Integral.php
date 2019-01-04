<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Integral extends Model{
    use SoftDelete;

    public function getTypeAttr($value)
    {
        $status = [0=>'评论',1=>'抽奖'];
        return $status[$value];
    }
}