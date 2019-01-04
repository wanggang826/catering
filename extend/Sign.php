<?php
namespace extend;
/**
 * RSA 加密类
 * by wgg 2017/11/22
 */
class Sign{
	 /**
     * RSA 加密
     * @param array $data 要加密的数据
     * @param string $type 加密类型 private|public
     * @param string $key 
     * @return 加密结果|false 加密类型参数错误 
     */
    public function encrypted($data =array(),$type = 'private',$key=''){

            $stringToBeSigned = $this->data_splicing($data);
            $encrypted = "";
            if($type == 'private'){
                $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
                wordwrap($key, 64, "\n", true) .
                "\n-----END RSA PRIVATE KEY-----";
                $pri_key = openssl_pkey_get_private($res);//获取私钥资源  不可用返回false 可用返回资源id Resource id
                ($pri_key) or die('您使用的私钥格式错误，请检查RSA私钥');
                openssl_private_encrypt($stringToBeSigned,$encrypted,$pri_key);//私钥加密
                $encrypted = base64_encode($encrypted);//base64编码转换
            }elseif($type == 'public'){
                $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($key, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
                $pub_key =openssl_pkey_get_public($res);
                ($pub_key) or die('您使用的公钥格式错误，请检查RSA公钥'); 
                openssl_public_encrypt($stringToBeSigned,$encrypted,$pub_key);//公钥加密
                $encrypted = base64_encode($encrypted);
            }else{
                return false;
            }
            return $encrypted;
    }
    /**
     * RSA 解密
     * @param string $data 要解密的数据
     * @param string $type 加密类型 private|public
     * @param string $key 
     * @return 解密结果数据|false 解密类型参数错误
     */
    public function decrypted($data='',$type = 'private',$key=''){
        $decrypted = '';
        if($type =='private'){
                $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
                wordwrap($key, 64, "\n", true) .
                "\n-----END RSA PRIVATE KEY-----";
                $pri_key = openssl_pkey_get_private($res);
                ($pri_key) or die('您使用的私钥格式错误，请检查RSA私钥');
                openssl_private_decrypt(base64_decode($data),$decrypted,$pri_key);//私钥解密
            }elseif($type =='public'){
                $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($key, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
                $pub_key =openssl_pkey_get_public($res);
                ($pub_key) or die('您使用的公钥格式错误，请检查RSA公钥'); 
                openssl_public_decrypt(base64_decode($data),$decrypted,$pub_key);//公钥解密
            }else{
                return false;
            }
            return $decrypted;
    }
    /**
     * 数据拼接处理
     * @param array $data 要处理的数据
     * @return string 处理结果
     */
    public function data_splicing($data=array()){
        ksort($data);
        $stringToBeSigned = http_build_query($data);
        // $i = 0;
        // foreach ($data as $k => $v) {
        //     if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
        //         // 转换成目标字符集
        //         $v = $this->characet($v, $this->postCharset);

        //         if ($i == 0) {
        //             $stringToBeSigned .= "$k" . "=" . "$v";
        //         } else {
        //             $stringToBeSigned .= "|" . "$k" . "=" . "$v";
        //         }
        //         $i++;
        //     }
        // }
        // unset ($k, $v);
        
        return $stringToBeSigned;
    }
    /**
     * 校验$value是否非空
     *  if not set ,return true;
     *  if is null , return true;
     **/
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
}

