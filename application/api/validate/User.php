<?php

namespace app\api\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'username'  => 'require|max:25',
        'email' => 'email'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'username.require' => '名称必须',
        'username.max'     => '名称最多不能超过25个字符',
        'email'        => '邮箱格式错误'
    ];
}
