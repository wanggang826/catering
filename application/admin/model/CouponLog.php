<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class CouponLog extends Model{
    use SoftDelete;

    public function select_log($data,$where=array())
    {
        if(isValue($data,'start_time') && isValue($data,'end_time')){
            $data['start_time'] =strtotime($data['start_time']);
            $data['end_time'] =strtotime($data['end_time']);
            $where['CL.create_time']=['BETWEEN',[$data['start_time'],$data['end_time']]];
        }
        $query =$data;
        $list=$this->alias('CL')
            ->join('cy_member M ', 'CL.member_id = M.id')
            ->join('cy_coupon C ', 'CL.coupon_id = C.id')
            ->field('M.id,M.nickname,M.user_phone,CL.create_time,C.money,C.valid_start,C.valid_end')
            ->where($where)
            ->order('CL.create_time desc')
            ->paginate('',false,['query' => $query]);
        resultToArray($list);
        return $list;

    }

}