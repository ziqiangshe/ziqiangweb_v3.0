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
}
