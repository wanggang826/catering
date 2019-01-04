<?php

namespace app\admin\model;

use think\Db;
use think\Model;
// use think\Validate;
use traits\model\SoftDelete;

/**
 * 菜单模型类
 * @author huangwei
 * @version 2017/5/8
 */
class DiscountGoods extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    /**商品列表
     * @param $map
     * @return \think\Paginator
     */
    public function getGoodsList($map)
    {
        $pageSize = session('pageSize');
        if ($pageSize != input('pageSize') && !empty(input('pageSize'))) {
            session('pageSize', input('pageSize'));
            $pageSize = session('pageSize');
        }
        $res = $this->alias('a')->where($map)->join('goods g','a.goods_id = g.goods_id', 'LEFT')->field('a.*, g.goods_name,g.goods_price,g.goods_sn,g.goods_unit,g.cate_id')->order('a.create_time asc')->paginate($pageSize);
        foreach($res as $k=>$v){
            $res[$k]['cate_name'] =  Db::table('cy_category')->where('cate_id', $v['cate_id'])->value('name');
        }
        return $res;
    }


    /**添加商品
     * @param $data
     */
    public function addGoods($data)
    {
        if(!empty($data)){
            foreach($data as $k=>$v){
                $v['create_time'] = time();
                if(empty($v['discount'] || empty($v['discount_price']))){
                    continue;
                }
                $this->insert($v);
            }
            return true;
        }
        return false;
    }






}