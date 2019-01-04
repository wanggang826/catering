<?php
namespace app\admin\controller;

use app\admin\model\Article;
use think\Exception;


/**
 * 商品控制器
 * @author  huangwei
 * @version 2017/8/12
 */
class SystemMsg extends AdminBase{

    private $article;

    public function __construct()
    {
        parent::__construct();
        $this->article =  new Article();
    }

    //添加/编辑
    public function article_edit()
    {
        if(request()->isPost()){
            try{
                $data = input();
                if(empty($data['title']))
                    throw new Exception('标题不能为空');
                if(empty($data['content']))
                    throw new Exception('系统信息不能为空');
                $data = array(
                    'title'     => $data['title'],
                    'content'   => $data['content']
                );
                //添加
                if(empty($data['article_id'])){
                    $this->article->save($data);
                }else{
                    $this->article->save($data,['article_id'=>$data['article_id']]);
                }

                Api()->setApi('url',input('location'))->ApiSuccess();
            }catch (\Exception $e){
                Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
            }



        }
        $article_id = input('article_id');
        if(!empty($article_id)){
            //文章信息
            $article = $this->article->find($article_id);
            return view(['article'=>$article]);
        }
        return view();
    }

    //列表
    public function article_list()
    {
        $data = input();
        $lists = $this->article->select_article($data);
        return view(['lists'=>$lists]);

    }

    //删除
    public function article_del()
    {
        try{
            $data = input();
            if(empty($data['id']))
                throw new Exception('请选择要操作数据');
            $time = time();
            $this->article->where('article_id','in',$data['id'])->update(['delete_time'=>$time]);

            Api()->setApi('url',input('location'))->ApiSuccess();
        }catch(\Exception $e){
            Api()->setApi('msg',$e->getMessage())->setApi('url',0)->ApiError();
        }
    }
}