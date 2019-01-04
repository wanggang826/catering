<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;
/**
 * 用户组模型
 * @author 
 * @version wanggang 2017/5/12
 */
class Article extends Model{
    use SoftDelete;

    public function select_article($data,$where=array()){
        if(isValue($data,'title')){
            $where['title'] =['like','%'.(string)$data['title'].'%'];
        }
        if(isValue($data,'start_time') && isValue($data,'end_time')){
            $data['start_time'] =strtotime($data['start_time']);
            $data['end_time'] =strtotime($data['end_time']);
            $where['create_time']=['BETWEEN',[$data['start_time'],$data['end_time']]];
        }
        $query =$data;
        $page_size = isset($data['pageSize']) ? $data['pageSize'] : '';
        $list=$this->where($where)->order('article_id asc')->paginate($page_size,false,['query' => $query]);
        resultToArray($list);
        return $list;
    }

}