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
    public function look_user()
    {
        $user_id = input('get.id');
        $user = new UserModel();
        $rel = $user->get_the_user($user_id);
        $rel = change_user_info($rel);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/look_user');
    }

    /**
     * 传入用户id，渲染编辑用户界面
     * @param Request $request
     * @return mixed
     */
    public function edit_user()
    {
        $user_id = input('get.id');
        $user = new UserModel();
        $rel = $user->get_the_user($user_id);
        $this->assign('id', $user_id);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/edit_user');
    }

    /**
     * 获取所有自强人信息
     * @param Request $request
     */
    public function get_all_user()
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
                $where['title|content'] = ['like', '%' . $val->value . '%'];
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




    /****************************个人信息*********************************/
    /**
     * 个人信息页面
     * @return mixed
     */
    public function mine()
    {
        $panel_user = Session::get('panel_user', 'ziqiang');
        $user_id = $panel_user['id'];
        $user = new UserModel();
        $rel = $user->get_the_user($user_id);
        $rel = change_user_info($rel);
        $this->assign('id', $user_id);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/mine');
    }
    
    /**
     * 更新个人信息
     * @param get $get
     * @return \think\response\Json
     */
    public function birth()
    {
        $user = new UserModel();
        $datetemp = $user->field('birthday')->select();
        $nametemp = $user->field('realname')->select();
        $i = 0;
        foreach($datetemp as $v){
            $date[$i] = intval($v['birthday'][5].$v['birthday'][6].$v['birthday'][8].$v['birthday'][9]) ;
            $name[$i] = $nametemp[$i]['realname'];
            $i++;
        }
        $data = array(
            'date' => $date,
            'name' => $name,
        );
        return $data;
    }
}