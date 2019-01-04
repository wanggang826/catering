<?php
namespace app\admin\model;
use think\Model;


class Areas extends Model{

    public function children()
    {
        return $this->hasMany('Areas','parent_id','area_id');
    }
}