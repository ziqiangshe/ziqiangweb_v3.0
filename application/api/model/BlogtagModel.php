<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 17:18
 */
namespace app\api\model;

use think\Model;
use think\exception\PDOException;

class BlogtagModel extends Model
{
    protected $table = 'blog_tag';

    /**
     *  更新展示字段
     * @param $tag_id
     * @param $is_show
     * @return array
     */
    public function change_show_value($tag_id, $is_show)
    {
        try{
            $info = $this ->where('id','=',$tag_id)->update(['is_show'=>$is_show]);
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
     * 更新权重字段
     * @param $tag_id
     * @param $order
     * @return array
     */
    public function change_order_value($tag_id, $order)
    {
        try{
            $info = $this ->where('id','=',$tag_id)->setInc('order', $order);
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
     * 新建新的标签
     * @param $data
     * @return array
     */
    public function create_blog_tag($data)
    {
        try {
            $info = $this->strict(false)->insertGetId($data);
            if ($info === false) {
                return ['code' => CODE_ERROR, 'msg' => '返回值异常', 'data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '添加成功', 'data' => $info];
            }
        } catch (PDOException $e) {
            return ['code' => CODE_ERROR, 'msg' => '操作数据库异常', 'data' => $e->getMessage()];
        }
    }
}