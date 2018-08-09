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
    public function userlogin($username, $password)
    {
        $field = ['id, username, password, realname, sex, role, status'];
        try {
            $info = $this->field($field)
                ->where('username', '=', $username)
                ->where('password', '=', $password)
                ->find();
            if ($info === false || empty($info)) {
                return ['code' => CODE_ERROR, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR,'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    /**
     * 获取所有用户
     * @param $where
     * @param $offset
     * @param $limit
     * @return array
     */
    public function getalluser($where, $offset, $limit)
    {
        $field = ['id, username, realname, sex, class, session, position, role, status'];
        try {
            $info = $this->field($field)
                ->where($where)
                ->limit($offset, $limit)
                ->select();
            if ($info === false) {
                return ['code' => CODE_ERROR, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    /**
     * 获取某一个用户
     * @param $userid
     * @return array
     */
    public function gettheuser($userid)
    {
        $where['id'] = ['=', $userid];
        $field = ['username, realname, introduce, sex, class, qq, tel, email, session, position, role, status'];
        try {
            $info = $this
                ->field($field)
                ->where($where)
                ->find();
            if ($info === false) {
                return ['code' => CODE_ERROR, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }


    /****************************自强人物*********************************/

    /**
     * 获取自强人物
     * @return array
     */
    public function getcharacter()
    {
        $where = ['status' => 0];
        try{
            $info = $this->all($where);

            if($info === false){
                return ['code' => CODE_ERROR,'msg' => $this->getError(),'data' => $info];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e){
            return ['code' => CODE_ERROR, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    /**
     * 获取个人寄语
     * @param $id
     * @return array
     */
    public function mymessage($id)
    {
        $where = ['id' => $id];
        try{
            $info = $this->where($where)->find();
            $data = array([
                'realname' => $info['realname'],
                'introduce' => $info['introduce'],
            ]);
            if($info === false){
                return ['code' => CODE_ERROR,'msg' => $this->getError(),'data' => $info];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => 'Success', 'data' => $data];
            }
        } catch (PDOException $e){
            return ['code' => CODE_ERROR, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }


    /**
     * 上架自强人物[前置需要权限验证]
     * @param $id
     * @return array
     */
    public function oncharacter($id)
    {
        $where = ['id' => $id];
        try{
            $info = $this->where($where)->update(array('status'=>0));

            if($info === false){
                return ['code' => CODE_ERROR,'msg' => $this->getError(),'data' => $info];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e){
            return ['code' => CODE_ERROR, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    /**
     * 下架自强人物[前置需要权限验证]
     * @param $id
     * @return array
     */
    public function downcharacter($id)
    {
        $where = ['id' => $id];
        try{
            $info = $this->where($where)->update(array('status'=>1));

            if($info === false){
                return ['code' => CODE_ERROR,'msg' => $this->getError(),'data' => $info];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e){
            return ['code' => CODE_ERROR, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }
}
