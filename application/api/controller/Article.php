<?php
namespace app\api\controller;
use app\admin\model\Comment;
use app\admin\model\Member;
use app\common\model\Config;
use think\Db;
use think\Exception;

class Article extends BaseApi{

    private $article;

    public function __construct()
    {
        parent::__construct();
        $this->article = new \app\admin\model\Article();
    }

    //系统信息
    public function system_msg()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        
        if(request()->isGet()){
            $del_msg_ids = Db::name('sys_message_status')->where(['member_id'=>$this->member_id,'status'=>2])->column('sys_message_id');
            //用户文章列表
            $msg_list = $this->article->whereNotIn('article_id',$del_msg_ids)->select();
            //用户已读ID
            $read_ids = Db::name('sys_message_status')->where(['member_id'=>$this->member_id,'status'=>1])->column('sys_message_id');

            $return_data = array(
                'msg_list'  => $msg_list,
                'read_ids'  => $read_ids,
            );

            return json($this->returnData($return_data));
        }
    }

    //系统消息详情
    public function system_msg_detail()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));
        if(request()->isGet()){
            $article_id = input('article_id');
            if(empty($article_id))
                return json($this->returnData([],404,'参数错误'));

            //标记为已读
            $add_data = array(
                'sys_message_id'    => $article_id,
                'member_id'         => $this->member_id,
                'status'            => 1,
                'create_time'       => time(),
            );
            Db::name('sys_message_status')->insert($add_data);
            $system = $this->article->find($article_id);
            return json($this->returnData($system));
        }
    }

    //关于我们
    public function about_us()
    {
        if(request()->isGet()){
            $about_us = Config::where('config_mark','ABOUT_US')->value('config_value');
            $content['content'] = $about_us;
            return json($this->returnData($content));
        }
    }

    //系统消息删除
    public function msg_del()
    {
        if(empty($this->member_id))
            return json($this->returnData([],300));

        if(request()->isPost()){
            $msg_id = input('article_id');
            if(empty($msg_id))
                return json($this->returnData([],404,'参数错误'));

            $del_data = array(
                'sys_message_id'    => $msg_id,
                'member_id'         => $this->member_id,
                'status'            => 2,
                'create_time'       => time(),
            );
            Db::name('sys_message_status')->insert($del_data);

            return json($this->returnData());
        }

    }


}