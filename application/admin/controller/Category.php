<?php
namespace app\admin\controller;
use think\Db;

/**
 * 商品控制器
 * @author  huangwei
 * @version 2017/8/12
 */
class Category extends AdminBase{

    protected $firstCate;
    public function __construct()
    {
        parent::__construct();
        $this->firstCate =  Db::table('cy_category')->where('pid', 0)->select();  //一级分类
    }

    /**
     * 商品类型列表
     */
    public function cateList()
    {
        $map = ['pid'=>['neq', 0]];  //筛选条件数组
        $pageParam = [];   //分页条件数组
        if(input('status') != null){
            $map['status'] = input('status');
            $pageParam['status'] = input('status');
        }
        !empty(input('pid')) && $map['pid'] = input('pid');

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

        $list = model('category')->getCateList($map);
        $firstCate = $this->firstCate;
        $page = $list->appends($pageParam)->render();
        return view('', compact('list', 'page', 'firstCate'));
    }

    /**
     * 添加分类
     */
    public function add(){
        if (request()->isPost()){
            $data =input();
            if(strlen($data['name']) > 4)
                Api()->setApi('msg','请输入四个字符的分类名称')->setApi('url',0)->ApiError();
            $res = model('category')->add($data);
            $data['create_time'] = time();
            if($res > 0){
                Api()->setApi('url',url('cateList'))->ApiSuccess($res);
            }else{
                Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
            }
        }else{
            $firstCate = $this->firstCate;
            return view('',compact('firstCate'));
        }
    }

    /**
     * 编辑分类
     */
    public function edit(){
        $data['cate_id'] = input('cate_id');
        if (request()->isPost()){
            $data =input();if(strlen($data['name']) > 4)
                Api()->setApi('msg','请输入四个字符的分类名称')->setApi('url',0)->ApiError();
            $res = model('category')->edit($data);
            if($res > 0){
                Api()->setApi('url',url('cateList'))->ApiSuccess($res);
            }else{
                Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
            }
        }else{
            $cate = db('category')->find($data['cate_id']);
            $firstCate = $this->firstCate;
            return view('', compact('cate', 'firstCate'));
        }
    }

    /**
     * 删除分类
     */
    public function del(){
        $cate_id = input('cate_id');
        $res = db('category')->delete($cate_id);
        if($res > 0){
            Api()->setApi('url',url('cateList'))->ApiSuccess($res);
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
        $id = input('cate_id');
        $re = $this->setStatus('category', $status, $id, 'cate_id');
        if ($re->code == 1) {
            Api()->setApi('url', url('cateList'))->ApiSuccess($re);
        } else {
            Api()->setApi('url', 0)->ApiError();
        }
    }

    /**
     * 批量删除分类
     */
    public function batchOperation(){
        //dump(input());die;
        $cate_id = input('id/a');
        $res = db('category')->delete($cate_id);
        if($res > 0){
            Api()->setApi('url',url('cateList'))->ApiSuccess($res);
        }else{
            Api()->setApi('msg',$res)->setApi('url',0)->ApiError();
        }
    }


}