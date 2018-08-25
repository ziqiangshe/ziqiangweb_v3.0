<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 14:59
 */

namespace app\common\validate;

use think\Validate;

class Activitysign extends Validate
{
    // 提交规则，|号之间不能加多余符号，包括空格
    protected $rule = [
        'id'          => 'require|number',
        'activity_id' => 'require|number',
        'name'        => 'require|chs',
        'cardno'      => 'require|number',
        'sex'         => 'require|in:0,1,2',
        'session'     => 'require|number',
        'major'       => 'require|chs',
        'class'       => 'require|chsAlphaNum',
        'tel'         => 'require|number',
        'qq'          => 'require|number',
        'status'      => 'require',
    ];

    // 不符规则的错误提示
    protected $message = [
        'id.require'          => '请传入报名id~',
        'id.number'           => '报名id应为数字~',
        'activity_id.require' => '请传入活动id~',
        'activity_id.number'  => '活动id应为数字~',
        'name.require'        => '请输入姓名~',
        'name.chs'            => '真实姓名不是中文？你骗谁呢？',
        'cardno.number'       => '卡号应为数字~',
        'cardno.require'      => '请输入卡号~',
        'sex.require'         => '你别告诉我你没有性别！你别过来！我报警啦！',
        'sex.in'              => '你是外星人吧？？？',
        'session.require'     => '请输入届数~',
        'session.number'      => '届数应为数字~',
        'major.require'       => '请选择学院~',
        'major.chs'           => '学院应为中文~',
        'class.require'       => '请输入班级~',
        'class.chsAlphaNum'   => '班级信息请由汉字、字母、数字组合',
        'tel.require'         => '请输入电话~',
        'tel.number'          => '电话不是数字组成，你是在8102年吧...',
        'qq.require'          => '请输入QQ~',
        'qq.number'           => 'QQ还有非数字情况？',
        'status.require'      => '请添加修改状态~'
    ];

    // 场景验证
    protected $scene = [
        'create_activity_sign'  => ['activity_id', 'name', 'cardno', 'sex', 'session', 'major', 'class', 'tel', 'qq'],
        'edit_activity_sign' => ['id', 'status'],
    ];

}