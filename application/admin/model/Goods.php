<?php

namespace app\admin\model;

use think\Db;
use think\Model;
// use think\Validate;
use traits\model\SoftDelete;

/**
 * 菜单模型类
 * @author huangwei
 * @version 2017/5/8
 */
class Goods extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = [];//只读字段

    //关联折扣
    public function discount()
    {
        return $this->hasOne('DiscountGoods','goods_id','goods_id');
    }
    //关联评论
    public function comment()
    {
        return $this->hasMany('Comment','goods_id','goods_id');
    }

    /**商品列表
     * @param $map
     * @return \think\Paginator
     */
    public function getGoodsList($map)
    {
        $pageSize = session('pageSize');
        if ($pageSize != input('pageSize') && !empty(input('pageSize'))) {
            session('pageSize', input('pageSize'));
            $pageSize = session('pageSize');
        }

        $res = $this->alias('a')->where($map)->join('category c','a.cate_id = c.cate_id', 'LEFT')->field('a.*, c.name')->order('a.create_time asc')->paginate($pageSize);
        $excelData = $this->alias('a')->where($map)->join('category c','a.cate_id = c.cate_id', 'LEFT')->field('a.*, c.name')->order('a.create_time asc')->select();
        //设置导出excel的数据
        cache('excelData', $excelData, 3600);
        return $res;
    }


    /**添加商品
     * @param $data
     */
    public function addGoods($data)
    {
        if(!empty($data['uploadImg'])){
            $pic = [];
            if(!empty($data['uploadImg']['goods_thumb'])){
                $pic['goods_thumb'] = $data['uploadImg']['goods_thumb'][0];
                $thumb = $this->uploadImg($pic['goods_thumb']);
                if(isValue($thumb['imgUrl'])){
                    $pic['goods_thumb'] = $thumb['imgUrl'];
                }
            }
            if(!empty($data['uploadImg']['goods_thumb'])) {
                foreach ($data['uploadImg']['goods_img'] as $k => $v) {
                    $img = $this->uploadImg($v);
                    $pic["goods_img" . ($k + 1)] = $img['imgUrl'];
                }
            }
            unset($data['uploadImg']);
            $data = array_merge($data, $pic);
        }
        $res = $this->validate('Goods.add')->save($data);
        $goods_id  = $this->getLastInsID();
        if($res === false){
            return $this->getError();
        }else{
            $result['goods_id'] = $goods_id;
            $result['code'] = $res;
            return $result;
        }
    }


    /**编辑商品
     * @param $data
     */
    public function editGoods($data,$goods_id)
    {
        if(!empty($data['uploadImg'])){
            $goodsInfo = $this->find($goods_id);
            //dump($data);die;
            $pic = [];
            if(!empty($data['uploadImg']['goods_thumb'])){
                $pic['goods_thumb'] = $data['uploadImg']['goods_thumb'][0];
                $thumb = $this->uploadImg($pic['goods_thumb']);
                if(isValue($thumb['imgUrl'])){
                    $pic['goods_thumb'] = $thumb['imgUrl'];
                }
                //删除原来的封面
                !empty($goodsInfo['goods_thumb'])  && unlink(".".$goodsInfo['goods_thumb']);
            }
            if(!empty($data['uploadImg']['goods_img'])){
                foreach($data['uploadImg']['goods_img'] as $k=>$v){
                    $img = $this->uploadImg($v);
                    $pic["goods_img".($k+1)] = $img['imgUrl'];
                    //删除原来的图片
                    !empty($goodsInfo["goods_img".($k+1)]) && unlink(".".$goodsInfo["goods_img".($k+1)]);
                }
            }
            unset($data['uploadImg']);
            $data = array_merge($data, $pic);
        }
        $res = $this->validate('Goods.edit')->save($data, ['goods_id'=>$goods_id]);
        if($res === false){
            return $this->getError();
        }else{
            return $res;
        }
    }


    /**
     * base64图片上传
     */
    public function uploadImg($base64_img){
        if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
            $type = $result[2];
            if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){
                $path = '/upload/goods/'.date('Y',time()).'/'.date('m',time());
                $savepath = '.'.$path;
                if(!is_dir($savepath)){
                    mkdir($savepath,0777,true);
                }
                $savename = md5(time().getRandCode(2));
                $new_file = $savepath.'/'.$savename.'.'.$type;
                if(file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_img)))){
                    return array('code' => 1, 'msg' => "图片上传成功", 'imgUrl' => $path.'/'.$savename.'.'.$type);
                }
                return array('code' => 2, 'msg' => "图片上传失败");
            }
            //文件类型错误
            return array('code' => 4, 'msg' => "文件类型错误");
        }
        //文件错误
        return array('code' => 3, 'msg' => "文件错误");
    }

}