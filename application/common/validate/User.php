<?php
/**
 * Created by PhpStorm.
 * User: XZFFF
 * Date: 2018/8/8
 * Time: 19:16
 */
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    // 提交规则，|号之间不能加多余符号，包括空格
    protected $rule = [
        'id'          => 'require',
        'username'    => 'require|max:20',
        'password'    => 'require|min:3',
        'realname'    => 'require|chs',
        'session'     => 'require|number',
        'sex'         => 'require|in:0,1,2',
        'position'    => 'require',
        'department'  => 'require',
        'role'        => 'require',
        'class'       => 'chsAlphaNum', // 汉字、字母、数字
        'qq'          => 'number',
        'tel'         => 'number',
        'email'       => 'email',
    ];

    // 不符规则的错误提示
    protected $message = [
        'id.require'         => '请输入用户id~',
        'username.require'   => '请输入用户名~',
        'username.max'       => '你用户名也忒长了吧...',
        'password.require'   => '请输入密码~',
        'password.min'       => '密码至少要3位吧...',
        'realname.require'   => '请输入真实姓名~',
        'realname.chs'       => '真实姓名不是中文？你骗谁呢？',
        'session.require'    => '请选择届数~',
        'session.number'     => '届数得是数字啊兄die~',
        'sex.require'        => '你别告诉我你没有性别！你别过来！我报警啦！',
        'sex.in'             => '你是外星人吧？？？',
        'department.require' => '请选择所属部门~',
        'position.require'   => '请选择职务~',
        'role.require'       => '请选择权限~',
        'class.chsAlphaNum'  => '班级信息请由汉字、字母、数字组合',
        'qq.number'          => 'QQ还有非数字情况？',
        'tel.number'         => '电话不是数字组成，你是在8102年吧...',
        'email.email'        => '邮箱格式错误~',
    ];

    // 场景验证
    protected $scene = [
        'do_login'      =>  ['username', 'password'],
        'create_user'   =>  ['username', 'password', 'realname', 'session', 'sex', 'department', 'position'],
        'change_role'   =>  ['id', 'department', 'position', 'role'],
        'update_mine'   =>  ['class', 'qq', 'tel', 'email'],
    ];

}