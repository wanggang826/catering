<?php
namespace app\admin\validate;
use think\Validate;

class Goods extends Validate{
    protected $rule = [
        ['goods_id'  , 'require','商品id不能为空'],
        ['goods_sn' ,'require','商品编码不能为空'],
        ['goods_name', 'require','商品名称不能为空'],
        ['goods_name', 'length:0,30','商品名称不能为超过30个字'],
        ['cate_id' ,'require','商品分类不能为空'],
        ['goods_unit' ,'require','计量单位不能为空'],
        ['goods_price' ,'require','商品价格不能为空'],
    ];

    protected $scene = [
        'add'   =>  ['goods_sn','cate_id','goods_name','goods_price','goods_unit'],
        'edit'	=>	['goods_id', 'goods_sn','cate_id','goods_name','goods_price','goods_unit'],
    ];




}