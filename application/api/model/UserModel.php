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
}