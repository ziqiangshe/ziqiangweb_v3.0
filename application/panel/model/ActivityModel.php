<?php
/**
 * Created by PhpStorm.
 * User: 76871
 * Date: 2018/8/9
 * Time: 10:23
 */
namespace app\panel\model;

use think\Env;
use think\exception\PDOException;
use think\Model;

class ActivityModel extends Model
{
    protected $table = 'activity';

    /**
     * 获得所有活动信息
     * @return array
     * @throws \Exception
     */
    public function getAllActivity()
    {
        $field = ['name, image, introduction'];
        try {
            $info = $this->field($field)
                ->select();
            if ($info === false) {
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * 查询数据库中是否存在相同名称的活动
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function hasSameNameActivity($name = '')
    {
        try {
            $res = $this->where(['name' => $name])
                ->select();
            return $res ? true : false;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    /**
     * 更新活动信息
     * @param $data
     * @return array
     * @throws PDOException
     */
    public function updateActivity($data)
    {
        try {
            $info = $this->save($data, ['name' => $data['name']]);
            if ($info === false) {
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function addActivity($data)
    {
        try {
            $info = $this->strict(false)->insertGetId($data);
            if ($info === false) {
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }
}