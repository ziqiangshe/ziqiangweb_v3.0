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

class user extends Base
{
    /****************************用户管理*********************************/

    public function ziqiang()
    {
        $this->assign('ses', isset($_GET['ses']) ? $_GET['ses'] : 0);
        return $this->fetch('user/ziqiang');
    }

    public function create()
    {
        return $this->fetch('user/create');
    }

    public function lookuser(Request $request)
    {
        $userid = $request->get('id');
        $user = new UserModel();
        $rel = $user->gettheuser($userid);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/lookuser');
    }

    public function edituser(Request $request)
    {
        $userid = $request->get('id');
        $user = new UserModel();
        $rel = $user->gettheuser($userid);
        $this->assign('id', $userid);
        $this->assign('rel', $rel['data']);
        return $this->fetch('user/edituser');
    }


    public function createuser(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $realname = empty($request->get('realname'))?'':$request->get('realname');
        $session = $request->get('session');
        $sex = $request->get('sex');
        $position = $request->get('position');
        $position = $position.'成员';
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

    public function getalluser(Request $request)
    {
        $aoData = json_decode($request->post('aoData'));
        $ses = $request->get('ses');
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


    public function updateuser(Request $request)
    {
        $info = $request->get();
        $data = array(
            'position' => $info['position'],
            'role' => $info['role']
        );
        // 检查权限
        $panel_user = Session::get('panel_user');
        if ($panel_user['role'] < 2) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $user = new UserModel();
        $rel = $user->updateuser($info['id'], $data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }

    /*******************************个人信息*********************************/

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

    public function updatemine(Request $request)
    {
        $info = $request->get();
        $data = array(
//            'realname' => $info['realname'],
//            'sex' => $info['sex'],
//            'introduce' => $info['introduce'],
            'class' => $info['class'],
            'qq' => $info['qq'],
            'tel' => $info['tel'],
            'email' => $info['email'],
        );
        $panel_user = Session::get('panel_user');
        $myid = $panel_user['id'];
        if ($myid != $info['id']) {
            return apireturn(-1, '权限不足，操作失败', '', 200);
        }
        $user = new UserModel();
        $rel = $user->updateuser($info['id'], $data);
        return apireturn($rel['code'], $rel['msg'], $rel['data'], 200);
    }



    /******************************************************************

    public function index()
    {
        return $this->fetch('user/index');
    }

    public function add()
    {
        return $this->fetch('user/add');
    }


    public function update(Request $request)
    {
        $userid=$request->get('id');
        $user=new UserModel();
        $rel=$user->findtheuser($userid);
        $this->assign('rel',$rel['data']);
        return $this->fetch('user/update');
    }


    //???
    public function test(Request $request)
    {
        $userid = $request->get('id');
        $user = new UserModel();
        $rel = $user->findtheuser($userid);
        $this->assign('name',$rel['data']);
        return $this->fetch('user/test');
    }


    
    //添加用户
    public function adduser(Request $request)
    {
        $id = $request->get('id');
        $realname = $request->get('realname');
        $sex = $request->get('sex');
        $introduce = $request->get('introduce');
        $class = $request->get('class');
        $qq = $request->get('qq');
        $tel = $request->get('tel');
        $email = $request->get('email');
        $position = $request->get('position');
        $created = date("Y-m-d H:i:s",time());
        $role = $request->get('role');
        $data = array(
            'userid' => $id,
            'realname' => $realname,
            'sex' => $sex,
            'introduce' => $introduce,
            'class' => $class,
            'qq' => $qq,
            'tel' => $tel,
            'emial' => $email,
            'position' => $position,
            'created' => $created,
            'role' => $role,
        );
        $user = new UserModel();
        $rel = $user->adduser($data);
        return apireturn($rel['code'],$rel['meg'],$rel['data'],200);
    }

    //更新用户信息
    public function updateuser(Request $request)
    {
        $userid = $request->get('id');
        $realname = $request->get('realname');
        $sex = $request->get('sex');
        $introduce = $request->get('introduce');
        $class = $request->get('class');
        $qq = $request->get('qq');
        $tel = $request->get('tel');
        $email = $request->get('email');
        $position = $request->get('position');
        $created = date("Y-m-d H:i:s",time());
        $role = $request->get('role');
        $user = new UserModel();
        //权限控制，只有超级管理员可以管理自强人物信息
        $supermanager=$user->where('realname','=','廖虎成')->value('rel');
        if(!($supermanager==rel))
        {
            return apireturn(-1,'权限不足','rel',200);
        }

        $data = array(
            'userid' => $userid,
            'realname' => $realname,
            'sex' => $sex,
            'introduce' => $introduce,
            'class' => $class,
            'qq' => $qq,
            'tel' => $tel,
            'emial' => $email,
            'position' => $position,
            'created' => $created,
            'role' => $role,
        );

        $rel = $user->updateuser($userid,$data);
        return apireturn($rel['code'],$rel['msg'],$rel['data'],200);
    }

    //以学号为关键词获取某一位用户
    public function findtheuser(Request $request)
    {
        $userid = $request->get('id');
        $user = new UserModel();
        $rel = $user->findtheuser($userid);
        return apireturn($rel['code'],$rel['msg'],$rel['data']);
    }*/




    /**************自强人物管理******************/
    public function getselfreliant()
    {
        //$role = Request::instance()->param('role');

        $user = new UserModel;
        $rel = $user->getcharacter();
        return apireturn($rel['code'],$rel['msg'],$rel['data'],200);
    }


}