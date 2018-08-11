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
     * 注销登陆-理论上应该放在API模块，但是实在不想改V层了，后面看到的人改一下吧= =
     */
    public function logout()
    {
        Session::delete('panel_user', 'ziqiang');
        $this->redirect('login/index');
    }
}