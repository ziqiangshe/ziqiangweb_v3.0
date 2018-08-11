<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/11
 * Time: 16:02
 */
namespace app\panel\model;

use think\Model;
use think\exception\PDOException;

class BlogModel extends Model
{
    protected $table = 'blog';

    /**
     * 根据blog_id获取指定博客内容
     * @param $blog_id
     * @return array
     */
    public function get_the_blog($blog_id)
    {
        $where = ['b.id' => $blog_id];
        $join = [['user u', 'b.authorid=u.id']];
        $field = ['b.id, b.title, b.authorid, b.summary, u.realname,
         u.session, u.position, b.tag, b.content, b.created, b.pageview'];
        try {
            $info = $this->alias('b')
                ->join($join)
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
     * 根据传入具体条件获取博客条目
     * @param $where
     * @param $order
     * @param $offset
     * @param $limit
     * @return array
     */
    public function get_all_blog($where, $order, $offset, $limit)
    {
        $join = [['user u', 'b.authorid=u.id']];
        $field = ['b.id, b.title, b.authorid, b.summary, u.sex, u.realname, u.department,
         u.position, u.role, b.tag, b.content, b.create_time, b.pageview'];
        try {
            $info = $this->alias('b')
                ->join($join)
                ->field($field)
                ->where($where)
                ->order($order)
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

}