<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Banner extends Model{
    use SoftDelete;

    public function select_banner($data,$where=array()){
        if(isValue($data,'status')){
            $where['status']=['eq',$data['status']];
        }
        if(isValue($data,'start_time') && isValue($data,'end_time')){
            $data['start_time'] =strtotime($data['start_time']);
            $data['end_time'] =strtotime($data['end_time']);
            $where['create_time']=['BETWEEN',[$data['start_time'],$data['end_time']]];
        }
        $query =$data;
        $list=$this->where($where)->order('id asc')->paginate('',false,['query' => $query]);
        resultToArray($list);
        return $list;
    }

}