<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 23:55
 */
namespace app\api\model;
use think\Model;
use think\exception\PDOException;
class UserModel extends Model
{
    protected $table = 'user';

    /**
     * 用户注册
     * @param $data
     * @return array
     */
    public function add_user($data)
    {
        try {
            $info = $this->strict(false)->insertGetId($data);
            if ($info === false) {
                return ['code' => CODE_ERROR, 'msg' => '返回值异常', 'data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '注册成功', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR, 'msg' => '操作数据库异常', 'data' => $e->getMessage()];
        }
    }

    /**
     * 更新管理员信息
     * @param $userid
     * @param $data
     * @return array
     */
    public function update_user($userid, $data)
    {
        try{
            $info = $this ->where('id','=',$userid)->update($data);
            if($info === false){
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '更新成功', 'data' => $info];
            }
        } catch(PDOException $e){
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }

    /**
     * 删除某一个用户
     * @param $id
     * @return array
     */
    public function del_user($id)
    {
        $where = ['id' => $id];
        try{
            $info = $this->where($where)->delete();

            if($info === false){
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS,'msg'=>'删除成功','data'=>$info];
            }
        } catch (PDOException $e){
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }

}