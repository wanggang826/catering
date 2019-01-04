<?php

namespace app\admin\controller;

use think\Db;
use app\admin\model\Order;

/**
 * 待处理控制器
 * @author  huangwei
 * @version 2017/8/12
 */
class Waiting extends AdminBase
{

    /**
     * 排号列表
     */
    public function queuingList()
    {
        $map = ['status' => 0];  //条件
        if (input('sort_sn')) {
            $map['sort_sn'] = ['like','%'.input('sort_sn').'%'];
        }
        $list = model('queuing')->getList($map);
        $page = $list->render();
        return view('queuingList', compact('list', 'page'));
    }

    /**
     * 状态修改
     */
    public function changeStatus()
    {
        $table = input('table');
        $status = input('status');
        $id = input('id');
        $pk = input('pk');
        $url = input('location', url('queuingIndex'));
        $re = $this->setStatus($table, $status, $id, $pk);
        if ($re->code == 1) {
            Api()->setApi('url', $url)->ApiSuccess($re);
        } else {
            Api()->setApi('url', 0)->ApiError();
        }
    }

    /**
     * 堂吃订单列表
     */
    public function eatInOrder()
    {
        $map = ['a.type' => 0, 'a.status' => 0];  //类型：堂吃 状态：未完成
        $map1 = [];
        !empty(input('order_sn')) && $map['a.order_sn'] = ['like','%'.input('order_sn').'%'];
        !empty(input('username')) && $map1['c.username'] = ['like','%'.input('username').'%'];
        $list = model('order')->getList($map, $map1);
        $page = $list->render();
        return view('eatInOrder', compact('list', 'page'));
    }

    /**
     * 外卖订单列表
     */
    public function takeoutOrder()
    {
        $map = ['a.type' => 1];  //类型：外卖
        $map1 = [];
        $pageParam = [];   //分页条件数组
        if(input('status') != null){
            $map['a.status'] = input('status');
            $pageParam['status'] = input('status');
        }else{
            $map['a.status'] = ['in', [0, 1]];  //状态：待接单和待派送
        }
        !empty(input('order_sn')) && $map['a.order_sn'] = ['like','%'.input('order_sn').'%'];
        !empty(input('mobile')) && $map1['c.mobile'] = ['like', '%'.input('mobile').'%'];
        !empty(input('name')) && $map1['c.name'] = ['like', '%'.input('name').'%'];

        $start = input('start');
        $end = input('end');
        $pageParam['start'] = $start;
        $pageParam['end'] = $end;
        if (!empty($start) && !empty($end)) {
            $map['a.create_time'] = [['>=', strtotime($start)], ['<=', strtotime($end)]];
        }else{
            if (!empty($start)) {
                $map['a.create_time'] = ['>=', strtotime($start)];
            }
            if (!empty($end)) {
                $map['a.create_time'] = ['<=', strtotime('+1 day', strtotime(input('end')))];
            }
        }

        $list = model('order')->getList($map,$map1);
        $status = [0 => '待接单', 1 => '待派送'];
        $page = $list->appends($pageParam)->render();
        return view('takeoutOrder', compact('list', 'page', 'status'));
    }



    /**
     * 订单详情
     */
    public function orderDetail()
    {
        $order_id = input('order_id');
        $order = model('order')->orderDetail($order_id);
        $location = input('location', '');
        $url = url($location);
        $status = [0 => '未处理', 1 => '已处理'];
        return view('orderDetail', compact('order', 'url', 'status'));
    }


    //批量接单/配送
    public function batchOperation(){
        if(request()->isAjax()){
            $data = input();
            $ids = $data['id'];
            $change = "";
            foreach($ids as $k=>$v){
                $status = Db::table('cy_order')->where('order_id', $v)->value('status');
                if($status == 0){
                    $change = 1;
                    //订单跟踪
                    Db::name('order_tracking')->insertGetId(['order_id'=>$v,'mark'=>'商家接单']);
                }elseif($status == 1){
                    $change = 2;
                    //订单跟踪
                    Db::name('order_tracking')->insertGetId(['order_id'=>$v,'mark'=>'商家派送']);
                }
            }
            $re = $this->setStatus('order', $change, $ids, 'order_id');
            if ($re->code == 1) {
                Api()->setApi('url', url('takeoutOrder'))->ApiSuccess($re);
            } else {
                Api()->setApi('url', 0)->ApiError();
            }
        }
    }


    /**
     * 预定订单列表
     */
    public function  scheduleList()
    {
        $map = ['status' => 0];  //类型：预定未到时间
        $pageParam = [];   //分页条件数组

        !empty(input('order_sn')) && $map['order_sn'] = ['like', '%'.trim(input('order_sn')).'%'];
        !empty(input('mobile')) && $map['mobile'] = ['like', '%'.trim(input('mobile')).'%'];
        !empty(input('name')) && $map['name'] = ['like', '%'.trim(input('name')).'%'];
        $start = input('start');
        $end = input('end');
        $pageParam['start'] = $start;
        $pageParam['end'] = $end;
        if (!empty($start) && !empty($end)) {
            $map['time'] = [['>=', strtotime($start)], ['<=', strtotime($end)]];
        }else{
            if (!empty($start)) {
                $map['time'] = ['>=', strtotime($start)];
            }
            if (!empty($end)) {
                $map['time'] = ['<=', strtotime('+1 day', strtotime(input('end')))];
            }
        }

        $list = model('reserve')->getList($map);
        $page = $list->appends($pageParam)->render();
        return view('', compact('list', 'page'));
    }

}