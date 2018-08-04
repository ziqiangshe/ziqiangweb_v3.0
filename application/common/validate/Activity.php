<?php
/**
 * Created by PhpStorm.
 * User: 76871
 * Date: 2018/8/4
 * Time: 19:38
 */
namespace app\common\validate;

use think\Validate;

class Activity extends Validate
{
    //提交规则，|号之间不能加多余符号，包括空格
    protected $rule = [
        'name'    => 'require|max:40',
        'image'   => 'require',
        'content' => 'require',
    ];

}