<?php

return [
	// 默认输出类型
    'default_return_type'    => 'json',
    'overtime_downlogin'	 => 3*24*60*60,
    'app_pay_get_time'  	 => 300,
    'do_data_time'           => 24*60*60, //处理临时数据缓存时间 3小时
    'web_api_encode'         =>'123456',
    'private_key'            =>'MIICXAIBAAKBgQC3zfel3q8xwffMz9jE2GCFNVTW4krFkLF9xsGQMyWf4D8ROjB/JN2HX6+rdX9NaQ1rRH9JIENEmnJSvyxUqIRyjwspbM0L5+avbdExTcPFBncgZ2Bvrpfi/zV4+BM45AXkkhQTOVnH1PEggHAmdrBFmrWEcXSn9xoLzneI4uzafwIDAQABAoGANUr49RT+AxVUfgP9vAVo5vaxpKR0PZhYfjl0whSyYgqo/pu6mALeYHP0AWjOAmnlRCbWKSO7nVaSsz9O4TUDQZ26QFlHkOm0/Bx62xKFhEnUEc7hOkFpkd3NLA1+K0xS/YmBNV/xySkCJ+kSovihxMLUT6CRulUpGoZySiYI7lECQQDtvwidzzens0tsYlf/739rkWtNr3dHW297pInmKAd5miQE4vrKyePdUFIJJ/REwGHIWHJubY2FFD1Fafa7UFhzAkEAxeqyGYxWDWlj0v6anMuxT6nQi0aGLUD81Oy1ewa/IyYTUYbLTRTR51zk1x3I59tJGSHk3i0jB1tcIouHUZOOxQJAKY77MprGX8o3pPqL53E2FNeWqj3B2/dfxX09nb3hkKAhK7mBnXEtI8KmlHMnf90hOqQ7XJJJ6rle/INJXfTtgQJAIircSFDT4kjZdOmDY6I+oBQe7oxkSZe4jkG3KuAFS1odZ6uvmUUI37pHv2Ni9bQDsJULX9fG/lQlWclguRKSSQJBAIF5R79nxc61N3zXlV7Z7esIfZcFms2By+1kJZa/ksdHbdKzmV10VHlXJXDg4Opckx7shbpYZTlSp4sz9USzFoQ=',
    'public_key'             =>'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC3zfel3q8xwffMz9jE2GCFNVTW4krFkLF9xsGQMyWf4D8ROjB/JN2HX6+rdX9NaQ1rRH9JIENEmnJSvyxUqIRyjwspbM0L5+avbdExTcPFBncgZ2Bvrpfi/zV4+BM45AXkkhQTOVnH1PEggHAmdrBFmrWEcXSn9xoLzneI4uzafwIDAQAB',

    //短信配置
    'sms'   => [
        'url'       => 'http://www.ztsms.cn/sendSms.do',
        'user_name' => 'liesunsmszh',
        'password'  => 'CUzaqLS7'
    ],

    //member密码秘钥
    'member_key'        => 'member_',
    //用户默认密码
    'default_password'  => '123456',
    'auto_timestamp' => true,
];
