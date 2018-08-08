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
     * 增加自强社成员
     * @param Request $request
     * @return \think\response\Json
     */
    public function createuser()
    {
        $input_data = input('post.');
        $result = $this->validate($input_data, 'User.create_user');
        if(VALIDATE_PASS !== $result){
            // 验证失败 输出错误信息
            return apireturn(-1, $result, '');
        }
        $username = $result['username'];
        $password = $result['password'];
        $realname = $result['realname'];
        $session = $result['session'];
        $sex = $result['sex'];
        $position = $result['position'];
        // 完善职位信息
        if (strcmp($position, "社长") == 0 || strcmp($position, "副社") == 0) {
            $position = $position.'大人';
        } else {
            $position = $position.'成员';
        }

        // 密码加盐验证
        $created = date("Y-m-d H:i:s",time());
        $salt = config('salt');
        $salted = crypt($password, $salt);
        $data = array(
            'username' => $username,
            'password' => $salted,
            'created' => $created,
            'realname' => $realname,
            'session' => $session,
            'sex' => $sex,
            'position' => $position,
        );
        // 检查权限
        $panel_user = Session::get('panel_user');
        if ($panel_user['role'] < 1) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $user = new UserModel();
        $rel = $user->adduser($data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }

    /**
     * 删除用户信息
     * @param Request $request
     * @return \think\response\Json
     */
    public function deluser()
    {
        $userid = input('get.id');
        // 检查权限
        $panel_user = Session::get('panel_user');
        if ($panel_user['role'] < 1) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $user = new UserModel();
        $rel = $user->deluser($userid);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
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


    /**
     * 修改某个自强人的权限
     * @param Request $request
     * @return \think\response\Json
     */
    public function updateuser()
    {
//        $info = $request->get();
        $input_data = input('get.');
        $result = $this->validate($input_data, 'User.change_role');
        if(VALIDATE_PASS !== $result){
            // 验证失败 输出错误信息
            return apireturn(-1, $result, '');
        }
        $data = array(
            'position' => $result['position'],
            'role' => $result['role']
        );
        // 检查权限
        $panel_user = Session::get('panel_user');
        if ($panel_user['role'] < 2) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $user = new UserModel();
        $rel = $user->updateuser($result['id'], $data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }

    /****************************个人信息*********************************/
    /**
     * 个人信息页面
     * @return mixed
     */
    public function mine()
    {
        $panel_user = Session::get('panel_user');
        $userid = $panel_user['id'];
        $user = new UserModel();
        $rel = $user->gettheuser($userid);
        $this->assign('id', $userid);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/mine');
    }

    /**
     * 更新个人信息
     * @param Request $request
     * @return \think\response\Json
     */
    public function updatemine()
    {
//        $info = $request->post();
        $input_data = input('post.');
        $result = $this->validate($input_data, 'User.update_mine');
        $data = array(
            'class'     => $result['class'],
            'qq'        => $result['qq'],
            'tel'       => $result['tel'],
            'email'     => $result['email'],
            'introduce' => $result['introduce'],
        );
        $panel_user = Session::get('panel_user');
        $user = new UserModel();
        $rel = $user->updateuser($panel_user['id'], $data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }
}