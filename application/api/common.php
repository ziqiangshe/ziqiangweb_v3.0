<?php
/**
 * 通用化API接口数据输出
 * @param $status
 * @param $message
 * @param array $data
 * @param int $httpCode
 * @return \think\response\Json
 */
function apireturn($status, $message, $data=[], $httpCode=200)
{
    return json([
        'status'  => $status,
        'message' => $message,
        'data'    => $data,
    ], $httpCode);
}