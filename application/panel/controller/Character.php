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

    /**
     * 查看自强人物寄语内容
     * @param Request $request
     * @return mixed
     */
    public function manage_lookword(Request $request)
    {
        $characterid = $request->get('id');
        $user = new UserModel();
        $rel = $user->where(['id'=>$characterid])->find();
        $this->assign('rel', $rel);
        return $this->fetch();
    }

    /**
     * 上架自强人物
     * @return \think\response\Json
     */
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


    /**
     * 下架自强人物
     * @return \think\response\Json
     */
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
