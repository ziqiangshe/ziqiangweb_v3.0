<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 用户信息格式化-MARK--这里部分其实可以通过数据库来存储具体字段
 * @param array $rel
 * @return array
 */
function change_user_info(array $rel)
{
    if (!is_array($rel['data'])) {
        if (isset($rel['data']['sex'])) {
            if ($rel['data']['sex'] == 1 || $rel['data']['sex'] == '男') {
                $rel['data']['sex'] = '男';
            } else {
                $rel['data']['sex'] = '女';
            }
        }

        if (isset($rel['data']['role'])) {
            if ($rel['data']['role'] == SUPER_ADMIN) {
                $rel['data']['role'] = SUPER_ADMIN_NAME;
            } elseif ($rel['data']['role'] == GENERAL_ADMIN) {
                $rel['data']['role'] = GENERAL_ADMIN_NAME;
            } elseif ($rel['data']['role'] == CIVILIAN) {
                $rel['data']['role'] = CIVILIAN_NAME;
            }
        }

        if (isset($rel['data']['department']) && isset($rel['data']['position'])) {
            $rel['data']['position'] = $rel['data']['department'] . $rel['data']['position'];
        }

        if (isset($rel['data']['tagid'])) {
            switch ($rel['data']['tagid']) {
                case 1: $tag_name = "技术";break;
                case 2: $tag_name = "经验";break;
                case 3: $tag_name = "杂谈";break;
                default: $tag_name = "未分类";break;
            }
            $rel['data']['tag'] = $tag_name;
        }

        if (isset($rel['data']['status'])) {
            if ($rel['data']['status'] == 1) {
                $rel['data']['status'] = '已上架';
            } else {
                $rel['data']['status'] = '未上架';
            }
        }
    } else {
        foreach ($rel['data'] as $key => $val) {
            if (isset($rel['data'][$key]['sex'])) {
                if ($rel['data'][$key]['sex'] == 1 || $rel['data'][$key]['sex'] == '男') {
                    $rel['data'][$key]['sex'] = '男';
                } else {
                    $rel['data'][$key]['sex'] = '女';
                }
            }

            if (isset($rel['data'][$key]['role'])) {
                if ($rel['data'][$key]['role'] == SUPER_ADMIN) {
                    $rel['data'][$key]['role'] = SUPER_ADMIN_NAME;
                } elseif ($rel['data'][$key]['role'] == GENERAL_ADMIN) {
                    $rel['data'][$key]['role'] = GENERAL_ADMIN_NAME;
                } elseif ($rel['data'][$key]['role'] == CIVILIAN) {
                    $rel['data'][$key]['role'] = CIVILIAN_NAME;
                }
            }

            if (isset($rel['data'][$key]['department']) && isset($rel['data'][$key]['position'])) {
                $rel['data'][$key]['position'] = $rel['data'][$key]['department'] . $rel['data'][$key]['position'];
            }

            if (isset($rel['data'][$key]['tagid'])) {
                switch ($rel['data'][$key]['tagid']) {
                    case 1: $tag_name = "技术";break;
                    case 2: $tag_name = "经验";break;
                    case 3: $tag_name = "杂谈";break;
                    default: $tag_name = "未分类";break;
                }
                $rel['data'][$key]['tag'] = $tag_name;
            }

            // 0-下架 1-上架
            if (isset($rel['data'][$key]['status'])){
                if ($rel['data'][$key]['status'] == 1) {
                    $rel['data'][$key]['status'] = '已上架';
                } else {
                    $rel['data'][$key]['status'] = '未上架';
                }
            }
        }
    }
    return $rel;
}

/**
 * 活动报名信息格式化
 * @param array $rel
 * @return array
 */
function change_activity_sign_info(array $rel) {
    if (!is_array($rel['data'])) {

        if (isset($rel['data']['sex'])) {
            if ($rel['data']['sex'] == 1 || $rel['data']['sex'] == '男') {
                $rel['data']['sex'] = '男';
            } else {
                $rel['data']['sex'] = '女';
            }
        }

        if (isset($rel['data']['status'])) {
            if ($rel['data']['status'] == 0) {
                $rel['data']['status'] = '待处理';
            } elseif ($rel['data']['status'] == 1) {
                $rel['data']['status'] = '通过';
            } elseif ($rel['data']['status'] == 2) {
                $rel['data']['status'] = '拒绝';
            } else {
                $rel['data']['status'] = '未知状态';
            }
        }
    } else {
        foreach ($rel['data'] as $key => $val) {
            if (isset($rel['data'][$key]['sex'])) {
                if ($rel['data'][$key]['sex'] == 1 || $rel['data'][$key]['sex'] == '男') {
                    $rel['data'][$key]['sex'] = '男';
                } else {
                    $rel['data'][$key]['sex'] = '女';
                }
            }

            if (isset($rel['data'][$key]['status'])){
                if ($rel['data'][$key]['status'] == 0) {
                    $rel['data'][$key]['status'] = '待处理';
                } elseif ($rel['data'][$key]['status'] == 1) {
                    $rel['data'][$key]['status'] = '通过';
                } elseif ($rel['data'][$key]['status'] == 2) {
                    $rel['data'][$key]['status'] = '拒绝';
                } else {
                    $rel['data'][$key]['status'] = '未知状态';
                }
            }
        }
    }
    return $rel;
}
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