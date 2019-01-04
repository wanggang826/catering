<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Controller;
use think\Session;
use extend\Auths;
use think\Url;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * 后台基本类
 * 
 */
class AdminBase extends Base{
    protected $allowed = [
        'admin'=>[
            'publics.*',
        ],
    ];
    protected $table_field = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	public function _initialize(){
        parent::_initialize();
        $this->setTitle();
        $this->isLogin();
        $this->_checkAuth();
    }
    private function _checkAuth(){
        $force = false;
        if (strtolower(CONTROLLER_NAME) == 'index' && strtolower(ACTION_NAME) == 'index') $force = true;
        !Auths::checkAuth([],$force) && Api()->setApi('msg',Auths::getMsg())->setApi('url',0)->ApiError();
    }
    protected function setTitle(){
        $m = ['pmenu'=>'后台管理','menu_name'=>'','menu_des'=>''];
        $url = Url::build(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
        $menu = model('menu')->getByUrl($url);
        if ($menu) {
            $p = model('menu')->getByMenuId($menu->pid);
            if ($p) {
                $m['pmenu'] = $p['menu_name'];
            } else {
                $m['pmenu'] = '后台管理';
            }
            $m['menu_name'] = $menu->menu_name;
            $m['menu_des']  = $menu->menu_des;
        }
        $this->assign('menu',$m);
    }
    /**
     * 修改数据表指定字段
     * @param string    $table    要修改的数据表
     * @param string    $status   要修改成的值
     * @param int|array $id       主键ID
     * @param string    $pk       主键名，默认为表名_id
     * @param string    $field    要修改的字段，默认status
     */
    final protected function setStatus($table,$status,$id,$pk='',$field='status',$where='', $setAjax=false){
        $api    = Api('this',$setAjax);
        $pk     = $pk ?: $table.'_id';
        $field  = $field ?: 'status';
        $ids    = (array)$id;
        if (!$table  || !$ids || !$pk || !$field) {
            !$table      && $msg  = 'table';
            !$ids        && $msg  = 'id';
            !$pk         && $msg  = 'pk';
            !$field      && $msg  = 'field';
            return $api->setApi('msg','param error:'.$msg)->ApiWarning();
        }
        $model = model($table);
        foreach ($ids as $k => $id) {
            if (!(int)$id) continue;
            $where[$pk]    = (int)$id;
            $data[$field] = $status;
            $model->where($where)->update($data);
        }
        return $api->setApi('msg','操作成功')->ApiSuccess();
        
    }

    /**
     * 检测登录
     */
    protected function isLogin(){
        $module_name     = strtolower(MODULE_NAME);
        $controller_name = strtolower(CONTROLLER_NAME);
        $action_name     = strtolower(ACTION_NAME);
        if (array_key_exists($module_name,$this->allowed)) {
            $auth1 = $controller_name.'.*';
            $auth2 = $controller_name.'.'.$action_name;
            if (in_array($auth1, $this->allowed[$module_name])) {
                return;
            } elseif(in_array($auth2, $this->allowed[$module_name])) {
                return;
            }
        }
        if(1 != $this->is_login()->code && !request()->isAjax()){
            
            $this->redirect('publics/login');
        }
    }

    protected function push($data,$fieldName,$title){
        $num = count($data[0]) - 1;
        //dump($num);die;
        $Columnend = $this->table_field[$num];
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle("member");
        //表头
        $spreadsheet->getActiveSheet()->mergeCells('A1:'.$Columnend.'1');
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $title);

        // 设置标题属性
        $style = [
            'font'              =>['bold'=> true,'name'=>'微软雅黑'],
            'horizontal'        => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical'          => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'rotation'          => 0,
            'wrap'              => TRUE
        ];
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray($style);
       for($i=0;$i<=$num;$i++){
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($this->table_field[$i].'2', $fieldName[$i]);
       }
        //表体
        $spreadsheet->getActiveSheet()
            ->fromArray(
                $data,       // The data to set
                NULL,        // Array values with this value will not be set
                'A3'         // Top left coordinate of the worksheet range where
            );
        $name = $title.'_'.date('YmdHi',time());
       
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

}
