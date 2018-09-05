<?php
namespace app\api\model;
use think\Model;
use think\exception\PDOException;

class SignModel extends Model
{
    protected $table = 'sign';

    private function std_class_object_to_array($stdclassobject)
    {
        $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
        $array = array();
        foreach ($_array as $key => $value) {
            $value = (is_array($value) || is_object($value)) ? $this->std_class_object_to_array($value) : $value;
            $array[$key] = $value;
        }

        return $array;
    }
    public function addsign($data)
    {
        try {
            $where = ['cardno' => $data['cardno']];
            $temp = $this->getsign($where,'','');
            $time = date("Y-m-d h:i:s");
            if($temp['data']){
                $info = $this->where($where)->update($data);
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
            else{
                $info = $this->strict(false)->insertGetId($data);
                if ($info === false) {
                    return ['code' => -1, 'msg' => $this->getError(), 'data' => $this->std_class_object_to_array($info)];
                } 
                else {
                    return ['code' => 0, 'msg' => 'Success', 'data' => $info];
                }
            }
        } 
        catch (PDOException $e) {
            return ['code' => -1, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    public function getsign($where, $offset, $limit)
    {
        try {
            $info = $this->where($where)
                ->limit($offset, $limit)
                ->select();
            if ($info === false) {
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $this->std_class_object_to_array($info)];
            } 
            else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $this->std_class_object_to_array($info)];
            }
        } 
        catch (PDOException $e) {
            return ['code' => -1, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    public function changestatus($signid, $status)
    {
        try {
            $info = $this->where('id', '=', $signid)->update(array('status'=>$status));
            if ($info === false) {
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } 
            else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } 
        catch (PDOException $e) {
            return ['code' => -1, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }

    public function getthesign($signid)
    {
        $where = ['id' => $signid];
        try {
            $info = $this->where($where)
                ->find();
            if ($info === false) {
                return ['code' => -1, 'msg' => $this->getError(), 'data' => $info];
            } 
            else {
                return ['code' => 0, 'msg' => 'Success', 'data' => $info];
            }
        } 
        catch (PDOException $e) {
            return ['code' => -1, 'msg' => $e->getMessage(), 'data' => ''];
        }
    }


}