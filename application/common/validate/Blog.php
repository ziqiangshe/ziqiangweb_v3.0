<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/11
 * Time: 18:14
 */

namespace app\common\validate;

use think\Validate;

class Blog extends Validate
{
    // 提交规则，|号之间不能加多余符号，包括空格
    protected $rule = [
        'id'          => 'require',
        'title'       => 'require',
        'tag'         => 'require',
        'summary'     => 'require',
        'content'     => 'require',
    ];

    // 不符规则的错误提示
    protected $message = [
        'id.require'         => '请输入用户id~',
        'title.require'      => '请输入标题~',
        'tag.require'        => '请输入标签~',
        'summary.require'    => '请输入摘要~',
        'content.require'    => '请输入文章内容~',
    ];

    // 场景验证
    protected $scene = [
        'add_blog'      =>  ['title', 'tag', 'summary', 'content'],
        'edit_blog'     =>  ['id', 'title', 'tag', 'summary', 'content'],
    ];

}