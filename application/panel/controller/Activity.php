<?php
/**
 * Created by PhpStorm.
 * User: 76871
 * Date: 2018/8/4
 * Time: 19:22
 */
namespace app\panel\controller;

use app\panel\model\ActivityModel;

class Activity extends Base
{
    /**
     * 活动添加函数
     * @return \json
     */
    public function add()
    {
        $data = input('post.');

        // validate
        $validate = validate('AdminUser');
        if (!$validate->check($data)) {
            return apireturn(0, "提交的数据不合法", "");
        }

        $data = array(
            'name'          => $data['name'],
            'image'         => $data['image'],
            'introduction'  => $data['introduction'],
        );

        //入库操作
        try {
            $activity = new ActivityModel();
            //查询是否有相同名称的活动
            $bool = $activity->hasSameNameActivity($data['name']);
            //如果有同名活动，则替换，没有则新增
            if ($bool) {
                $res = $activity->updateActivity($data);
            } else {
                $res = $activity->addActivity($data);
            }

        }catch (\Exception $e) {
            return apireturn(config('code.FAILURE'), '新增失败', "");
        }

        if ($res['code'] == 0) {
            return apireturn(config('code.SUCCESS'), "新增成功", 'OK');
        }else {
            return apireturn(config('code.FAILURE'), '新增失败', "");
        }
    }

    /**
     * 获取活动详情
     * @return \json
     */
    public function get()
    {
        try {
            $activity = new ActivityModel();
            $res = $activity->getAllActivity();
        } catch (\Exception $e) {
            return apireturn(config('code.FAILURE'), '查询失败', "");
        }

        if ($res['code'] == 0) {
            return apireturn(config('code.SUCCESS'), "查询成功", $res);
        } else {
            return apireturn(config('code.FAILURE'), '查询失败', "");
        }
    }
}