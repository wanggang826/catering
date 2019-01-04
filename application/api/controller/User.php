<?php
namespace app\api\controller;
use app\admin\model\CouponGet;
use app\admin\model\Member;
use app\admin\model\Opinion;
use app\admin\model\OpinionType;
use extend\UploadImg;
use think\Exception;

class User extends BaseApi{

    private $member;

    public function __construct()
    {
        parent::__construct();
        $this->member = new Member();
    }

    public function get_sid()
    {
        $sid = session_id();
        return json($this->returnData(['sid'=>$sid]));
    }


    //登录
    public function login()
    {
        if(request()->isPost()){
            try{
                $data = input();
                if(empty($data['type']))
                    throw new Exception('参数错误');
                //普通登录
                if($data['type'] == 'common'){
                    $member_info = $this->member->where('nickname|user_phone','eq',$data['nickname'])->find();
                    if(empty($member_info))
                        throw new Exception('用户名不存在');
                    $password = config('member_key').$data['password'];
                    if($member_info['password'] != md5(md5($password)))
                        throw new Exception('用户或密码错误');
                }
                //手机验证登录
                if($data['type'] == 'phone'){
                    if(!preg_match("/^1[34578]\d{9}$/", $data['user_phone']))
                        throw new Exception('请填写正确的手机号码');
                    $member_info = $this->member->where('user_phone',$data['user_phone'])->find();
                    if(empty($member_info))
                        throw new Exception('该手机号码还未注册');
                    if(empty($data['code']))
                        throw new Exception('请输入验证码');
                    //验证码验证
                    $res = $this->_check_code($data['user_phone'],$data['code']);
                    if(!$res['status'])
                        throw new Exception($res['msg']);

                }
                //保存用户信息
                session('member_id',$member_info['id']);
                return json($this->returnData([],'500','登录成功'));

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }

    //注册
    public function register()
    {
        if(request()->isPost()){
            try{
                $data = input();
                $user_phone = $data['user_phone'];
                if(!preg_match("/^1[34578]\d{9}$/", $user_phone))
                    throw new Exception('请填写正确的手机号码');
                if(!preg_match("/^1[34578]\d{9}$/", $user_phone))
                    throw new Exception('请填写正确的手机号码');
                if(!preg_match("/^[a-zA-Z\d_]{6,12}$/", $data['password']))
                    throw new Exception('请输入6位以上字母下划线的字符串作为密码');
                //验证是否已经注册
                $is_exist = $this->member->where('user_phone',$data['user_phone'])->find();
                if(!empty($is_exist))
                    throw new Exception('该用户已存在');
                //验证码验证
                $code_info = session('smscode');
                if($code_info['mobile'] != $user_phone)
                    throw new Exception('手机号码不匹配');
                if(empty($data['code']))
                    throw new Exception('请输入验证码');
                //验证码验证
                $res = $this->_check_code($data['user_phone'],$data['code']);
                session('smscode',null);
                if(!$res['status'])
                    throw new Exception($res['msg']);
                //添加用户
                $this->member->user_sn     = $this->member->get_user_sn();
                $this->member->nickname    = '游客'.rand(10000,99999);
                $this->member->password    = md5(md5(config('member_key').$data['password']));
                $this->member->user_phone  = $data['user_phone'];
                $this->member->save();
                $member_id = $this->member->id;
                //session
                session('member_id',$member_id);
                if(!$member_id)
                    throw new Exception('注册失败');

                //返回
                return json($this->returnData());

            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }

    //修改密码
    public function password_change()
    {
        if(request()->isPost()){
            try{
                $data = input();
                if(!preg_match("/^1[34578]\d{9}$/", $data['user_phone']))
                    throw new Exception('请填写正确的手机号码');
                if(!preg_match("/^[a-zA-Z\d_]{6,}$/", $data['password']))
                    throw new Exception('请输入6位以上字母下划线的字符串作为密码');
                if(empty($data['code']))
                    throw new Exception('请输入验证码');
                //验证手机号码是否已经注册
                $member_info = $this->member->where(['user_phone'=>$data['user_phone']])->find();
                if(empty($member_info))
                    throw new Exception('您的手机号码还未注册');
                //验证码验证
                $code_info = session('smscode');
                if($code_info['mobile'] != $data['user_phone'])
                    throw new Exception('手机号码不匹配');
                if(empty($data['code']))
                    throw new Exception('请输入验证码');
                //验证码验证
                $res = $this->_check_code($data['user_phone'],$data['code']);
                session('smscode',null);
                if(!$res['status'])
                    throw new Exception($res['msg']);
                //修改密码
                $password = md5(md5(config('member_key').$data['password']));
                $res = $this->member->where('user_phone',$data['user_phone'])->update(['password'=>$password]);
                if(empty($res))
                    throw new Exception('操作失败');

                //返回
                return json($this->returnData());
            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }

    //个人信息修改
    public function personal_update()
    {
        if(request()->isPost()){
            try{
                $data = input();
                if(empty($this->member_id))
                    return json($this->returnData([],300));
                //修改头像
                if(isset($data['image'])){
                    if(empty($data['image']))
                        throw new Exception('请上传个人图片');
                    $img_arr = array();
                    $img_arr['uploadImg']['user_img'][] = $data['image'];
                    $year = date('Y/m',time());
                    //上传图片 返回图片名称 数组
                    $res  = UploadImg::upload("user/$year",'time',$img_arr)->getMsg();
                    $user_img = "/user/".$year."/".$res['info']['user_img'][0];
                    unset($data['image']);
                    //更新
                    $re = $this->member->where('id',$this->member_id)->update(['image'=>$user_img]);
                    if(empty($re))
                        throw new Exception('操作失败');
                }
                //修改昵称
                if(isset($data['nickname'])){
                    if(empty($data['nickname']))
                        throw new Exception('请填写昵称');
                    $this->member->where('id',$this->member_id)->update(['nickname'=>$data['nickname']]);
                }
                //修改性别
                if(isset($data['sex'])){
                    if(empty($data['sex']))
                        throw new Exception('请选择性别');
                    $this->member->where('id',$this->member_id)->update(['sex'=>$data['sex']]);

                }

                return json($this->returnData());
            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }

    //小程序头像修改
    public function personal_image()
    {
        if(request()->isPost()){
            try{
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'upload' . DS . 'wx_upload');
                $max_size = config('upload_rule.size');
                if(!$file->checkSize($max_size))
                    throw new Exception('请输入小于'.$max_size.'的图片');
                if(!$file->checkExt(config('upload_rule.ext')))
                    throw new Exception('请上传常规图片格式');
                if(!$file->checkImg())
                    throw new Exception('图片不合法');
                $url = '/wx_upload/'.$info->getSaveName();
                $this->member->where('id',$this->member_id)->update(['image'=>$url]);
                return json($this->returnData());
            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }

    //个人资料
    public function personal()
    {
        if(request()->isGet()){
            if(empty($this->member_id))
                return json($this->returnData([],300));
            //个人信息
            $personal = $this->member->field('nickname,user_phone,sex,image')->find($this->member_id);
            return json($this->returnData($personal));
        }
    }
    
    //意见反馈页面信息
    public function advice_view()
    {
        if(request()->isGet()){
            if(empty($this->member_id))
                return json($this->returnData([],300));
            //意见类型
            $types = OpinionType::field('id,name')->select();

            return json($this->returnData(['types'=>$types]));
        }
    }

    //意见反馈
    public function advice_get()
    {
        if(request()->isPost()){
            try{
                $data = input();
//                dump($data);die();
                if(empty($this->member_id))
                    return json($this->returnData([],300));
                if(empty($data['type_id']))
                    throw new Exception('请选择意见反馈类型');
                if(empty($data['detail']))
                    throw new Exception('请输入意见详情');
                $images = '';
                if(isset($data['images'])){
                    $img_arr = array();
                    foreach ($data['images'] as $key => $value){
                        $img_arr['uploadImg']['advice'][$key] = $value;
                    }
                    $year = date('Y/m',time());
                    //上传图片 返回图片名称 数组
                    $res  = UploadImg::upload("advice/$year",'time',$img_arr)->getMsg();
                    if(isset($res['info']['advice'])){
                        $advice_images = array();
                        foreach ($res['info']['advice'] as $k => $v) {
                            $advice_images['advice'.($k+1)] =  "/advice/".$year."/".$v;
                        }
                        $images = serialize($advice_images);
                    }
                    unset($data['images']);
                }

                if(isset($data['img_str'])){
                    if(!empty($data['img_str'])){
                        foreach ($data['img_str'] as $k => $val){
                            $advice_images['advice'.($k+1)] = $val;
                        }
                    }
                    $images = serialize($advice_images);
                }

                $add_data = array(
                    'member_id'     => $this->member_id,
                    'opinion_type_id'     => $data['type_id'],
                    'detail'     => $data['detail'],
                    'images'     => $images,
                );
                $opinion_model = new Opinion();
                $opinion_model->save($add_data);

                return json($this->returnData());
            }catch (\Exception $e){
                return json($this->returnData([],404,$e->getMessage()));
            }
        }
    }

    //验证验证码
    private function _check_code($mobile,$code)
    {
        $res = [
            'status'  => true,
            'msg'      => '',
        ];
        $code_info = session('smscode');
        if($mobile != $code_info['mobile']){
            $res['msg'] = '手机号码不匹配';
        }

        if($code != $code_info['code']){
            $res['msg'] = '验证码错误，请重新获取短信验证码';
        }

        return $res;


    }

    //我的优惠券列表
    public function my_coupon()
    {
        if (empty($this->member_id))
            return json($this->returnData([], 300));
        if (request()->isGet()) {
            $coupons = CouponGet::where('member_id',$this->member_id)->with(['coupon' => function ($query) {
                $query->field('id,money');
            }])
                ->order('valid_end desc')
                ->order('is_used')
                ->field('id,coupon_id,member_id,is_used,valid_start,valid_end')
                ->select();

            return json($this->returnData($coupons));
       }
    }

    //我的
    public function user_index()
    {
        $member_id = $this->member_id;
        if(empty($member_id))
            return json($this->returnData([],300));
        if(request()->isGet()){
            $member_info = $this->member->where('id',$member_id)->field('id,nickname,sex,image,integral')
                ->with(['couponGet'=>function($query)use($member_id){
                    $query->where('member_id',$member_id)->where('is_used','N')->where('valid_end','egt',time())->field('member_id,count(id) as total');
                }])->find();
        }
        return json($this->returnData($member_info));
    }

    //退出
    public function user_logout()
    {
        $member_id = $this->member_id;
        if(empty($member_id))
            return json($this->returnData([],300));
        session('member_id',null);

        return json($this->returnData());
    }


}