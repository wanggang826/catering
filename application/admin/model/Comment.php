<?php
namespace app\admin\model;

use app\common\model\Config;
use think\Model;
use traits\model\SoftDelete;

class Comment extends Model{
    use SoftDelete;

    //关联折扣
    public function member()
    {
        return $this->hasOne('Member','id','member_id');
    }

    public function select_comment($data,$where=array()){
        if(isValue($data,'nickname')){
            $where['M.nickname'] =['like','%'.(string)$data['nickname'].'%'];
        }
        if(isValue($data,'goods_name')){
            $where['G.goods_name'] =['like','%'.(string)$data['goods_name'].'%'];
        }
        if(isValue($data,'start_time') && isValue($data,'end_time')){
            $data['start_time'] =strtotime($data['start_time']);
            $data['end_time'] =strtotime($data['end_time']);
            $where['C.create_time']=['BETWEEN',[$data['start_time'],$data['end_time']]];
        }
        $query =$data;
        $list=$this->alias('C')
            ->join('cy_goods G ',' G.goods_id = C.goods_id')
            ->join('cy_member M ', 'C.member_id = M.id')
            ->field('G.goods_name,C.id,C.score,C.create_time,M.user_sn,M.nickname,M.user_phone')
            ->where($where)
            ->order('C.id desc')
            ->paginate('',false,['query' => $query]);
        resultToArray($list);
        return $list;
    }
    
    //计算总的好评数
    public function get_good_comment()
    {
        //获得总得评论数
        $counts = $this->count();
        //评论总分
        $total_score = $counts * 5;
        //评论评分
        $comment_config = Config::where('config_mark','COMMENT_STAR')->value('config_value');
        $comment_config = unserialize($comment_config);
        $mid_comment = $comment_config['mid_comment'];
        //好评分数
        $good_score = $this->where('score','egt',$mid_comment)->sum('score');

        //好评比例
        $good_rate = ($good_score/$total_score)*5;

        return round($good_rate,2);
    }

}