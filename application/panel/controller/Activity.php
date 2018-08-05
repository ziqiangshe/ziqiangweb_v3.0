<?php
/**
 * Created by PhpStorm.
 * User: 76871
 * Date: 2018/8/4
 * Time: 19:22
 */
namespace app\panel\controller;

use think\Controller;

class Activity extends Controller
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
            return apiReturn(0, "提交的数据不合法", "");
        }

        $data = array(
            'name'          => $data['name'],
            'image'         => $data['image'],
            'introduction'  => $data['introduction'],
        );

        //入库操作
        try {
            //查询是否有相同名称的活动
            $bool = model('Activity')->hasSameNameActivity($data['name']);
            //如果有同名活动，则替换，没有则新增
            if ($bool) {
                $res = model('Activity')->save($data, ['name' => $data['name']]);
            } else {
                $res = model('Activity')->insert($data);
            }

        }catch (\Exception $e) {
            return apiReturn(config('code.FAILURE'), '新增失败', "");
        }

        if ($res) {
            return apiReturn(config('code.SUCCESS'), "新增成功", 'OK');
        }else {
            return apiReturn(config('code.FAILURE'), '新增失败', "");
        }
    }

    /**
     * 获取活动详情
     * @return \json
     */
    public function get()
    {
        try {
            $activities = model('Activity')->field('name, image, introduction')->select();
        } catch (\Exception $e) {
            return apiReturn(config('code.FAILURE'), '查询失败', "");
        }

        if ($activities) {
            return apiReturn(config('code.SUCCESS'), "查询成功", $activities);
        } else {
            return apiReturn(config('code.FAILURE'), '查询失败', "");
        }
    }
}