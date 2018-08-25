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
        $input_data = input('post.aoData');
        $aoData = json_decode($input_data);
        $offset = 0;
        $limit = 10;
        $where = [];
        foreach ($aoData as $key => $val) {
            if ($val->name == 'iDisplayStart')
                $offset = $val->value;
            if ($val->name == 'iDisplayLength')
                $limit = $val->value;
            if ($val->name == 'sSearch' && $val->value != "")
                $where['realname'] = ['like', '%' . $val->value . '%'];
        }
        $user = new UserModel();
        $rel = $user->get_all_user($where, $offset, $limit);
        $rel = change_user_info($rel);
        $count = count($user->where($where)->select());
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;
        $response['data'] = $rel['data'];
        echo json_encode($response);
    }

}
