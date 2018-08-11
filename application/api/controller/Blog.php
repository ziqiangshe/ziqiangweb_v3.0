<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/11
 * Time: 16:35
 */
namespace app\api\controller;

use app\api\model\BlogModel;
use think\Request;
use think\Session;

class Blog extends Base
{
    /**
     * 添加新博客
     * @param Request $request
     * @return \think\response\Json
     */
    public function add_blog(Request $request)
    {
        $title = $request->post('title');
        $tag = $request->post('tag');
        $content = $request->post('content');
        $summary = $request->post('summary');
        $panel_user = Session::get('panel_user');
        $author_id = $panel_user['id'];
        $created = date("Y-m-d H:i:s", time());
        $data = array(
            'title' => $title,
            'authorid' => $author_id,
            'tag' => $tag,
            'summary' => $summary,
            'content' => $content,
            'created' => $created
        );
        $blog = new BlogModel();
        $rel = $blog->add_blog($data);
        return apireturn($rel['code'], $rel['msg'], $rel['data'], 200);
//        return $this->fetch('blog/datatable');
    }

    /**
     * 编辑更新原博客
     * @param Request $request
     * @return \think\response\Json
     */
    public function edit_blog(Request $request)
    {
        $blog_id = $request->post('id');
        $title = $request->post('title');
        $tag = $request->post('tag');
        $summary = $request->post('summary');
        $content = $request->post('content');
        $created = date("Y-m-d H:i:s", time());
        $panel_user = Session::get('panel_user');
        $author_id = $panel_user['id'];
        $blog = new BlogModel();
        // 检查权限
        $old_author_id = $blog->where('id', '=', $blog_id)->value('authorid');
        if (!($old_author_id == $author_id)) {
            return apireturn(-1, '权限不足，操作失败', '', 200);
        }

        $data = array(
            'title' => $title,
            'authorid' => $old_author_id,
            'summary' => $summary,
            'tag' => $tag,
            'content' => $content,
            'created' => $created
        );
        $rel = $blog->edit_blog($blog_id, $data);
        return apireturn($rel['code'], $rel['msg'], $rel['data'], 200);
    }

    /**
     * 删除指定id的博客
     * @param Request $request
     * @return \think\response\Json
     */
    public function del_blog(Request $request)
    {
        $blog_id = $request->get('id');
        $panel_user = Session::get('panel_user');
        $author_id = $panel_user['id'];
        $blog = new BlogModel();
        // 检查权限
        $old_author_id = $blog->where('id', '=', $blog_id)->value('authorid');
        if (!($old_author_id == $author_id)) {
            return apireturn(-1, '权限不足，操作失败', '', 200);
        }
        $rel = $blog->del_blog($blog_id);
        return apireturn($rel['code'], $rel['msg'], $rel['data'], 200);
    }


}