<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/11
 * Time: 16:02
 */
namespace app\panel\controller;

use app\panel\model\BlogModel;
use think\Request;
use think\Session;

class Blog extends Base
{
    public function index()
    {
        $this->assign('tag_id', isset($_GET['tag_id']) ? $_GET['tag_id'] : 0);
        return $this->fetch('blog/index');
    }

    /**
     * 添加博客界面
     * @return mixed
     */
    public function add()
    {
        return $this->fetch('blog/add');
    }

    /**
     * 编辑博客界面
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        $blog_id = input('get.id');
        $blog = new BlogModel();
        $rel = $blog->get_the_blog($blog_id);
        $this->assign('rel', $rel['data']);
        return $this->fetch('blog/edit');
    }

    /**
     * 预览博客界面
     * @param Request $request
     * @return mixed
     */
    public function look(Request $request)
    {
        $blog_id = input('get.id');
        $blog = new BlogModel();
        $rel = $blog->get_the_blog($blog_id);
        $this->assign('rel', $rel['data']);
        return $this->fetch('blog/look');
    }

    /**
     * 根据tag_id|order_type获取博客内容
     * @param Request $request
     * @return \think\response\Json
     */
    public function get_blog(Request $request)
    {
        $input_data = input('post.aoData');
        $aoData = json_decode($input_data);
        $tag_id = $request->get('tag_id');
        $where = [];
        switch ($tag_id) {
            case 1:
                $tag = '技术'; break;
            case 2:
                $tag = '经验'; break;
            case 3:
                $tag = '杂谈'; break;
            default:
                $tag = null; break;
        }
        if (!empty($tag)) {
            $where['tag'] = ['=', $tag];
        }
        $offset = 0;
        $limit = 10;
        foreach ($aoData as $key => $val) {
            if ($val->name == 'iDisplayStart')
                $offset = $val->value;
            if ($val->name == 'iDisplayLength')
                $limit = $val->value;
            if ($val->name == 'sSearch' && $val->value != "")
                $where['title|content'] = ['like', '%'.$val->value.'%'];
        }
        // 1-按创建时间排序 2-按浏览量排序
        $order_type = empty($request->get('order_type'))?1:$request->get('order_type');
        $order = [];
        switch ($order_type) {
            case 1:
                $order = ['created desc'];break;
            case 2:
                $order = ['pageview desc'];break;
            default:
                break;
        }
        $blog = new BlogModel();
        $rel = $blog->get_all_blog($where, $order, $offset, $limit);
        $count = count($blog->where($where)->order($order)->select());
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;
        $response['data'] = $rel['data'];
        $response['inf'] = $aoData;
//        $response['tag'] = $tag_id;
        $response['where'] = $where;
        echo json_encode($response);
    }
}