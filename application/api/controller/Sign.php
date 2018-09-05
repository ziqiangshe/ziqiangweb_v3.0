<?php
namespace app\api\controller;

use app\api\model\SignModel;
use think\Controller;
use think\Request;

class Sign extends Base
{

    public function addsign()
    {
        $info = input('post.');
        $created = date("Y-m-d h:i:s");
        $data = array(
            'name' => $info['name'],
            'sex' => $info['sex'],
            'class' => $info['class'],
            'cardno' => $info['cardNo'],
            'dept1' => $info['dept1'],
            'dept2' => $info['dept2'],
            'class' => $info['class'],
            'qq' => $info['qq'],
            'tel' => $info['tel'],
            'dorm' => $info['dorm'],
            'status' => 0,
            'content' => $info['content'],
            'create_time' => $created,
            'update_time' => $created
        );
        $finish = false;
        if($finish){
            return apiReturn(-1, "报名已经结束", '', 200);
        }
        else{
            $item = new SignModel();
            $where = ['cardno' => $data['cardno']];
            $temp = $item->getsign($where,'','');
            //halt($temp);
            if($temp['data'] && strtotime($temp['data'][0]['data']['update_time']) + 100 > strtotime($created)){
                
                return apiReturn(-1, "不要频繁提交", '', 200);
            }
            $rel = $item->addsign($data);
            return apireturn($rel['code'], $rel['msg'], $rel['data'], 200);
        }
    }

}