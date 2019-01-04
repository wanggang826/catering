<?php
ob_end_clean();
header("Content-type:text/html;charset=utf-8");

use think\Image;
use think\File;
use think\Loader;
use think\Request;
use think\Config;
use think\Session;

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function resultToArray(&$results)
{
    foreach ($results as &$result) {
        $result = $result->getData();
    }
}

function getTree($data, $options = [], $level = 0)
{
    return new \extend\Tree($data, $options, $level);
}

function Api($type = '', $setApi = false)
{
    $app_debug = config('app_debug');
    $api = new \app\common\controller\Api($app_debug);
    return $api->setType($type, $setApi);
}

/**
 * 判断值是否为空
 */
function isValue($data, $key = false)
{
    if ($key !== false) {
        if (!is_array($data)) return false;
        if (!array_key_exists($key, $data)) return false;
        $v = $data[$key];
    } else {
        $v = $data;
    }
    if ($v === 0 || $v === '0') return true;
    if ($v != '') return true;
    if (is_array($v) && $v != []) return true;
    return false;
}

function getNamebyPk($model, $pk_name, $getField, $pk_value)
{
    return model($model)->where([$pk_name => $pk_value])->value($getField);
}

/**
 * 获取图片用于显示
 */
function getImg($imgName, $isUrl = false)
{
    if ($isUrl) {
        $url = $imgName;
    } else {
        $url = config('STATIC_URL') . '/upload/' . $imgName;
        $url_t = ROOT_PATH . 'public/upload/' . $imgName;
    }
    if (!is_file($url_t)) {
        $url = config('static_url') . '/upload/' . config('default_img');
        $url_t = ROOT_PATH . 'public/upload/' . config('default_img');
        $url = is_file($url_t) ? $url : config('static_url') . '/static/img/default1.png';
    }
    return $url;
}

/*
 * 图片没了则显示默认一张
 */
function defaultImg($file)
{
    $url = is_file("." . $file) ? $file : '/public/static/img/default1.png';
    return $url;
}

/**
 * 获取附件
 */
function getFile($fileName, $isUrl = false)
{
    if ($isUrl) {
        $url = $fileName;
    } else {
        $url = config('STATIC_URL') . '/public/upload/enclosure/' . $fileName;
        $url_t = ROOT_PATH . 'public/upload/enclosure/' . $fileName;
    }
    if (!is_file($url_t)) {
        $url = config('static_url') . '/upload/' . config('default_img');
        $url_t = ROOT_PATH . 'public/upload/' . config('default_img');
        $url = is_file($url_t) ? $url : config('static_url') . '/static/img/default1.png';
    }
    return $url;
}

function get_login_user_name()
{
    return session('user.nickname') ?: session('user.account');
}

function get_login_admin_group()
{
    $group = session('user.group');
    if (!$group) {
        return;
    }
    $name = model('auth_group')->where(['group_id' => $group])->value('group_name');
    return $name;
}

function buildRandomString($type = 1, $length = 4)
{
    if ($type == 1) {
        $chars = join("", range(0, 9));
    } elseif ($type == 2) {
        $chars = join("", array_merge(range("a", "z"), range("A", "Z")));
    } elseif ($type == 3) {
        $chars = join("", array_merge(range("a", "z"), range("A", "Z"), range(0, 9)));
    }
    $chars = str_shuffle($chars);
    return substr($chars, 0, $length);
}

/* $name  string    为type="file"的input框的name值
 * $file string     存在图片的文件夹 (文件夹必须在upload之下)
 * return  string   返回图片的文件夹和名字
 * */
function upload_headimg($name, $file)
{
    $up_dir = "./upload/$file";
    if (!file_exists($up_dir)) {
        mkdir($up_dir, 0777, true);
    }
    $image = Image::open(request()->file($name));//打开上传图片
    $size = input('avatar_data');//裁剪后的尺寸和坐标
    $size_arr = json_decode($size, true);
    $type = substr($_FILES [$name]['name'], strrpos($_FILES [$name]['name'], '.') + 1);
    $name = time() . "." . $type;
    $info = $image->crop($size_arr['width'], $size_arr['height'], $size_arr['x'], $size_arr['y'])->save("./upload/$file/$name");
    if ($info) {
        return $file . "/" . $name;
    } else {
        return false;
    }
}

