<?php
namespace app\admin\controller;
use think\Session;
use app\admin\Model\Menu;
class Index extends AdminBase{
	protected $class = ['nav nav-second-level','nav nav-third-level'];
    protected $menus,$html  = [
        'noleaf_a' => "<a class='J_menuItem' href='%s'><i class='fa fa-fw fa-%s level-%s'></i>",
        'hasleaf_a' => "<a class='' href='%s'><i class='fa fa-fw fa-%s level-%s'></i>",
        'lv_menu' =>"<span class='nav-label'>%s</span>",
        'left_icon' =>"<span class='fa fa-fw arrow'></span>",
    ];
	public function index(){
        $this->view->engine->layout(false);
        $this->getMenus();
        $headimg = Session::get('user.headimg');
        $pash = "./upload/".$headimg;
        if(!file_exists($pash)){//检测图片图片
            $headimg="";
        }
    	return view('',['menus'=>$this->menus,'headimg'=>$headimg]);
	}
    public function main(){

// echo date("Y-m-d H:i",$m_time);
        if(request()->isAjax()){
            //统计图数据
             $arr_t = array();
             $arr_w = array();
            for ($i=0; $i <date("j") ; $i++) { 
                $time = strtotime(date('Y').'-'.date('m').'-'.($i+1));
                $end_time = $time+86399;
                $t_order_price = model('order')->where(['status'=>['in',[1,2,3]],'create_time'=>['BETWEEN',[$time,$end_time]],'type'=>0])->column('order_price');
                $w_order_price = model('order')->where(['status'=>['in',[1,2,3]],'create_time'=>['BETWEEN',[$time,$end_time]],'type'=>1])->column('order_price');
                $arr_t[$i] = array_sum($t_order_price);
                $arr_w[$i] = array_sum($w_order_price);
            }
           
            $arr = array('arr_t'=>$arr_t,'arr_w'=>$arr_w);
            echo json_encode($arr);
        }else{
            $queuing_count= db('queuing')->where(['status'=>0])->count();//排号
            $t_order_count= db('order')->where(['type'=>0,'status'=>0])->count();//堂吃订单
            $w_order_count= db('order')->where(['type'=>1,'status'=>['in',[0,1]]])->count();//外卖订单
            $reserve_count= db('reserve')->count();//预定
            $member_count = model('member')->count();//用户
            $orders = db('order')->where(['status'=>['in',[1,2,3]],'create_time'=>['egt',strtotime(date('Y-m-d'))]])->select();
            $order_count = count($orders);
            $total_price = array_sum(array_column($orders,'order_price'));

             //统计当月笔数/销售额
            $m_time = strtotime(date('Y').'-'.date('m'));
            $m_end_time = $m_time + date("t")*86399;
            $mt_order_prices = model('order')->where(['status'=>['in',[1,2,3]],'create_time'=>['BETWEEN',[$m_time,$m_end_time]],'type'=>0])->column('order_price');
            $mw_order_prices = model('order')->where(['status'=>['in',[1,2,3]],'create_time'=>['BETWEEN',[$m_time,$m_end_time]],'type'=>1])->column('order_price');
            $mt_order_price = array_sum($mt_order_prices);
            $mt_order_count = count($mt_order_prices);
            $mw_order_price = array_sum($mw_order_prices);
            $mw_order_count = count($mw_order_prices);

            return view([
                 'date'=>date('Y-m-d',time()),'member_count'=>$member_count,'total_price'=>$total_price,'order_count'=>$order_count,
                 'queuing_count'=>$queuing_count,'t_order_count'=>$t_order_count,
                 'w_order_count'=>$w_order_count,'reserve_count'=>$reserve_count,'mt_order_price'=>$mt_order_price,'mt_order_count'=>$mt_order_count,'mw_order_price'=>$mw_order_price,'mw_order_count'=>$mw_order_count
                ]);
        }
       
    }
    /**
     * 获取html菜单，并写入缓存文件
     */
    protected function getMenus(){
        $menu_list = unserialize(session('user.menuList'));
        if(!empty($menu_list)){
            $menu_id = $menu_list['menu_id'];
            $this->getMenuId($menu_id);
            config('menu_id',$menu_id);
            $menus = Menu::all(function($db){
                $db->where(['menu_id'=>['in',config('menu_id')],'status'=>['eq',1]])->order('sort', 'asc');
            });
            resultToArray($menus);
            if ($menus) {
                $option = ['primary_key'=>'menu_id'];
                $menus = getTree($menus,$option)->makeTreeForHtml();
                $menus = getTree($menus,$option)->makeTree();
                $this->setMenu($menus);
            }
        }
    }
    /**
     * 获取已有菜单父级菜单
     */
    protected function getMenuId(&$menu_id){
        $menu_pid = model('menu')->where(['menu_id'=>['in',$menu_id],'status'=>['eq',1],'pid'=>['neq',0]])->column('pid');
        $menu_pid = array_flip(array_flip($menu_pid));
        if ($menu_pid) {
            $this->getMenuId($menu_pid);
        }
        $menu_id = array_merge($menu_id,$menu_pid);
        $menu_id = array_flip(array_flip($menu_id));
        sort($menu_id);
    }

    /**
     * 递归设置菜单格式
     */
    protected function setMenu(&$menus){
        array_walk($menus, 'self::setMenuFormat');
    }
    /**
     * 递归菜单html
     */
    protected function setMenuFormat(&$val){
        if ($val['level']>=2) {//保证最多只显示三级菜单
            $val['leaf'] = true;unset($val['child']);
        }
        extract($this->html);extract($val);
        $menu_icon = $menu_icon ?: 'list';
        if (array_key_exists('leaf', $val) && $leaf===true) {
            $format = "<li>{$noleaf_a}{$lv_menu}</a></li>";
            $this->menus .= sprintf($format,$url,$menu_icon,$level,$menu_name);
        } else {
            $val['leaf'] = false;
            $format = "<li>{$hasleaf_a}{$lv_menu}{$left_icon}</a><ul class='nav {$this->class[$level]}'>";
            $this->menus .= sprintf($format,$url,$menu_icon,$level,$menu_name);
            $this->setMenu($child);
            $this->menus .= "</ul></li>";
        }
    }
}