<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/11
 * Time: 2:11
 */

namespace app\api\model;
use think\Model;
use think\exception\PDOException;
class CharacterModel extends Model
{
    protected $table = 'user';

    /**
     * 上架自强人物[前置需要权限验证]
     * @param $id
     * @return array
     */
    public function on_character($id)
    {
        $where = ['id' => $id];
        try {
            $info = $this->where($where)->update(array('status' => 1));

            if($info === false){
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '上架成功', 'data' => $info];
            }
        } catch(PDOException $e){
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }

    /**
     * 下架自强人物[前置需要权限验证]
     * @param $id
     * @return array
     */
    public function down_character($id)
    {
        $where = ['id' => $id];
        try {
            $info = $this->where($where)->update(array('status' => 0));

            if($info === false){
                return ['code' => CODE_ERROR,'msg' => '返回值异常','data' => $this->getError()];
            } else {
                return ['code' => CODE_SUCCESS, 'msg' => '下架成功', 'data' => $info];
            }
        } catch(PDOException $e){
            return ['code' => CODE_ERROR,'msg' => '操作数据库异常','data' => $e->getMessage()];
        }
    }

}