//上传文件
function upload_file($fileName = '', $type = 'image', $path = '')
{
    if ($type == 'file') {
        $path = $path ? $path : config("ENC_PATH");
    } else {
        $path = $path ? $path : config("IMG_PATH");
        $config['exts'] = 'jpg,gif,png,jpeg';
    }
    $config = config("upload");
    $config['rootPath'] = config("UPLOAD_ROOT_PATH");
    $config['savePath'] = $path;
    $uploader = new \org\Upload($config);
    $info = $uploader->upload();
    if (!$info) {
        echo $uploader->getError();
    } else {
        $data = current($info);
        $data['file_path'] = $config['rootPath'] . $data['savepath'] . $data['savename'];
        return $data;
    }
}


function delete_file($path = '', $name = '', $type = 'image')
{
    if (empty($path)) {
        if ($type == 'file') {
            $path = config("ENC_PATH") . $name;
        } else {
            $path = config("IMG_PATH") . $name;
        }
    }
    if (!file_exists($path)) {
        return "文件不存在";
        //return true;
    } else {
        return unlink($path);
    }
}

//状态文字描述
function text_status($status)
{
    $state = '';
    $status == 1 ? $state = '启用' : $state = '禁用';
    return $state;
}

//通过交易号查order_id
function getOrderIdBy_transactionId($tansactionId)
{

}

//通过咖啡机编号查询device_id
function getOrderIdBy_deviceCode($device_code)
{

}

//生成唯一订单sn
function get_order_sn()
{
    return 'Order_'.date('YmdHis');
}


/**
 * thikphp5 已删除C/D/U/M/W/I等函数
 * 重写单字母函数C/D/U/M/W/I
 * by chick 2017-05-02
 */
function C($name = '', $value = null, $range = '')
{
    return config($name, $value, $range);
}

function D($name = '', $layer = 'model', $appendSuffix = false)
{
    return model($name, $layer, $appendSuffix);
}

function M($name = '', $config = [], $force = true)
{
    return db($name, $config, $force);
}

function U($url = '', $vars = '', $suffix = true, $domain = false)
{
    return url($url, $vars, $suffix, $domain);
}

function W($name, $data = [])
{
    return widget($name, $data);
}

function I($key = '', $default = null, $filter = '')
{
    return input($key, $default, $filter);
}

/*通过log_id查询操作人账户*/
function getAccount($log_id)
{
    $admin_id = model('log')->where("log_id = {$log_id}")->value('admin_id');
    $account = model('admin')->where("admin_id = {$admin_id}")->value('account');
    return $account;
}


//随机字符串和数字组合
function getRandom($param)
{
    $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $key = "";
    for ($i = 0; $i < $param; $i++) {
        $key .= $str[mt_rand(0, 61)];    //生成php随机数和字母的组合
    }
    return $key;
}

//随机数字
function getRandCode($param)
{
    $str = "0123456789";
    $key = "";
    for ($i = 0; $i < $param; $i++) {
        $key .= $str[mt_rand(0, 9)];    //生成php随机数和字母的组合
    }
    return $key;
}


//设置分页参数

function setPageParam($list_rows)
{
    config(['paginate' => ['type' => 'bootstrap', 'list_rows' => $list_rows, 'var_page' => 'page']]);
    Session::set('pageSize', config('paginate.list_rows'));
}

//将路径转为文件名为键值的路径
function fileNamePath($path)
{
    if ($path) {
        $key = basename($path);
        $data[$key] = $path;
        return $data;
    }
}

