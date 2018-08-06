<?php
namespace app\panel\controller;

use think\Session;

class Index extends Base
{
    public function index()
    {
        $panel_user = Session::get('panel_user');
        $id = $panel_user['id'];
        $this->assign('id', $id);

        return $this->fetch();
    }
}
