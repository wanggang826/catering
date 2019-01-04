<?php
namespace app\api\controller;
use app\admin\model\CouponGet;
use app\admin\model\Member;
use app\admin\model\Opinion;
use app\admin\model\OpinionType;
use extend\UploadImg;
use think\Exception;
use think\File;

class FileUpload extends BaseApi{

    public function upload()
    {
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
            return json($this->returnData(['url'=>$url]));
        }catch (\Exception $e){
            return json($this->returnData([],404,$e->getMessage()));
        }
    }

}