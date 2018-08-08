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
        $data = input('get.');

        // 根据场景进行验证
        $result = $this->validate($data, 'Vtest.add');
        if(VALIDATE_PASS !== $result){
            // 验证失败 输出错误信息
            echo $result;
        }
        // 验证结束
        echo "OK";
    }
}