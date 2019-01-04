<?php
namespace app\api\controller;

use app\admin\model\Member;
use app\common\model\Config;
use think\Exception;

class Reserve extends BaseApi{

    private $reserve,$config;

    public function __construct()
    {
        parent::__construct();
        $this->reserve = new \app\admin\model\Reserve();
        $this->config = new Config();
    }

    //预定定页面
    public function reserve_view()
    {
        if(request()->isGet()){
            if(empty($this->member_id))
                return json($this->returnData([],'300','未登录'));
            //日期
            $max_day = Config::where('config_mark','DAY_SET')->value('config_value');
            $date = array();
            $day = ['周日','周一','周二','周三','周四','周五','周六'];
            $time = time();
            for($i=0;$i < $max_day;$i++){
                $new_time = $time + $i*3600*24;
                $date[$i]['date'] = date('Y-m-d',$new_time);
                $day_i = date("w",$new_time);
                $date[$i]['day'] = $day[$day_i];
            }
            //预约时间区间
            $room_info = $this->config->where('group','room')->order('id')->column('config_value');
            $time_info = unserialize($room_info[2]);
            $reserve_time = array(
                'begin_time'    => $time_info['begin_hour'].':'.str_pad($time_info['begin_min'], 2, "0", STR_PAD_LEFT),
                'end_time'      => $time_info['end_hour'].':'.str_pad($time_info['end_min'], 2, "0", STR_PAD_LEFT),
            );
            //包间人数
            $people_num = unserialize($room_info[0]);
            $per_room_num = array(
                'max_room'  => $people_num['room_max'],
                'min_room'  => $people_num['room_min'],
            );
            //手机号码
            $mobile = Member::where('id',$this->member_id)->value('user_phone');

            $return_data = array(
                'date'      => $date,
                'reserve_time' => $reserve_time,
                'per_room_num' => $per_room_num,
                'mobile'       => $mobile
            );

            return json($this->returnData($return_data));

        }
    }

    //预定
    public function reserve()
    {
        if(request()->isPost()){

            try{
                if(empty($this->member_id))
                    return json($this->returnData([],'300','未登录'));
                $data = input();
                if(preg_match ("/^(d{4})-(d{2})-(d{2})$/s", $data['date']))
                    throw new Exception('请输入正确日期');
                if(preg_match("/^d{2}:d{2}$/s",$data['time']))
                    throw new Exception('选择正确的时间');
                if(!preg_match("/^1[34578]\d{9}$/",$data['mobile']))
                    throw new Exception('请输入正确手机号码');
                $time = $data['date'].' '.$data['time'];
                if(strtotime($time) < time())
                    throw new Exception('选择的预定时间不能是过去时间');
                if(empty($data['num']))
                    throw new Exception('请选择就餐人数');
                if($data['num'] < 8 && $data['is_room'] == 'Y')
                    throw new Exception('就餐人数要至少8人才能预定包间');
                if(empty($data['name']))
                    throw new Exception('请输入预定人姓名');
                if(empty($data['sex']))
                    throw new Exception('请选择性别');

                //添加预定
                $reserve_model = $this->reserve;
                $reserve_model->member_id = $this->member_id;
                $reserve_model->order_sn = get_order_sn();
                $reserve_model->num  = $data['num'];
                $reserve_model->is_room  = $data['is_room'];
                $reserve_model->time = strtotime($time);
                $reserve_model->name = $data['name'];
                $reserve_model->sex = $data['sex'];
                $reserve_model->mobile = $data['mobile'];
                $reserve_model->des = $data['des'];
                $reserve_model->save();
                $reserve_id = $reserve_model->id;
                if(empty($reserve_id))
                    throw new Exception('预定失败');
                $order_sn = $reserve_model->order_sn;
                $create_time = $reserve_model->create_time;
                $return_data = array(
                    'order_sn'  => $order_sn,
                    'create'    => $create_time,
                );

                return json($this->returnData($return_data,'500','预定成功'));

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }

    //我的预定
    public function my_reserve()
    {
        if(request()->isGet()){
            if(empty($this->member_id))
                return json($this->returnData([],300));
            $reserves = $this->reserve->field('id,order_sn,num,time,create_time,status')->where('member_id',$this->member_id)->select();

            return json($this->returnData($reserves));
        }
    }

    //删除预定
    public function reserve_del()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isPost()){
            $reserve_id = input('reserve_id');
            if(empty($reserve_id))
                return json($this->returnData([],404,'参数错误'));
            $this->reserve->where(['id'=>$reserve_id,'member_id'=>$this->member_id])->update(['delete_time'=>time()]);

            return json($this->returnData());
        }
    }

    //预定详情
    public function reserve_detail()
    {
        if(request()->isGet()){
            $id = input('id');
            if(empty($this->member_id))
                return json($this->returnData([],300));
            if(empty($id))
                return json($this->returnData([],404,'参数错误'));
            //预定详情
            $detail = $this->reserve->find($id);
            return json($this->returnData($detail));
        }
    }

    //取消预约
    public function reserve_cancel()
    {
        if(request()->isPost()){
            try{
                $reserve_id = input('reserve_id');
                if(empty($this->member_id))
                    return json($this->returnData([],300));
                $status = $this->reserve->where('id',$reserve_id)->value('status');
                if($status != '0')
                    throw new Exception('您的预约订单不是待赴约');
                //修改预约订单状态
                $this->reserve->where('id',$reserve_id)->update(['status'=>3]);

                return json($this->returnData([],'500','取消预订预定成功'));

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }


}