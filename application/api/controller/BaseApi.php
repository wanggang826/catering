<?php
namespace app\api\controller;
use extend\Sign;
use think\Controller;
use think\Request;
use think\Session;

/**
 *接口基础类
 *@author  wgg 
 *@version 2017/12/08
 */
class BaseApi extends controller{

    //不用登陆控制器
	private $all_action_login       = ['login','register','get_sid'];
	private $all_controller_login   = ['goods','index'];
	//必须加密控制器
    private $all_action_sign = [];
    private $return_code = [
                '300'  => '未登录或登录过期',
                '400'  => '操作失败',
            ];
    protected $member_id;


	public function __construct(){

        Session::init([
            'prefix'         => 'user',
            'type'           => '',
            'auto_start'     => false,//先关闭session
        ]);
        if (input('sid')) {
            session_id(input('sid'));
        }
        session_start();
        $this->member_id = session('member_id');
        $this->setApis();
        $this->islogin();
//        $this->checkApi();
	}
	//加密处理api访问
	final protected  function checkApi(){
        // $sign   = input('sign',0);
        $submit = input('submit',0);
        $code = config('web_api_encode');
        if(!$code)  $this->apiError('','秘钥不能为空');
        if ($submit !== md5($code)) {
            $this->apiError('','非法访问');
        }
        $act_name = strtolower(Request::instance()->action());
        if(!method_exists($this,$act_name)){
            $this->apiError('','接口错误');
        }

        if(in_array($act_name,$this->all_action_sign) && empty(input('sign'))){
            $this->apiError('','该接口需加密签名参数！签名为空');
        }
	}
	/**
     * 登录判断
     */
    final protected  function islogin(){
        $action_name        = strtolower(Request::instance()->action());
        $controller_name    = strtolower(Request::instance()->controller());
        if(!in_array($action_name, $this->all_action_login) && !in_array($controller_name,$this->all_controller_login)){
            if( empty($this->member_id) ) {
                return json($this->returnData([],300,'您还未登录或登录过期，请重新登录'));
            }
        }
    }
    /**
     * 设置登录超时，下线
     */
    final protected function overtime_downlogin($id,$logintime){
        $overtime = time() - $logintime;
        if( $overtime > config('overtime_downlogin') ) { //有限期 3 天
            model('loginlog')->edit_log(['id'=>$id,'delete_time'=>time(),'type'=>2]);
            session('cy_app_islogin',null);
            session('cy_app_user',[]); 
        }
    }
    /**
     * RSA 私钥加密
     * @param array $data 要加密的数据
     * @return 加密结果 
     */
    public function encrypted_private($data =array()){
        $sign = new Sign();
        return $sign->encrypted($data,'private',config('private_key'));
    }
    /**
     * RSA 公钥加密
     * @param array $data 要加密的数据
     * @return 加密结果 
     */
    public function encrypted_public($data =array()){
        $sign = new Sign();
        return $sign->encrypted($data,'public',config('public_key'));
    }

    /**
     * RSA 私钥解密
     * @return 解密数据
     */
    public function decrypted_private($data=''){
        $sign = new Sign();
        return $sign->decrypted($data,'private',config('private_key'));
    }

    /**
     * RSA 公钥解密
     * @return 解密数据
     */
    public function decrypted_public($data=''){
        $sign = new Sign();
        return $sign->decrypted($data,'public',config('public_key'));
    }

    /**
     * 设置允许跨域
     */
    final protected function setApis(){
        // 允许任意域名发起的跨域请求  
        header("Access-Control-Allow-Origin: *"); 
        header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With');
    }

   public function apiSuccess($data='',$msg='处理成功'){
        $outData = ['msg'=>$msg,'code'=>1,'data'=>$data];
        echo json_encode($outData);die;
   }
   public function apiError($data='',$msg='操作失败'){
        $outData = ['msg'=>$msg,'code'=>0,'data'=>$data];
        echo json_encode($outData);die;
   }

    public function returnData($data = [],$code = '', $msg = '')
    {
        $return_data = [
            'code' => empty($code) ? 500 : $code,
            'msg'  => empty($msg) ? '操作成功' : $msg,
            'data' => empty($data) ? [] : $data,
        ];
        if(!empty($msg)){
            $return_data['msg'] = $msg;
        }else if (isset($this->return_code[$code]) ) {
            $return_data['msg'] = $this->return_code[$code];
        }
        return $return_data;
    }
}