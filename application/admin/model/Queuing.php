<?php
namespace app\admin\model;
use think\Model;
// use think\Validate;
use traits\model\SoftDelete;
/**
 * 菜单模型类
 * @author wanggang
 * @version 2017/5/8
 */
class Queuing extends Model{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段


    public function getList($map){
        $pageSize = session('pageSize');
        if ($pageSize < 5){
            $pageSize = 5;
        }
        if($pageSize!= input('pageSize') && !empty(input('pageSize'))){
            session('pageSize', input('pageSize'));
            $pageSize = session('pageSize');
        }
        $res = $this->where($map)->order('create_time asc')->paginate($pageSize);
        return $res;
    }



}