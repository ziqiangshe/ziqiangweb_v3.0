<?php
/**
 * api返回格式化函数
 * @param $errcode
 * @param $errmsg
 * @param $data
 * @param $status
 * @return \think\response\Json
 */
function apireturn($errcode, $errmsg, $data)
{
    return json([
        'errcode' => $errcode,
        'errmsg' => $errmsg,
        'data' => $data
    ]);
}