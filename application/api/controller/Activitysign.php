<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 12:22
 */
namespace app\api\controller;

use app\api\model\ActivitySignModel;
use app\api\model\UserModel;
use think\Request;
use think\Session;

class activitysign extends Base
{
    /**
     * 提交报名信息
     * @return \think\response\Json
     */
    public function create_activity_sign()
    {
        $input_data = input('post.');
        $result = $this->validate($input_data, 'activitysign.create_activity_sign');
        if ($result !== VALIDATE_PASS) {
            // 验证失败 输出错误信息
            return apireturn(CODE_PARAM_ERROR, $result, '');
        }

        $activity_id = $input_data['activity_id'];
        $name = $input_data['name'];
        $cardno = $input_data['cardno'];
        $sex = $input_data['sex'];
        $session = $input_data['session'];
        $major = $input_data['major'];
        $class = $input_data['class'];
        $dorm = $input_data['dorm'];
        $tel = $input_data['tel'];
        $qq = $input_data['qq'];
        $content = empty($input_data['content'])?"":$input_data['content'];
        $status = 0;
        $create_time = date("Y-m-d H:i:s", time());

        // TODO 每个卡号只可以报名一次

        $data = array(
            'activity_id' => $activity_id,
            'name' => $name,
            'cardno' => $cardno,
            'sex' => $sex,
            'session' => $session,
            'major' => $major,
            'class' => $class,
            'dorm' => $dorm,
            'tel' => $tel,
            'qq' => $qq,
            'content' => $content,
            'status' => $status,
            'create_time' => $create_time,
        );

        $activity_sign = new ActivitySignModel();
        $rel = $activity_sign->create_activity_sign($data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }

    /**
     * 编辑活动报名信息（状态）
     */
    public function edit_activity_sign() {
        $input_data = input('get.');
        $result = $this->validate($input_data, 'activitysign.edit_activity_sign');
        if ($result !== VALIDATE_PASS) {
            // 验证失败 输出错误信息
            MessageBox($result, -1);return;
        }
        $id = $input_data['id'];
        $data = array(
            'status'  => $input_data['status'],
        );
        // 检查权限
        $panel_user = Session::get('panel_user', 'ziqiang');
        if ($panel_user['role'] < 1) {
            MessageBox("权限不足，操作失败", -1);return;
        }
        $activity_sign = new ActivitySignModel();
        $rel = $activity_sign->update_activity_sign($id, $data);
        MessageBox($rel['msg'], -1);return;
    }
}