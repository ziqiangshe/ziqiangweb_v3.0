<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 15:19
 */
namespace app\panel\controller;
use app\panel\model\ActivityModel;
use app\panel\model\ActivitySignModel;
use think\Controller;
use think\Request;
use app\panel\model\SignModel;

class Activitysign extends Base
{
    /****************************活动报名*********************************/
    public function index()
    {
        $activity_id = input('get.activity_id');
        $activity = new ActivityModel();
        $rel = $activity->field('name')->where(['id' => $activity_id])->find();
        $this->assign('activity_id', $activity_id);
        $this->assign('activity_name', $rel['name']);
        return $this->fetch('activity_sign/index');
    }

    public function look()
    {
        $id = input('get.id');
        $activity_id = input('get.activity_id');

        $activity = new ActivityModel();
        $info = $activity->field('name')->where(['id' => $activity_id])->find();

        $activity_sign = new ActivitySignModel();
        $rel = $activity_sign->get_the_activity_sign($id);
        $rel = change_activity_sign_info($rel);

        $this->assign('id', $id);
        $this->assign('activity_id', $activity_id);
        $this->assign('rel', $rel['data']);
        $this->assign('activity_name', $info['name']);

        return $this->fetch('activity_sign/look');
    }


    /**
     * 获取所有活动报名信息
     */
    public function activity_sign()
    {
        $input_data = input('post.aoData');
        $aoData = json_decode($input_data);
        $activity_id = input('get.activity_id');
        $offset = 0;
        $limit = 10;
        if ($activity_id == 0) {
            $where = [];
        } else {
            $where['activity_id'] = ['=', $activity_id];
        }
        //var_dump($input_data);
        foreach ($aoData as $key => $val) {
            if ($val->name == 'iDisplayStart')
                $offset = $val->value;
            if ($val->name == 'iDisplayLength')
                $limit = $val->value;
            if ($val->name == 'sSearch' && $val->value != "")
                $where['name'] = ['like', '%' . $val->value . '%'];
        }
        $activity_sign = new ActivitySignModel();
        $rel = $activity_sign->get_all_activity_sign($where, $offset, $limit);
        $rel = change_activity_sign_info($rel);
        $count = count($activity_sign->where($where)->select());
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;
        $response['data'] = $rel['data'];
        echo json_encode($response);
    }


}