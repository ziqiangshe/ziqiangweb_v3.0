<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/5
 * Time: 17:50
 */

namespace app\panel\controller;

use app\panel\model\UserModel;
use think\Request;
use think\Session;

class Character extends Base
{
    /**
     * 自强人物页面
     * @return mixed
     */
    public function manage()
    {
        return $this->fetch();
    }


    /**
     * 获取自强人物列表
     */
    public function get_message()
    {
        $user = new UserModel();
        $where = [];
        $rel['data'] = $user->where($where)->select();
        $count = count($user->where($where)->select());
        // 0-下架 1-上架
        foreach ($rel['data'] as $key => $val) {
            if ($rel['data'][$key]['status'] == 1) {
                $rel['data'][$key]['status'] = '已上架';
            } else {
                $rel['data'][$key]['status'] = '未上架';
            }
        }
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;
        $response['data'] = $rel['data'];
        echo json_encode($response);
    }

}
