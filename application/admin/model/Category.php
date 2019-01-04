<?php

namespace app\admin\model;

use think\Db;
use think\Model;
// use think\Validate;
use traits\model\SoftDelete;

/**
 * 分类模型类
 * @author huangwei
 * @version 2017/5/8
 */
class Category extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    public function childrenCate()
    {
        return $this->hasMany('Category','pid','cate_id');
    }

    public function goods()
    {
        return $this->hasMany('Goods','cate_id','cate_id');
    }


    public function getCateList($map)
    {
        $pageSize = session('pageSize');
        if ($pageSize != input('pageSize') && !empty(input('pageSize'))) {
            session('pageSize', input('pageSize'));
            $pageSize = session('pageSize');
        }
        $res = $this->where($map)->order('create_time asc')->paginate($pageSize);
        foreach($res as $k=>$v){
            $parent = $this->where('cate_id', $v['pid'])->value('name');
            $res[$k]['parent'] = $parent;
        }
        return $res;
    }


    public function add($data){
        $result = $this->save($data);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    public function edit($data){
        $result = $this->save($data, ['cate_id'=>$data['cate_id']]);
        if($result === false){
            return $this->getError();
        }else{
            return $result;
        }
    }

    /**无限极分类
     * @return array
     */
    public function getCateData(){
        $cate = Db::table('cy_category')->select();
        $res = $this->getCateTree($cate);
        return $res;
    }

//    /*
//    * 根据父id归类排序
//    */
//    public function getCateTree($cate, $pid = 0)
//    {
//        $tree = [];
//        foreach ($cate as $k => &$v) {
//            if ($v['pid'] == $pid) {
//                if($v['pid'] !== 0){
//                    $v['name'] = '|-----'.$v['name'];
//                }
//                $tree[] = $v;
//                $tree = array_merge($tree, $this->getCateTree($cate, $v['cate_id']));
//            }
//        }
//        return $tree;
//    }


    /*
   * 根据父id归类排序
   */
    public function getCateTree($cate, $pid = 0)
    {
        $tree = [];
        $num = 0;
        $prefix = [0 => 0];
        foreach ($cate as $k => $v) {
            if ($v['pid'] == $pid) {
                $tree[] = $v;
                $tree = array_merge($tree, $this->getCateTree($cate, $v['cate_id']));
            }
        }

        while ($val = current($tree)) {
            $key = key($tree);
            if ($key > 0) {
                if ($tree[$key - 1]['pid'] != $val['pid']) {
                    $num++;
                }
            }
            if (array_key_exists($val['pid'], $prefix)) {
                $num = $prefix[$val['pid']];
            }
            $val['name'] = str_repeat('|-----', $num) . $val['name'];
            $prefix[$val['pid']] = $num;
            $tree[$key] = $val;
            next($tree);  //指针移动到下一个元素
        }
        return $tree;
    }

}