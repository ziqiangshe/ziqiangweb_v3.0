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
     * 个人寄语页面[已有内容显示]
     * @return mixed
     */
    public function editword()
    {
        $panel_user = Session::get('panel_user');
        $user = new UserModel();

        $rel = $user->where(['id'=>$panel_user['id']])->find();
        $this->assign('rel', $rel);
        return $this->fetch();
    }


    /**
     * 编辑提交个人寄语
     * @return \think\response\Json
     */
    public function edit()
    {
        $word = Request::instance()->get('myword');

        $panel_user = Session::get('panel_user');
        $user = new UserModel();
        $rel = $user->editmyword($panel_user['id'], $word);
        return apireturn($rel['code'],$rel['msg'],$rel['data']);

    }
    public function getmessage()
    {
        $user = new UserModel();
        $where = [];
        $rel['data'] = $user->where($where)->select();
        $count = count($user->where($where)->select());
        foreach ($rel['data'] as $key => $val) {
            if ($rel['data'][$key]['status'] == 0) {
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

    public function manage_lookword(Request $request)
    {
        $characterid = $request->get('id');
        $user = new UserModel();
        $rel = $user->where(['id'=>$characterid])->find();
        $this->assign('rel', $rel);
        return $this->fetch();
    }

    public function on()
    {
        $id = Request::instance()->get('id');

        $user = new UserModel();

        $panel_user = Session::get('panel_user');
        if ($panel_user['role'] < 1) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $rel = $user->oncharacter($id);
        return apireturn($rel['code'],$rel['msg'],$rel['data']);
    }

    public function down()
    {
        $id = Request::instance()->get('id');

        $user = new UserModel();
        $panel_user = Session::get('panel_user');
        if ($panel_user['role'] < 1) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $rel = $user->downcharacter($id);
        return apireturn($rel['code'],$rel['msg'],$rel['data']);
    }
}
