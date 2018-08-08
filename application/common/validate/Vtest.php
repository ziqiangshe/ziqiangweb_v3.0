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
        'password' => 'require',
        'email'   => 'email',

    ];

    // 不符规则的错误提示
    protected $message = [
        'username.require'  =>  '必须输入用户名',
        'username.max'     => '名称最多不能超过25个字符',
        'password.require' => '必须输入密码',
        'email.email' =>  '邮箱格式错误',
    ];

    // 场景验证
    protected $scene = [
        'add'   =>  ['username','email'], // 必须输入用户名且长度不可超过40，可选输入邮箱但格式必须正确
        'edit'  =>  ['email', 'password'], // 必须输入用户名及密码
    ];

}
