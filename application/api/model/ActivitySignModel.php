<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 14:03
 */
namespace app\api\model;
use think\Model;
use think\exception\PDOException;
class ActivitySignModel extends Model
{
    protected $table = 'activity_sign';

    /**
     * 创建一条新的活动报名信息
     * @param $data
     * @return array
     */
    public function create_activity_sign($data)
    {
        try {
            $info = $this->strict(false)->insertGetId($data);
            if ($info === false) {
                return ['code' => CODE_ERROR, 'msg' => '返回值异常', 'data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '报名成功', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR, 'msg' => '操作数据库异常', 'data' => $e->getMessage()];
        }
    }

    /**
     * 更新活动报名信息状态
     * @param $id
     * @param $data
     * @return array
     */
    public function update_activity_sign($id, $data)
    {
        try{
            $info = $this ->where('id','=',$id)->update($data);
            if($info === false){
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '更新成功', 'data' => $info];
            }
        } catch(PDOException $e){
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }
}