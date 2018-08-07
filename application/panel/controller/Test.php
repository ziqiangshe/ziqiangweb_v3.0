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

    public function va(Request $request) {
        $data = $request->get();

        $vdata = $this->validate($data,'Vtest');
        if(true !== $vdata){
            // 验证失败 输出错误信息
            dump($vdata);
        }
        echo "OK";
    }
}