<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 18:05
 */
namespace app\common\validate;

use think\Validate;

class Blogtag extends Validate
{
    // 提交规则，|号之间不能加多余符号，包括空格
    protected $rule = [
        'id'          => 'require',
        'type'        => 'require',
        'is_show'     => 'require|in:0,1',
        'order'       => 'require|number',

    ];

    // 不符规则的错误提示
    protected $message = [
        'id.require'         => '请输入标签id~',
        'type.require'       => '请输入标签名~',
        'is_show.require'    => '请选择是否展示~',
        'is_show.in'         => '展示选项错误',
        'order.require'      => '请输入权重值~',
        'order.number'       => '权重值需要是一个数字',
    ];

    // 场景验证
    protected $scene = [
        'create_blog_tag'      =>  ['type', 'is_show', 'order'],
    ];

}