<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/5
 * Time: 14:13
 */

namespace app\panel\controller;


use app\panel\model\UserModel;
use think\Controller;
use Firebase\JWT\JWT;
use think\Request;
use think\Session;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch('login/index');
    }

    /**
     * 用户登录
     * @return mixed
     */
    public function dologin(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');
        $salt = config('salt');
        $salted = crypt($password, $salt);
        $user = new UserModel();
        $rel = $user->user_login($username, $salted);
        if (!empty($rel['data'])) {
            $panel_user = $rel['data'];
            Session::set('panel_user', $panel_user, 'ziqiang');
            $this->redirect('index/index');
        }
        return $this->fetch('login/index');
    }



    /**
     * 注销登陆
     */
    public function logout()
    {
        Session::delete('panel_user', 'ziqiang');
        $this->redirect('login/index');
    }
}