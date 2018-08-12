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
     * 获取指定tag的博客内容
     * @return \think\response\Json
     */
    public function get_tag_blog()
    {
        // 获取tag、页数、条目数条件
        $tag = input('get.tag');
        $offset = input('get.offset');
        $limit = input('get.limit');
        $where = [];
        if ($tag != 0) {
            $where['tag'] = $tag;
        }
        if (!isset($offset)) {
            $offset = 0;
        }
        if (!isset($limit)) {
            $limit = 10;
        }
        // 按创建时间排序
        $order = ['create_time desc'];

        $blog = new BlogModel();
        $rel = $blog->get_all_blog($where, $order, $offset, $limit);
        $rel = change_user_info($rel);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);

    }

    /**
     * 添加新博客
     * @return \think\response\Json
     */
    public function add_blog()
    {
        $input_data = input('post.');
        $result = $this->validate($input_data, 'Blog.add_blog');
        if ($result !== VALIDATE_PASS) {
            // 验证失败 输出错误信息
            return apireturn(CODE_ERROR, $result, '');
        }
        $panel_user = Session::get('panel_user', 'ziqiang');
        $author_id = $panel_user['id'];
        $create_time = date("Y-m-d H:i:s", time());
        $blog = new BlogModel();
        $data = array(
            'title'       => $input_data['title'],
            'tag'         => $input_data['tag'],
            'summary'     => $input_data['summary'],
            'content'     => $input_data['content'],
            'authorid'    => $author_id,
            'create_time' => $create_time,
        );
        $rel = $blog->add_blog($data);
        return apireturn($rel['code'], $rel['msg'], $rel['data']);
    }

    /**
     * 编辑更新原博客
     * @return \think\response\Json
     */
    public function edit_blog()
    {
        $input_data = input('post.');
        $result = $this->validate($input_data, 'Blog.edit_blog');
        if ($result !== VALIDATE_PASS) {
            // 验证失败 输出错误信息
            return apireturn(CODE_ERROR, $result, '');
        }
        $panel_user = Session::get('panel_user', 'ziqiang');
        $author_id = $panel_user['id'];
        $update_time = date("Y-m-d H:i:s", time());
        $blog_id = $input_data['id'];

        $blog = new BlogModel();
        // 检查权限-MARK--这里最好也放在Model里面
        $old_author_id = $blog->where('id', '=', $blog_id)->value('authorid');
        if (!($old_author_id == $author_id)) {
            return apireturn(-1, '权限不足，操作失败', '');
        }
        $data = array(
            'title'       => $input_data['title'],
            'tag'         => $input_data['tag'],
            'summary'     => $input_data['summary'],
            'content'     => $input_data['content'],
            'authorid'    => $old_author_id,
            'update_time' => $update_time
        );
        $rel = $blog->edit_blog($blog_id, $data);
        return apireturn($rel['code'], $rel['msg'], $rel['data'], 200);
    }

    /**
     * 删除指定id的博客
     */
    public function del_blog()
    {
        $blog_id = input('get.id');
        $panel_user = Session::get('panel_user');
        $author_id = $panel_user['id'];

        $blog = new BlogModel();
        // 检查权限-MARK--这里最好也放在Model里面
        $old_author_id = $blog->where('id', '=', $blog_id)->value('authorid');
        if (!($old_author_id == $author_id)) {
            MessageBox('作者信息不匹配，操作失败', -1);
        }
        $rel = $blog->del_blog($blog_id);
        MessageBox($rel['msg'], -1);
    }

}