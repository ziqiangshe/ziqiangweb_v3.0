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
    //提交规则，|号之间不能加多余符号，包括空格
    protected $rule = [
        'username'    => 'require|max:40',
        'password'   => 'require',
    ];

}