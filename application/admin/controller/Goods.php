<?php
namespace app\admin\controller;

use think\Db;
use app\admin\model\Category;

/**
 * 商品控制器
 * @author  huangwei
 * @version 2017/8/12
 */
class Goods extends AdminBase{
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
    public function goodsList()
    {
        $map = [];  //筛选条件数组
        $pageParam = [];   //分页条件数组
        if(input('is_sale') != null){
            $map['is_sale'] = input('is_sale');
            $pageParam['is_sale'] = input('is_sale');
        }
        !empty(input('cate_id')) && $map['a.cate_id'] = input('cate_id');
        !empty(input('goods_name')) && $map['goods_name'] = ['like', "%".input('goods_name')."%"];
        $start = input('start');
        $end = input('end');
        $pageParam['start'] = $start;
        $pageParam['end'] = $end;
        if (!empty($start) && !empty($end)) {
            $map['create_time'] = [['>=', strtotime($start)], ['<=', strtotime($end)]];
        }else{
            if (!empty($start)) {
                $map['create_time'] = ['>=', strtotime($start)];
            }
            if (!empty($end)) {
                $map['create_time'] = ['<=', strtotime('+1 day', strtotime(input('end')))];
            }
        }

        $list = model('goods')->getGoodsList($map);
        $cate = $this->cate;
        $page = $list->appends($pageParam)->render();
        return view('', compact('list', 'page', 'cate'));
    }

    /**
     * 添加商品
     */
    public function add(){
        if (request()->isPost()){
            $data =input();
            $res = model('goods')->addGoods($data);
            $data['create_time'] = time();
            if($res > 0){
                Api()->setApi('url',url('goodsList'))->ApiSuccess($res);
            }else{
                Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
            }
        }else{
            $cate = $this->cate;
            $code = time().getRandom(6);//;
            return view('',compact('cate', 'code'));
        }
    }

    /**
     * 编辑商品
     */
    public function edit(){
        $goods_id = input('goods_id');
        if (request()->isPost()){
            $data =input();
            $res = model('goods')->editGoods($data,$goods_id);
            if($res > 0){
                Api()->setApi('url',url('goodsList'))->ApiSuccess($res);
            }else{
                Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
            }
        }else{
            $goods = Db::table('cy_goods')->find($goods_id);
            $cate = $this->cate;
            //dump($goods);die;
            return view('', compact('cate', 'goods'));
        }
    }

    /**
     * 删除商品
     */
    public function del(){
        $goods_id = input('goods_id');
        $res = db('goods')->where('goods_id', $goods_id)->setField('delete_time', time());
        if($res > 0){
            Api()->setApi('url',url('goodsList'))->ApiSuccess($res);
        }else{
            Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
        }
    }

    /**
     * 状态修改
     */
    public function changeStatus()
    {
        $status = input('is_sale');
        $id = input('goods_id');
        $re = $this->setStatus('goods', $status, $id, 'goods_id', 'is_sale');
        if ($re->code == 1) {
            Api()->setApi('url', url('goodsList'))->ApiSuccess($re);
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
           $res =  db('goods')->where('goods_id', $v)->setField('delete_time', time());
        }
        if($res > 0){
            Api()->setApi('url',url('goodsList'))->ApiSuccess($res);
        }else{
            Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
        }

    }

    /**
     * 导出数据
     */
    public function toExcel(){
        $res = cache('excelData');
        $newDate = [];
        foreach ($res as $k=>$v){
            $res[$k]['is_sale'] = ($v['is_sale'] == 1 ? '上架': '下架');
            $newDate[] = [
                '商品编码'	=> $v['goods_sn'],
                '商品名称'	=> $v['goods_name'],
                '价格'		=> $v['goods_price'],
                '类型'		=> $v['name'],
                '计量单位'	=> $v['goods_unit'],
                '创建时间'	=>  date("Y-m-d H:i:s", (int)$v['create_time']),
            ];
        }
        $title = '菜单';
        $fieldName = array_keys($newDate[0]);
        $res = $newDate;
        $this->push($res,$fieldName,$title);
    }
}