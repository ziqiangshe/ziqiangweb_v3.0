<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/25
 * Time: 10:24
 */
namespace app\api\controller;

use think\Db;
use think\Exception;
use think\Request;

class Upload extends Base
{

    /**
     * 上传头像
     * @param Request $request
     * @return \think\response\Json
     */
    public function upload_avatar(Request $request)
    {
        $move_path = MOVE_AVATAR;
        $get_path = GET_AVATAR;
        $file = $request->file('avatar');
        // 移动到框架应用根目录/public/upload/avatar/ 目录下
        if (empty($file)) {
            return apireturn(CODE_ERROR, '没有上传文件', "");
        }
        $info = $file->move($move_path);
        if ($info) {
            // 成功上传后 获取上传路径信息
            $path = $get_path.$info->getSaveName();
            $new_path = str_replace('\\',"/",$path);
            return apireturn(CODE_SUCCESS, '上传成功', $new_path);
        } else {
            // 上传失败获取错误信息
            return apireturn(CODE_ERROR, '上传失败', $info->getError());
        }
    }

    /**
     * 活动介绍图片上传
     * @param Request $request
     * @return \think\response\Json
     */
    public function upload_activity(Request $request)
    {
        $move_path = MOVE_ACTIVITY;
        $get_path = GET_ACTIVITY;
        $file = $request->file('activity');
        // 移动到框架应用根目录/public/upload/activity/ 目录下
        if (empty($file)) {
            return apireturn(CODE_ERROR, '没有上传文件', "");
        }
        $info = $file->move($move_path);
        if ($info) {
            // 成功上传后 获取上传路径信息
            $path = $get_path.$info->getSaveName();
            $new_path = str_replace('\\',"/",$path);
            return apireturn(CODE_SUCCESS, '上传成功', $new_path);
        } else {
            // 上传失败获取错误信息
            return apireturn(CODE_ERROR, '上传失败', $info->getError());
        }
    }

    /**
     * 自强照片上传
     * @param Request $request
     * @return \think\response\Json
     */
    public function upload_photo(Request $request)
    {
        $move_path = MOVE_PHOTO;
        $get_path = GET_PHOTO;
        $file = $request->file('photo');
        // 移动到框架应用根目录/public/upload/photo/ 目录下
        if (empty($file)) {
            return apireturn(CODE_ERROR, '没有上传文件', "");
        }
        $info = $file->move($move_path);
        if ($info) {
            // 成功上传后 获取上传路径信息
            $path = $get_path.$info->getSaveName();
            $new_path = str_replace('\\',"/",$path);
            return apireturn(CODE_SUCCESS, '上传成功', $new_path);
        } else {
            // 上传失败获取错误信息
            return apireturn(CODE_ERROR, '上传失败', $info->getError());
        }
    }
}