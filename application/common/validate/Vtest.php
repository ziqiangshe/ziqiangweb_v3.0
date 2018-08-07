<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 0:48
 */
namespace app\common\validate;

use think\Validate;

class Vtest extends Validate
{
    // 提交规则，|号之间不能加多余符号，包括空格
    protected $rule = [
        'username'    => 'require|max:40',
        'email'   => 'email',

    ];

    // 不符规则的错误提示
    protected $message = [
        'username.require'  =>  '必须输入用户名',
        'username.max'     => '名称最多不能超过25个字符',
        'email' =>  '邮箱格式错误',
    ];

    // 场景验证
    protected $scene = [
        'add'   =>  ['username','email'],
        'edit'  =>  ['email'],
    ];

}
