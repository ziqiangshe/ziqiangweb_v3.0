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

/**
 * 返回一个弹窗信息（解决dataTable返回问题）
 * @param $message
 * @param string $goto
 */
function MessageBox($message, $goto = '') {
    echo "<script type=\"text/javascript\">\n";
    echo "alert('{$message}');\n";
    if (intval($goto))
        echo "window.history.go({$goto});\n";
    else if ($goto != '')
        echo "document.location='{$goto}';\n";
    echo "</script>";
}