//获取数据字典中字段html
function diction_option($encoding, $selected = '', $type = "select")
{
    $data = model("dictionarys")->where("di_encoding='{$encoding}'")->field("di_name,option_value")->find()->toArray();
    if ($data) {
        $option_value = unserialize($data['option_value']);
        $html = '';
        if ($type == "select") {
            $html = "<option value='' selected='selected'>请选择" . $data['di_name'] . "</option>";
        }
        foreach ($option_value as $k => $v) {
            if (!empty($selected)) {
                if ($k == $selected) {
                    if ($type == "select") {
                        $html .= "<option value='" . $k . "' selected='selected'>" . $v . "</option>";
                    } elseif ($type == "radio") {
                        $html .= "<label class=\"i-lab\"><input type=\"radio\" name=\"" . $encoding . "\" value=\"" . $k . "\" class=\"mgr mgr-primary\" checked><span>" . $v . "</span></label>";
                    }
                    continue;
                }
            }
            if ($type == "select") {
                $html .= "<option value='" . $k . "'>" . $v . "</option>";
            } elseif ($type == "radio") {
                $html .= "<label class=\"i-lab\"><input type=\"radio\" name=\"" . $encoding . "\" value=\"" . $k . "\" class=\"mgr mgr-primary\"><span>" . $v . "</span></label>";
            }
        }
        return $html;
    } else {
        return false;
    }
}

function get_diction($encoding)
{
    $data = model("dictionarys")->where("di_encoding='{$encoding}'")->field("di_name,option_value")->find()->toArray();
    if ($data) {
        $option_value = unserialize($data['option_value']);
        return $option_value;
    } else {
        return false;
    }
}


/**
 * 发送短信
 * @param  [string] $tel     手机号
 * @param  [type] $content   短信内容
 * @return [type]            发送状态
 */
function sendMessage($tel, $content)
{
    $url = "http://www.ztsms.cn/sendSms.do";//提交地址
    $username = 'liesunsmszh';//用户名
    $password = 'Liesun666';//原密码
    vendor('sendAPI.sendAPI');
    $sendAPI = new \sendAPI($url, $username, $password);
    $data = array(
        'content' => $content . '【掌赢通】',//短信内容
        'mobile' => $tel,//手机号码
        'productid' => '676767',//产品id
        'xh' => ''//小号
    );
    $sendAPI->data = $data;//初始化数据包
    $return = $sendAPI->sendSMS('POST');//GET or POST

    return $return;
}


//性别文字描述
function text_sex($status)
{
    $state = '';
    switch ($status) {
        case 1:
            $state = '男';
            break;
        case 2:
            $state = '女';
            break;
        default:
            $state = '未知';
            break;
    }
    return $state;
}


//获取文件后缀
function get_extension($file)
{
    return substr(strrchr($file, '.'), 1);
}

function logger($content)
{
    $logSize = 100000;
    $log = "wechat_log.txt";
    if (file_exists($log) && filesize($log) > $logSize) {
        unlink($log);
    }
    file_put_contents($log, date('H:i:s') . " " . $content . "\n", FILE_APPEND);
}

/*
     * 结构化排序好的数据
     */
function setPrefix($data, $p = "|------")
{
    $tree = [];
    $num = 1;
    $prefix = [0 => 1];
    while ($val = current($data)) {
        $key = key($data);
        if ($key > 0) {
            if ($data[$key - 1]['pid'] != $val['pid']) {
                $num++;
            }
        }
        if (array_key_exists($val['pid'], $prefix)) {
            $num = $prefix[$val['pid']];
        }
        $val['title'] = str_repeat($p, $num) . $val['title'];
        $prefix[$val['pid']] = $num;
        $tree[] = $val;
        next($data);  //指针移动到下一个元素
    }
    return $tree;
}


//二维数组去掉重复值(保存键名)
function array_unique_fb($array2D)
{
    $temp =[];
    $res = [];
    $key = array_keys($array2D[0]);
    foreach ($array2D as $k=>$v) {
        $v = implode(',', $v); //降维,也可以用join,将一维数组转换为用逗号连接的字符串
        $temp[] = $v;
    }
    $temp = array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
    foreach ($temp as $k => $v) {
        $v =  explode(',', $v); //再将拆开的数组重新组装
        foreach($v as $k1=>$v2){
            $res[$k][$key[$k1]] = $v2;
        }
    }
    return $res;
}

/**
 * 辅助函数array_isum，计算数组中i起n个数的和
 * @params $input array,要计算的数组
 * @params $start,int,起始位置
 * @params $num,int,个数
 * @return int
 */
function array_isum($input,$start,$num){
    $temp = array_slice($input, $start,$num);
    return array_sum($temp);
}
