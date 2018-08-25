<?php
namespace app\panel\controller;
use think\Controller;
use think\Request;
use app\panel\model\SignModel;

class Sign extends Base
{
    public function index()
    {
        $id = input('get.id');
        $this->assign('id', $id);
        return $this->fetch('sign/index');
    }

    public function addsign()
    {
        $info = Request::instance()->get();
        $created = time();
        $data = array(
            'name' => $info['name'],
            'sex' => $info['sex'],
            'class' => $info['class'],
            'cardNo' => $info['cardNo'],
            'dept1' => $info['dept1'],
            'dept2' => $info['dept2'],
            'class' => $info['class'],
            'date' => $info['date'],
            'qq' => $info['qq'],
            'tel' => $info['tel'],
            'dorm' => $info['dorm'],
            'status' => 0,
            'content' => $info['content'],
            'create_time' => $created,
            'update_time' => $created
        );
        $finish = true;
        if($finish){
            return apiReturn(-1, "报名已经结束", '', 200);
        }
        else{
            $item = new SignModel();
            $where = ['cardNo' => $data['cardNo']];
            $temp = $item->getsign($where);
            if($temp && $temp['update_time'] + 1000 > $created){
                return apiReturn(-1, "不要频繁提交", '', 200);
            }
            $rel = $item->addsign($data);
            return apireturn($rel['code'], $rel['msg'], $rel['data'], 200);
        }
    }
    public function look_sign()
    {
        $id = input('get.id');
        
        switch($id){
            case 1:
                $where['dept1|dept2'] = ['like', '%服务队%'];
                $this->get($where);
                break;
            case 2:
                $where['dept1|dept2'] = ['like', '%外联部%'];
                $this->get($where);
                break;
            case 3:
                $where['dept1|dept2'] = ['like', '%宣传部%'];
                $this->get($where);
                break;
            case 4:
                $where['dept1|dept2'] = ['like', '%办公室%'];
                $this->get($where);
                break;
            case 5:
                $where['dept1|dept2'] = ['like', '%策划部%'];
                $this->get($where);
                break;
            case 10:
                $where['dept1|dept2'] = ['like', '%旧书圆新梦%'];
                $this->get($where);
                break;
            case 11:
                $where['dept1|dept2'] = ['like', '%义务家教%'];
                $this->get($where);
                break;
            case 12:
                $where['dept1|dept2'] = ['like', '%义务卖报%'];
                $this->get($where);
                break;
            case 13:
                $where['dept1|dept2'] = ['like', '%网页大赛%'];
                $this->get($where);
                break;
            case 14:
                $where['dept1|dept2'] = ['like', '%演讲比赛%'];
                $this->get($where);
                break;
            case 15:
                $where['dept1|dept2'] = ['like', '%义务维修%'];
                $this->get($where);
                break;
            default:
                break;
        }
    }
    public function look()
    {
        $id = input('get.id');
        $sign = new SignModel();
        $rel = $sign->getthesign($id);
        $rel = change_user_info($rel);
        $this->assign('rel', $rel['data']);
        return $this->fetch('sign/look');
    }
    private function get($where)
    {
        $item = new SignModel();
        $rel = $item->getsign($where,'','');
        $count = count($rel['data']);
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;
        $response['data'] = $rel['data'];
        echo json_encode($response);
    }

    /****************************活动报名*********************************/
    public function activity_sign() {
        $input_data = input('post.aoData');
        $aoData = json_decode($input_data);
        $activity_id = input('get.activity_id');
        $offset = 0;
        $limit = 10;
        if ($activity_id == 0) {
            $where = [];
        } else {
            $where['activity_id'] = ['=', $activity_id];
        }
        foreach ($aoData as $key => $val) {
            if ($val->name == 'iDisplayStart')
                $offset = $val->value;
            if ($val->name == 'iDisplayLength')
                $limit = $val->value;
            if ($val->name == 'sSearch' && $val->value != "")
                $where['name'] = ['like', '%' . $val->value . '%'];
        }
        $user = new SignModel();
        $rel = $user->get_all_activity_sign($where, $offset, $limit);
        $rel = change_user_info($rel);
        $count = count($user->where($where)->select());
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;
        $response['data'] = $rel['data'];
        echo json_encode($response);
    }

    public function activity_look() {

    }
}