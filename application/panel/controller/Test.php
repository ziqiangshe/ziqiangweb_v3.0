<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 0:25
 */

namespace app\panel\controller;


use app\panel\model\UserModel;
use think\Controller;
use think\Request;
use think\Session;
use think\Validate;

class Test extends Controller
{

    public function va() {
//        $data = input('get.');

//        $result = $this->validate($data,'Vtest');
//        if(true !== $result){
//            // 验证失败 输出错误信息
//            dump($result);
//        }
        
        $result = $this->validate(
            [
                'name'  => 'thinkphp',
                'email' => 'thinkphpqq.com',
            ],
            [
                'name'  => 'require|max:25',
                'email'   => 'email',
            ]);
        if(true !== $result){
            // 验证失败 输出错误信息
            dump($result);
        }
//        $username = $data['username'];
//        $email = $data['email'];
//        echo $username.$email;

//        echo "OK";
    }
}