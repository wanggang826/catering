<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Coupon extends Model{
    use SoftDelete;
    protected $type = [
        'valid_start' => 'timestamp:Y-m-d',//转换时间戳
        'valid_end'   =>  'timestamp:Y-m-d',//转换时间戳
    ];

    public function couponGet()
    {
        return $this->hasMany('CouponGet','coupon_id','id');
    }

    public function select_coupon($data,$where=array()){
        if(isValue($data,'valid_start_time') && isValue($data,'valid_end_time')){
            $data['valid_start_time'] =strtotime($data['valid_start_time']);
            $data['valid_end_time'] =strtotime($data['valid_end_time']);
            $where['valid_end']=['BETWEEN',[$data['valid_start_time'],$data['valid_end_time']]];
        }

        if(isValue($data,'start_time') && isValue($data,'end_time')){
            $data['start_time'] =strtotime($data['start_time']);
            $data['end_time'] =strtotime($data['end_time']);
            $where['create_time']=['BETWEEN',[$data['start_time'],$data['end_time']]];
        }
        $query =$data;
        $list=$this->where($where)->order('create_time desc')->paginate('',false,['query' => $query]);
        resultToArray($list);
        return $list;
    }



}