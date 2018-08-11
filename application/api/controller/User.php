<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 23:57
 */

namespace app\api\controller;

use app\api\model\UserModel;
use think\Request;
use think\Session;

class User extends Base
{

    /**
     * 增加自强社成员
     * @param Request $request
     * @return \think\response\Json
     */
    public function create_user()
    {
        $input_data = input('post.');
        $result = $this->validate($input_data, 'User.create_user');
        if ($result !== VALIDATE_PASS) {
            // 验证失败 输出错误信息
            return apireturn(CODE_ERROR, $result, '');
        }
        $username   = $input_data['username'];
        $password   = $input_data['password'];
        $realname   = $input_data['realname'];
        $session    = $input_data['session'];
        $sex        = $input_data['sex'];
        $department = $input_data['department'];
        $position   = $input_data['position'];
//        // 完善职位信息
//        if (strcmp($position, "社长") == 0 || strcmp($position, "副社") == 0) {
//            $position = $position . '大人';
//        } else {
//            $position = $position . '成员';
//        }

        // 密码加盐验证
        $create_time = date("Y-m-d H:i:s", time());
        $salt = config('salt');
        $salted = crypt($password, $salt);
        $data = array(
            'username'    => $username,
            'password'    => $salted,
            'realname'    => $realname,
            'session'     => $session,
            'sex'         => $sex,
            'department'  => $department,
            'position'    => $position,
            'create_time' => $create_time,
        );
        // 检查权限
        $panel_user = Session::get('panel_user', 'ziqiang');
        if ($panel_user['role'] < 1) {
            return apireturn(CODE_ERROR, '权限不足，操作失败', '');
        }
        $user = new UserModel();
        $rel = $user->add_user($data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }

    /**
     * 修改某个自强人的权限
     * @param Request $request
     * @return \think\response\Json
     */
    public function update_user()
    {
//        $info = $request->get();
        $input_data = input('get.');
        $result = $this->validate($input_data, 'User.change_role');
        if ($result !== VALIDATE_PASS) {
            // 验证失败 输出错误信息
            return apireturn(CODE_ERROR, $result, '');
        }
        $update_time = date("Y-m-d H:i:s", time());
        $data = array(
            'position' => $input_data['position'],
            'role'     => $input_data['role'],
            'update_time' => $update_time,
        );
        // 检查权限
        $panel_user = Session::get('panel_user', 'ziqiang');
        if ($panel_user['role'] < 2) {
            return apireturn(CODE_ERROR, '权限不足，操作失败', '');
        }
        $user = new UserModel();
        $rel = $user->update_user($input_data['id'], $data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }

    /**
     * 删除用户信息
     */
    public function del_user()
    {
        $user_id = input('get.id');
        // 检查权限
        $panel_user = Session::get('panel_user', 'ziqiang');
        if ($panel_user['role'] < 1) {
            MessageBox('权限不足，操作失败', -1);
        }
        $user = new UserModel();
        $rel = $user->del_user($user_id);
        MessageBox($rel['msg'], -1);
    }

    /**
     * 更新个人信息
     * @param Request $request
     * @return \think\response\Json
     */
    public function update_mine()
    {
        $input_data = input('post.');
        $result = $this->validate($input_data, 'User.update_mine');
        if ($result !== VALIDATE_PASS) {
            // 验证失败 输出错误信息
            return apireturn(CODE_ERROR, $result, '');
        }
        $update_time = date("Y-m-d H:i:s", time());
        $data = array(
            'class'       => $input_data['class'],
            'qq'          => $input_data['qq'],
            'tel'         => $input_data['tel'],
            'email'       => $input_data['email'],
            'introduce'   => $input_data['introduce'],
            'message'     => $input_data['message'],
            'update_time' => $update_time,
        );
        $panel_user = Session::get('panel_user', 'ziqiang');
        $user = new UserModel();
        $rel = $user->update_user($panel_user['id'], $data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }
}