<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 16:55
 */
namespace app\panel\model;

use think\Model;
use think\exception\PDOException;

class BlogtagModel extends Model
{
    protected $table = 'blog_tag';

    /**
     * 获取所有博客类型
     * @param $where
     * @param $offset
     * @param $limit
     * @return array
     */
    public function get_all_blog_tag($where, $offset, $limit)
    {
        try {
            $info = $this->where($where)
                ->limit($offset, $limit)
                ->order('order desc')
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
}
