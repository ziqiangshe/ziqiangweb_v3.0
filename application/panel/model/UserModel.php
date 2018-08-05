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
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => -1,'msg' => $e->getMessage(), 'data' => ''];
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
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => -1, 'msg' => $e->getMessage(), 'data' => ''];
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
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => -1, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    /**
     * 删除某一个用户
     * @param $id
     * @return array
     */
    public function deluser($id)
    {
        $where = ['id' => $id];
        try{
            $info = $this->where($where)->delete();

            if($info === false){
                return ['code'=>-1,'msg'=>$this->getError(),'data'=>$info];
            } else {
                return ['code'=>0,'msg'=>'Success','data'=>$info];
            }
        } catch (PDOException $e){
            return ['code'=>-1,'msg'=>$e->getMessage(),'data'=>''];
        }
    }

    /**
     * 用户注册
     * @param $data
     * @return array
     */
    public function adduser($data)
    {
        try {
            $info = $this->strict(false)->insertGetId($data);
            if ($info === false) {
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => -1, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    /**
     * 更新管理员信息
     * @param $userid
     * @param $data
     * @return array
     */
    public function updateuser($userid, $data)
    {
        try{
            $info = $this ->where('id','=',$userid)->update($data);
            if($info === false){
                return ['code'=>-1,'msg'=>$this->getError(),'data'=>$info];
            } else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } catch(PDOException $e){
            return ['code'=>-1,'msg'=> $e->getMessage(),'data'=>''];
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
                return ['code'=>-1,'msg'=>$this->getError(),'data'=>$info];
            } else {
                return ['code'=>0,'msg'=>'Success','data'=>$info];
            }
        } catch (PDOException $e){
            return ['code'=>-1,'msg'=>$e->getMessage(),'data'=>''];
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
                return ['code'=>-1,'msg'=>$this->getError(),'data'=>$data];
            } else {
                return ['code'=>0,'msg'=>'Success','data'=>$data];
            }
        } catch (PDOException $e){
            return ['code'=>-1,'msg'=>$e->getMessage(),'data'=>''];
        }
    }

    /**
     * 编辑个人寄语
     * @param $id
     * @param $word
     * @return array
     */
    public function editmyword($id, $word)
    {
        try{
            $info = $this->where(['id'=>$id])->find();
            if($info === false){
                return ['code'=>-1,'msg'=>'编辑失败','data'=>''];
            } else {
                $info['introduce'] = $word;
                $info->save();
                return ['code'=>-1,'msg'=>'Success','data'=>$info];
            }
        } catch (PDOException $e){
            return ['code'=>-1,'msg'=>$e->getMessage(),'data'=>''];
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
                return ['code'=>-1,'msg'=>$this->getError(),'data'=>$info];
            } else {
                return ['code'=>0,'msg'=>'Success','data'=>$info];
            }
        } catch (PDOException $e){
            return ['code'=>-1,'msg'=>$e->getMessage(),'data'=>''];
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
                return ['code'=>-1,'msg'=>$this->getError(),'data'=>$info];
            } else {
                return ['code'=>0,'msg'=>'Success','data'=>$info];
            }
        } catch (PDOException $e){
            return ['code'=>-1,'msg'=>$e->getMessage(),'data'=>''];
        }
    }
}
