<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Reserve extends Model{
    use SoftDelete;

    protected $type = [
        'time' => 'timestamp:Y-m-d H:i',//转换时间戳
    ];

    public function select_reserve($data,$where=array())
    {
        if (isValue($data, 'order_sn')) {
            $where['order_sn'] = ['like','%'.(string)$data['order_sn'].'%'];
        }
        if (isValue($data, 'status')) {
            $where['status'] = ['eq', $data['status']];
        }
        $query = $data;
        $list = $this->where($where)->order('create_time desc')->paginate('', false, ['query' => $query]);
        resultToArray($list);
        return $list;

    }

    /** 待处理预约
     * @param $map
     * @return \think\Paginator
     */
    public function getList($map)
    {
        $pageSize = session('pageSize');
        if ($pageSize != input('pageSize') && !empty(input('pageSize'))) {
            session('pageSize', input('pageSize'));
            $pageSize = session('pageSize');
        }
        $res = $this->where($map)->order('create_time asc')->paginate($pageSize);
        //dump($res);die;
        return $res;
    }


}