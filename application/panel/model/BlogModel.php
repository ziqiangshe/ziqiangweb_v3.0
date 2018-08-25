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
         u.session, u.department, u.position, b.tagid, b.content, b.create_time, b.pageview'];
        try {
            $info = $this->alias('b')
                ->join($join)
                ->field($field)
                ->where($where)
                ->find();
            if ($info === false) {
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '获取成功', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
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
        $where['is_show'] = 0;
        $join_user = [['user u', 'b.authorid=u.id']];
        $join_tag = [['blog_tag t', 'b.tagid = t.id']];
        $field = ['b.id, b.title, b.authorid, b.summary, u.sex, u.realname, u.department,
         u.position, u.role, t.type, b.tagid, b.content, b.create_time, b.pageview'];
        try {
            $info = $this->alias('b')
                ->join($join_user)
                ->join($join_tag)
                ->field($field)
                ->where($where)
                ->order($order)
                ->limit($offset, $limit)
                ->select();
            if ($info === false) {
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '获取成功', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }

//    public function change_blog_tag(array $rel)
//    {
//    }
//
//    public function get_blog_tag()
//    {
//        try {
//            $info = $this->where(true)->select();
//            if ($info === false) {
//                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
//            } else {
//                return ['code' => CODE_SUCCESS, 'msg' => '获取成功', 'data' => $info];
//            }
//        } catch (PDOException $e) {
//            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
//        }
//    }

}