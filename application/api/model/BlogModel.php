<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/11
 * Time: 16:45
 */
namespace app\api\model;
use think\Model;
use think\exception\PDOException;
class BlogModel extends Model
{
    protected $table = 'blog';


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
        $field = ['b.id, b.title, b.authorid, b.summary, u.session, u.sex, u.realname, u.department,
         u.position, u.role, b.tagid, b.content, b.create_time, b.pageview'];
        try {
            $info = $this->alias('b')
                ->join($join)
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


    /**
     * 添加博客
     * @param $data
     * @return array
     */
    public function add_blog($data)
    {
        try {
            $info = $this->strict(false)->insertGetId($data);
            if ($info === false) {
                return ['code' => CODE_ERROR,'msg' => '添加过程错误','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '添加成功', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR, 'msg' => '操作数据库异常', 'data' => $e->getMessage()];
        }
    }

    /**
     * 编辑博客
     * @param $blog_id
     * @param $data
     * @return array
     */
    public function edit_blog($blog_id, $data)
    {
        try {
            $info = $this->where('id', '=', $blog_id)->update($data);
            if ($info === false) {
                return ['code' => CODE_ERROR,'msg' => '编辑过程错误','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '编辑成功', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR, 'msg' => '操作数据库异常', 'data' => $e->getMessage()];
        }
    }

    /**
     * 删除博客
     * @param $blog_id
     * @return array
     */
    public function del_blog($blog_id)
    {
        try {
            $info = $this->where('id', '=', $blog_id)->delete();
            if ($info === false) {
                return ['code' => CODE_ERROR,'msg' => '删除过程错误','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '删除成功', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR, 'msg' => '操作数据库异常', 'data' => $e->getMessage()];
        }
    }
}