<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/11
 * Time: 2:09
 */

namespace app\api\controller;

use app\api\model\CharacterModel;
use think\Request;
use think\Session;

class Character extends Base
{
    /**
     * 上架自强人物
     * @return \think\response\Json
     */
    public function on_character()
    {
        $id = Request::instance()->get('id');

        $user = new CharacterModel();
        $panel_user = Session::get('panel_user', 'ziqiang');
        if ($panel_user['role'] < 1) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $rel = $user->on_character($id);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }


    /**
     * 下架自强人物
     * @return \think\response\Json
     */
    public function down_character()
    {
        $id = Request::instance()->get('id');

        $user = new CharacterModel();
        $panel_user = Session::get('panel_user', 'ziqiang');
        if ($panel_user['role'] < 1) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $rel = $user->down_character($id);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }
}