<?php
namespace app\api\controller;
/**
* 
*/
class Test extends BaseApi
{
	
	public function test(){
		$string = $this->encrypted_private(input());
		$data   = $this->decrypted_public($string);
		echo $string;
		echo '<br/>';
		echo json_encode($data);die;
	}
}