<?php
namespace app\api\controller;
use app\admin\model\Member;
use app\admin\model\MemberAddress;
use think\Exception;

class Address extends BaseApi{

    private $member_address;

    public function __construct()
    {
        parent::__construct();
        $this->member_address = new MemberAddress();
    }

    //用户地址列表
    public function address_list()
    {
        if(request()->isGet()){
            if(empty($this->member_id))
                return json($this->returnData([],300));

            $addresses = $this->member_address->field('id,member_id,name,mobile,province,city,area,address,is_default')->with('province,city,area')->where('member_id',$this->member_id)->select();

            return json($this->returnData($addresses));
        }
    }

    //地址添加
    public function address_add()
    {
     if(request()->isPost()){
         try{
             if(empty($this->member_id))
                 return json($this->returnData([],300));
             $data = input();
             if(empty($data['name']))
                 throw new Exception('请填写收货人姓名');
             if(empty($data['mobile']))
                 throw new Exception('请填写联系电话');
             if(empty($data['province']) && is_numeric($data['province']))
                 throw new Exception('请选择省份');
             if(empty($data['city']) && is_numeric($data['province']))
                 throw new Exception('请选择市');
             if(empty($data['area']) && is_numeric($data['province']))
                 throw new Exception('请选择县');
             if(empty($data['address']))
                 throw new Exception('请填写详细地址');

             //修改用户地址全部为非默认的
             if($data['is_default'] == 1)
                 $this->change_default();
             $add_data = array(
                 'name'      => $data['name'],
                 'member_id' => $this->member_id,
                 'mobile'    => $data['mobile'],
                 'province'  => $data['province'],
                 'city'      => $data['city'],
                 'area'      => $data['area'],
                 'address'   => $data['address'],
                 'is_default'=> $data['is_default'],
             );

             $this->member_address->save($add_data);

             return json($this->returnData());
         }catch (\Exception $e){
             return json($this->returnData([],404,$e->getMessage()));
         }
     }
    }

    //地址编辑
    public function address_edit()
    {
        if(request()->isPost()){
            try{
                if(empty($this->member_id))
                    return json($this->returnData([],300));
                $data = input();
                if(empty($data['address_id']))
                    throw new Exception('参数错误');
                if(empty($data['name']))
                    throw new Exception('请填写收货人姓名');
                if(empty($data['mobile']))
                    throw new Exception('请填写联系电话');
                if(empty($data['province']))
                    throw new Exception('请选择省份');
                if(empty($data['city']))
                    throw new Exception('请选择市');
                if(empty($data['area']))
                    throw new Exception('请选择县');
                if(empty($data['address']))
                    throw new Exception('请填写详细地址');

                //修改用户地址全部为非默认的
                if($data['is_default'] == 1)
                    $this->change_default();
                $update_data = array(
                    'name'      => $data['name'],
                    'mobile'    => $data['mobile'],
                    'province'  => $data['province'],
                    'city'      => $data['city'],
                    'area'      => $data['area'],
                    'address'   => $data['address'],
                    'is_default'=> $data['is_default'],
                );

                $this->member_address->where('id',$data['address_id'])->update($update_data);

                return json($this->returnData());
            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }

        }
        $address_id = input('address_id');
        $address = $this->member_address->field('id,member_id,name,mobile,province,city,area,address,is_default')->with('province,city,area')->find($address_id);
        return json($this->returnData($address));

    }

    //设置默认地址
    public function set_default_addr()
    {
        if(request()->isPost()){
            if(empty($this->member_id))
                return json($this->returnData([],300));
            $address_id = input('address_id');
            if(empty($address_id))
                return json($this->returnData([],'404','参数错误'));
            //该用户所有地址变为非默认
            $this->change_default();
            $this->member_address->where('id',$address_id)->update(['is_default'=>1]);
            return json($this->returnData());
        }
    }

    //删除用户地址
    public function address_del()
    {
        if(request()->isPost()){
            if(empty($this->member_id))
                return json($this->returnData([],300));
            $address_id = input('address_id');
            $this->member_address->where('id',$address_id)->delete();
            return json($this->returnData());
        }
    }

    //修改用户所有的地址为非默认
    public function change_default()
    {
       return $this->member_address->where('member_id',$this->member_id)->update(['is_default'=>0]);
    }
    
    //订单地址选择
    public function order_address()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isPost()){
            $order_id = input('order_id');
            $address_id = input('address_id');
            if(empty($order_id) || empty($address_id))
                return json($this->returnData([],404,'参数错误'));

            \app\admin\model\Order::where(['order_id'=>$order_id])->update(['address_id'=>$address_id]);

            return json($this->returnData());
        }
    }


}