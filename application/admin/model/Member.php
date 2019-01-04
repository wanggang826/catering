<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Member extends Model{
    use SoftDelete;

    public function get_user_sn()
    {
        return 'User_'.date('YmdHis',time()).'_'.rand(1000,9999);
    }

    public function CouponGet()
    {
        return $this->hasMany('CouponGet','member_id','id');
    }

    public function order()
    {
        return $this->hasMany('Order','member_id','id');
    }

    public function select_member($data,$where=array()){
        if(isValue($data,'nickname')){
            $where['nickname'] =['like','%'.(string)$data['nickname'].'%'];
        }
        if(isValue($data,'user_phone')){
            $where['user_phone']=['like','%'.(string)$data['user_phone'].'%'];
        }
        if(isValue($data,'sex')){
            $where['sex']=['eq',$data['sex']];
        }
        if(isValue($data,'start_time') && isValue($data,'end_time')){
            $data['start_time'] =strtotime($data['start_time']);
            $data['end_time'] =strtotime($data['end_time']);
            $where['create_time']=['BETWEEN',[$data['start_time'],$data['end_time']]];
        }
        $query =$data;
        $page_size = isset($data['pageSize']) ? $data['pageSize'] : '';
        $list=$this->where($where)->order('id asc')->paginate($page_size,false,['query' => $query]);
        resultToArray($list);
        return $list;
    }



}