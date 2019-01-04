<?php
namespace app\admin\controller;

use think\Db;
use app\admin\model\Category;

/**
 * 商品控制器
 * @author  huangwei
 * @version 2017/8/12
 */
class DiscountGoods extends AdminBase{
    private $cate;

    public function _initialize()
    {
        parent::_initialize();
        $cateModel = new Category();
        $this->cate = $cateModel->getCateData();
    }

    /**
     * 商品列表
     */
    public function discountList()
    {
        $map = [];  //筛选条件数组
        $pageParam = [];   //分页条件数组
        if(input('status') != null){
            $map['status'] = input('status');
            $pageParam['status'] = input('status');
        }
        !empty(input('cate_id')) && $map['g.cate_id'] = input('cate_id');
        !empty(input('discount')) && $map['a.discount'] = input('discount');
        !empty(input('goods_name')) && $map['goods_name'] = ['like', "%".input('goods_name')."%"];
        $start = input('start');
        $end = input('end');
        $pageParam['start'] = $start;
        $pageParam['end'] = $end;

        if (!empty($start) && !empty($end)) {
            $map['a.create_time'] = [['>=', strtotime($start)], ['<=', strtotime('+1 day', strtotime(input('end')))]];
        }else{
            if (!empty($start)) {
                $map['a.create_time'] = ['>=', strtotime($start)];
            }
            if (!empty($end)) {
                $map['a.create_time'] = ['<=', strtotime('+1 day', strtotime(input('end')))];
            }
        }
        $list = model('discountGoods')->getGoodsList($map);

        $cate = $this->cate;
        $page = $list->appends($pageParam)->render();
        return view('goods/discountList', compact('list', 'page', 'cate'));
    }

    /**
     * 添加折扣商品
     */
    public function add(){
        if (request()->isPost()){
            $data =input();
            $res = model('DiscountGoods')->addGoods($data);
            $data['create_time'] = time();
            if($res > 0){
                Api()->setApi('url',url('discountList'))->ApiSuccess($res);
            }else{
                Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
            }
        }else{
            return view('',compact('discountList', 'goodsList'));
        }
    }


    /**
     * 获得可以选择的商品来设置折扣
     */
    public function discountChoice(){
        $map = [];
        !empty(input('goods_name')) && $map['goods_name'] = input('goods_name');
        $ids = [];
        $discountList = Db::table('cy_discount_goods')->select();
        foreach ($discountList as $k=>$v){
            $ids[] = $v['goods_id'];
        }
        $map['goods_id'] = ['not in' , $ids];
        //查找没在折扣中的商品用来添加
        $goodsList = Db::table('cy_goods')->where($map)->select();
        return view('goods/discountChoice',compact('goodsList'));
    }

    /**
     * ajax新增折扣商品
     */
    public function makeDiscount(){
        $data = input('checkData/a');
        if(!empty($data)){
            //维维数组去重
            $data = array_unique_fb($data);
            $res = model('DiscountGoods')->addGoods($data);
            if($res){
                return ['code'=>1, 'msg'=> '添加成功'];
            }else{
                return ['code'=>-1, 'msg'=> '添加失败'];
            }
        }else{
            return ['code'=>-1, 'msg'=> '请选择数据'];
        }

    }


    /**
     * 编辑商品
     */
    public function edit(){
        $goods_id = input('goods_id');
        if (request()->isPost()){
            $data =input();
            $res = Db::table('cy_discount_goods')->where('goods_id', $data['goods_id'])->update($data);
            if($res > 0){
                Api()->setApi('url',url('discountList'))->ApiSuccess($res);
            }else{
                Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
            }
        }else{
            $discount = Db::table('cy_discount_goods')->where('goods_id', $goods_id)->find();
            $goods = Db::table('cy_goods')->where('goods_id', $goods_id)->field('goods_sn,goods_name,goods_price')->find();
            $goods = array_merge($discount, $goods);
            return view('goods/discountEdit', compact('goods'));
        }
    }

    /**
     * 删除商品
     */
    public function del(){
        $goods_id = input('goods_id');
        $res = db('discountgoods')->where('goods_id', $goods_id)->setField('delete_time', time());
        if($res > 0){
            Api()->setApi('url',url('discountList'))->ApiSuccess($res);
        }else{
            Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
        }
    }

    /**
     * 状态修改
     */
    public function changeStatus()
    {
        $status = input('status');
        $id = input('goods_id');
        $re = $this->setStatus('discount_goods', $status, $id, 'goods_id');
        if ($re->code == 1) {
            Api()->setApi('url', url('discountList'))->ApiSuccess($re);
        } else {
            Api()->setApi('url', 0)->ApiError();
        }
    }

    /**
     * 批量删除商品
     */
    public function batchOperation(){
        $goods_id = input('id/a');
        foreach($goods_id as $k=>$v){
            $res =  db('discount_goods')->where('goods_id', $v)->setField('delete_time', time());
        }
        if($res > 0){
            Api()->setApi('url',url('discountList'))->ApiSuccess($res);
        }else{
            Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
        }

    }
}