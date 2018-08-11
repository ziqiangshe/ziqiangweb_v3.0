<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/11
 * Time: 13:34
 */
namespace app\api\controller;

use app\api\model\UserModel;
use think\Request;
use think\Session;

class Login extends Base
{
    /**
     * 用户登录
     */
    public function do_login()
    {
        $input_data = input('post.');
        $result = $this->validate($input_data, 'User.do_login');
        if ($result !== VALIDATE_PASS) {
            // 验证失败 输出错误信息
            return apireturn(CODE_ERROR, $result, '');
        }
        $username   = $input_data['username'];
        $password   = $input_data['password'];
        $salt = config('salt');
        $salted = crypt($password, $salt);
        $user = new UserModel();
        $rel = $user->user_login($username, $salted);
        if (!empty($rel['data'])) {
            $panel_user = $rel['data'];
            Session::set('panel_user', $panel_user, 'ziqiang');
            return apireturn($rel['code'], $rel['msg'], $rel['data']);
        }
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }
}