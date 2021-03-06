<?php
namespace app\admin\controller;

use app\admin\model\Users;


class Comment extends AdminBase
{
    private $comment,$good_score,$mid_score,$bad_score;

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->comment = model('Comment');
        $this->good_score = 3;//好评分数
        $this->mid_score  = 2;//中评分数
        $this->bad_score  = 1;//差评分数
    }

    //详情
    public function detail()
    {
        if(request()->isGet()){
            $comment_id = input('id');
            if(empty($comment_id))
                Api()->setApi('msg','参数错误')->setApi('url',url('index'))->ApiError();
            //评论详情
            $comment = $this->comment->find($comment_id);
            return view(['comment'=>$comment]);
        }
	}

	//列表
    public function index()
    {
        //所有评论
        $data = input();
        $comments = $this->comment->select_comment($data);
        return view([
            'lists'      => $comments,
            'good_score' => $this->good_score,
            'mid_score'  => $this->mid_score,
            'bad_score'  => $this->bad_score,
        ]);
    }

    //删除
    public function del()
    {
        try{
            $data = input();
            if(empty($data['id']))
                throw new Exception('请选择要操作数据');
            $time = time();
            model('Comment')
                ->where('id','in',$data['id'])
                ->update(['delete_time'=>$time]);

            Api()->setApi('url',input('location'))->ApiSuccess();
        }catch(\Exception $e){
            Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
        }
    }
}