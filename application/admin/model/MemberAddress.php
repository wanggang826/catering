<?php
namespace app\admin\model;
use think\Model;

class MemberAddress extends Model{

    public function province()
    {
        return $this->hasOne('Areas','area_id','province')->field('area_id,area_name');
    }
    public function city()
    {
        return $this->hasOne('Areas','area_id','city')->field('area_id,area_name');
    }
    public function area()
    {
        return $this->hasOne('Areas','area_id','area')->field('area_id,area_name');
    }


}