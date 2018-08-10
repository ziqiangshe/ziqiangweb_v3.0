<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/21/2017
 * Time: 4:34 PM
 */

namespace app\panel\controller;


use app\panel\model\UserModel;
use think\Request;
use think\Session;

class User extends Base
{
    /****************************用户管理*********************************/

    /**
     * 获取届数并渲染用户界面
     * @return mixed
     */
    public function ziqiang()
    {
        $ses = input('get.ses');
        if (!isset($ses)) {
            $ses = 0;
        }
        $this->assign('ses', $ses);
        return $this->fetch('user/ziqiang');
    }

    /**
     * 渲染创建用户页面
     * @return mixed
     */
    public function create()
    {
        return $this->fetch('user/create');
    }

    /**
     * 查看某个自强人的信息，渲染查看用户页面
     * @param Request $request
     * @return mixed
     */
    public function lookuser()
    {
        $userid = input('get.id');
        $user = new UserModel();
        $rel = $user->gettheuser($userid);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/lookuser');
    }

    /**
     * 传入用户id，渲染编辑用户界面
     * @param Request $request
     * @return mixed
     */
    public function edituser()
    {
        $userid = input('get.id');
        $user = new UserModel();
        $rel = $user->gettheuser($userid);
        $this->assign('id', $userid);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/edituser');
    }

    /**
     * 获取所有自强人信息
     * @param Request $request
     */
    public function getalluser()
    {
        $input_data = input('post.aoData');
        $aoData = json_decode($input_data);
        $ses = input('get.ses');
        $offset = 0;
        $limit = 10;
        if ($ses == 0) {
            $where = [];
        } else {
            $where['session'] = ['=', $ses];
        }
        foreach ($aoData as $key => $val) {
            if ($val->name == 'iDisplayStart')
                $offset = $val->value;
            if ($val->name == 'iDisplayLength')
                $limit = $val->value;
            if ($val->name == 'sSearch' && $val->value != "")
                $where['title|content'] = ['like', '%'.$val->value.'%'];
        }
        $user = new UserModel();
        $rel = $user->getalluser($where, $offset, $limit);
        foreach ($rel['data'] as $key => $val) {
            if ($rel['data'][$key]['sex'] == 1) {
                $rel['data'][$key]['sex'] = '男';
            } else {
                $rel['data'][$key]['sex'] = '女';
            }

            if ($rel['data'][$key]['role'] == 2) {
                $rel['data'][$key]['role'] = '大狗官';
            } elseif($rel['data'][$key]['role'] == 1) {
                $rel['data'][$key]['role'] = '狗官';
            } else {
                $rel['data'][$key]['role'] = '平民';
            }
        }
        $count = count($user->where($where)->select());
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;
        $response['data'] = $rel['data'];
        echo json_encode($response);
    }




    /****************************个人信息*********************************/
    /**
     * 个人信息页面
     * @return mixed
     */
    public function mine()
    {
        $panel_user = Session::get('panel_user');
        $user_id = $panel_user['id'];
        $user = new UserModel();
        $rel = $user->gettheuser($user_id);
        $this->assign('id', $user_id);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/mine');
    }

}