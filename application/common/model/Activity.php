<?php
/**
 * Created by PhpStorm.
 * User: 76871
 * Date: 2018/8/4
 * Time: 20:00
 */
namespace app\common\model;

use think\Model;

class Activity extends Model
{
    /**
     * 查询数据库中是否存在相同名称的活动
     * @param string $name
     * @return bool
     */
    public function hasSameNameActivity($name = '')
    {
        $res = $this->where(['name' => $name])
            ->select();

        return $res ? true : false;
    }
}