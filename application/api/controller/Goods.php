<?php
/**
 * Created by PhpStorm.
 * User: tiway
 * Date: 2017/12/13
 * Time: 16:49
 */

namespace app\api\controller;

use app\admin\model\Areas;
use app\admin\model\Category;
use app\admin\model\Comment;
use app\admin\model\DiscountsSet;

class Goods extends BaseApi
{
    private $category,$goods,$per_page,$page;

    public function __construct()
    {
        parent::__construct();
        $this->category = new Category();
        $this->goods = new \app\admin\model\Goods();
        //每页条数
        $this->per_page = input('per_page','10');
        //第几页，默认第一页
        $this->page  = input('page','1');
    }

    //外卖/堂吃商品列表
    public function goods_index()
    {
        if(request()->isGet()){
            //商品类型
            $categories = $this->category
                ->field('cate_id,name,pid,unit')
                ->with(['childrenCate'=>function($query){
                    $query->field('cate_id,name,pid,unit')->order('sort desc');
                }])
                ->where('status',1)
                ->where('pid',0)
                ->order('sort desc')
                ->select();
            //满减活动
            $discounts = DiscountsSet::where('type',1)
                ->field('id,over_money,discount_money')
                ->select();
            //商品列表
            $goods = $this->goods
                ->field('goods_id,goods_name,saled_num,goods_price,goods_unit,goods_thumb')
                ->where('is_sale',1)
                ->where('is_discount','N')
                ->order('saled_num')
//                ->limit($this->per_page)
//                ->page($this->page)
                ->select();
            $return_data = array(
                'categories'    => $categories,
                'discounts'     => $discounts,
                'goods'         => $goods
            );
            return json($this->returnData($return_data));
        }
    }

    //外卖/堂吃商品筛选
    public function goods_list()
    {
        if(request()->isGet()){
             $data = input();
             $goods_model = $this->goods;
             $cate_name = '全品类';
             //根据搜索商品分类
            if(!empty($data['cate_id'])){
                $cate_ids = Category::where('pid',$data['cate_id'])->column('cate_id');
                if(empty($cate_ids)){
                    $goods_model =
                        $goods_model->where('G.cate_id',$data['cate_id']);
                    $cate_name = Category::where('cate_id',$data['cate_id'])->value('name');
                }else{
                    $goods_model =
                        $goods_model->where('G.cate_id','in',$cate_ids);
                    $cate_name = Category::where('cate_id',$data['cate_id'])->value('name');
                }

            }
            //搜索商品名称
            if(!empty($data['search_name'])){
                $goods_model = $goods_model->where('G.goods_name','like','%'.$data['search_name'].'%');
                $cate_name = '搜索';
            }
            //热销
            if(isset($data['is_hot']) && $data['is_hot'] == 'Y'){
                $goods_model = $goods_model->order('G.saled_num desc')->field('G.is_hot');
                $cate_name = '热销';
            }
            //商品列表
            $goods_list = $goods_model
                ->alias('G')
                ->field('G.goods_id,G.goods_name,G.saled_num,G.goods_price,G.goods_unit,G.goods_thumb,C.cate_id as cate_name')
                ->join('cy_category C','C.cate_id = G.cate_id')
                ->where('G.is_sale',1)
//                ->where('G.is_discount','N')
//                ->limit($this->per_page)
//                ->page($this->page)
                ->select();

            return json($this->returnData(['goods_list'=>$goods_list,'cate_name'=>$cate_name]));
        }
    }

    //折扣商品
    public function goods_discount()
    {
        if(request()->isGet()){
            $goods_list = $this->goods->alias('G')
                ->field('G.goods_id,G.goods_name,G.saled_num,G.goods_price,G.goods_unit,G.goods_thumb,DG.discount,DG.discount_price')
                ->join('cy_discount_goods DG','G.goods_id = DG.goods_id')
                ->join('cy_category C','C.cate_id = G.cate_id')
                ->where('G.is_sale',1)
                ->where('DG.status',1)
                ->limit($this->per_page)
                ->page($this->page)
                ->select();

            $new_list = array();
           if(!empty($goods_list)){
               foreach ($goods_list as $key => $value){
                    $new_list[$key] = $value;
                    $new_list[$key]['cate_name'] = 'discount';
               }
           }

            return json($this->returnData(['goods_list'=>$new_list,'cate_name'=>'折扣']));
        }
    }

    //商品详情
    public function goods_detail()
    {
        if(request()->isGet()){
            $goods_id = input('goods_id');
            if(empty($goods_id))
                return json($this->returnData([],404,'参数错误'));
            //商品信息
            $goods_info = $this->goods->with([
                'discount'=>function($query){
                $query->field('goods_id,discount,discount_price')->where('status',1);
            },
                'comment'=>function($query){
                    $query->field('member_id,goods_id,score,content,com_img1,com_img2,com_img3,com_img4,create_time')->with(['member'=>function($q){
                        $q->field('id,nickname,image');
                    }]);
                }
            ])->field('goods_id,goods_name,goods_price,goods_img1,goods_img2,goods_img3,goods_img4,goods_img5,cate_id,saled_num,desc')
                ->where('is_sale',1)
                ->find($goods_id);

            //好评数
            $comment_model = new Comment();
            $good_rate = $comment_model->get_good_comment();

            $return_data = array(
                'goods_info'    => $goods_info,
                'good_rate'     => $good_rate
            );

            return json($this->returnData($return_data));
        }
    }

    //商品列表
    public function goods_total_list()
    {
        if(request()->isGet()){
            $goods_list = Category::field('cate_id,name,pid,unit')
                ->where('pid',0)
                ->with(['childrenCate'=>function($query){
                $query->field('cate_id,name,pid,unit')->with(['goods'=>function($q){
                    $q->field('goods_id,goods_name,saled_num,goods_price,goods_unit,goods_thumb,cate_id');
                },

                ]);
            },
                'goods'=>function($q){
                    $q->field('goods_id,goods_name,saled_num,goods_price,goods_unit,goods_thumb,cate_id');
                },
            ])
                ->select();

            return json($this->returnData(['goods_list'=>$goods_list]));
        }
    }

}