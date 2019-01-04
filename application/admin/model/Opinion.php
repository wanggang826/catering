<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Opinion extends Model{
    use SoftDelete;

    public function select_opinion($data,$where=array()){
        if(isValue($data,'opinion_type_id')){
            $where['O.opinion_type_id'] =['eq',$data['opinion_type_id']];
        }
        if(isValue($data,'status')){
            $where['O.status'] =['eq',$data['status']];
        }
        if(isValue($data,'start_time') && isValue($data,'end_time')){
            $data['start_time'] =strtotime($data['start_time']);
            $data['end_time'] =strtotime($data['end_time']);
            $where['O.create_time']=['BETWEEN',[$data['start_time'],$data['end_time']]];
        }
        $query =$data;
        $list=$this->alias('O')
            ->join('cy_opinion_type OT ',' OT.id = O.opinion_type_id')
            ->join('cy_member M ', 'O.member_id = M.id')
            ->field('M.nickname,M.user_phone,OT.name,O.id,O.detail,O.status,O.create_time')
            ->where($where)
            ->order('O.id desc')
            ->paginate('',false,['query' => $query]);
        resultToArray($list);
        return $list;
    }

}