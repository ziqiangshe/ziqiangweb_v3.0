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
     * 根据tag_id|order_type获取博客内容
     */
    public function get_blog()
    {
        $input_data = input('post.aoData');
        $aoData = json_decode($input_data);
        $tag = input('get.tag_id');
        $where = [];
        if ($tag != 0) {
            $where['tagid'] = $tag;
        }
        // 按创建时间排序
        $order = ['create_time desc'];
        // 默认起始位置及条目数
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

        $blog = new BlogModel();
        $rel = $blog->get_all_blog($where, $order, $offset, $limit);
        $rel = change_user_info($rel);

        $count = count($blog->where($where)->order($order)->select());
        $response['recordsTotal'] = $count;
        $response['recordsFiltered'] = $count;
        $response['data'] = $rel['data'];
        // 由于数据字段为timestamp与datetime会导致序列化失败
        // 因此把/thinkphp/library/think/Model.php中line509的formatDateTime中$timestamp默认改为true
        echo json_encode($response);
    }
}