<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 15:19
 */
namespace app\panel\model;

use think\Model;
use think\exception\PDOException;

class ActivitySignModel extends Model
{
    protected $table = 'activity_sign';
    /**
     * 查询报名信息
     * @param $where
     * @param $offset
     * @param $limit
     * @return array
     */
    public function get_all_activity_sign($where, $offset, $limit)
    {
        try {
            $info = $this->where($where)
                ->limit($offset, $limit)
                ->order('status asc')
                ->select();
            if($info === false){
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '获取成功', 'data' => $info];
            }
        } catch(PDOException $e){
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }

    /**
     * 获取指定活动报名信息
     * @param $id
     * @return array
     */
    public function get_the_activity_sign($id)
    {
        $where['id'] = ['=', $id];
        try {
            $info = $this
                ->where($where)
                ->find();
            if($info === false){
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '获取成功', 'data' => $info];
            }
        } catch(PDOException $e){
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }
}