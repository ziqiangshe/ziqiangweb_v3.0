<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/5
 * Time: 14:13
 */

namespace app\panel\model;

use think\Model;
use think\exception\PDOException;

class UserModel extends Model
{
    protected $table = 'user';

    /**
     * 用户登录
     * @param $username
     * @param $password
     * @return array
     */
    public function user_login($username, $password)
    {
        $field = ['id, username, password, realname, sex, role, status'];
        try {
            $info = $this->field($field)
                ->where('username', '=', $username)
                ->where('password', '=', $password)
                ->find();
            if ($info === false || empty($info)) {
                    return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
                } else {
                    return ['code' => CODE_SUCCESS, 'msg' => '登录成功', 'data' => $info];
                }
            } catch(PDOException $e){
                return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
            }
    }

    /**
     * 获取所有用户
     * @param $where
     * @param $offset
     * @param $limit
     * @return array
     */
    public function get_all_user($where, $offset, $limit)
    {
        $field = ['id, username, realname, sex, class, session, department, position, role, status'];
        try {
            $info = $this->field($field)
                ->where($where)
                ->limit($offset, $limit)
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
     * 获取某一个用户
     * @param $userid
     * @return array
     */
    public function get_the_user($userid)
    {
        $where['id'] = ['=', $userid];
        $field = ['username, realname, introduce, message, sex, class, 
        qq, tel, email, session, department, position, role, status'];
        try {
            $info = $this
                ->field($field)
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


    /****************************自强人物*********************************/

    /**
     * 获取自强人物
     * @return array
     */
    public function get_character()
    {
        $where = ['status' => 0];
        try {
            $info = $this->all($where);

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
     * 获取个人寄语
     * @param $id
     * @return array
     */
    public function my_message($id)
    {
        $where = ['id' => $id];
        try {
            $info = $this->where($where)->find();
            $data = array([
                'realname' => $info['realname'],
                'introduce' => $info['introduce'],
            ]);
            if($info === false){
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '获取成功', 'data' => $data];
            }
        } catch(PDOException $e){
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }

}
