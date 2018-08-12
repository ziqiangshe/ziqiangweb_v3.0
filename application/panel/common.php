<?php
/**
 * 用户信息格式化-MARK--这里部分其实可以通过数据库来存储具体字段
 * @param array $rel
 * @return array
 */
function change_user_info(array $rel) {
    if (!is_array($rel['data'])) {
        if (isset($rel['data']['sex'])) {
            if ($rel['data']['sex'] == 1) {
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

        if (isset($rel['data']['tag'])) {
            switch ($rel['data']['tag']) {
                case 1: $tag_name = "技术";break;
                case 2: $tag_name = "经验";break;
                case 3: $tag_name = "杂谈";break;
                default: $tag_name = "未分类";break;
            }
            $rel['data']['tag'] = $tag_name;
        }
    } else {
        foreach ($rel['data'] as $key => $val) {
            if (isset($rel['data'][$key]['sex'])) {
                if ($rel['data'][$key]['sex'] == 1) {
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

            if (isset($rel['data'][$key]['tag'])) {
                switch ($rel['data'][$key]['tag']) {
                    case 1: $tag_name = "技术";break;
                    case 2: $tag_name = "经验";break;
                    case 3: $tag_name = "杂谈";break;
                    default: $tag_name = "未分类";break;
                }
                $rel['data'][$key]['tag'] = $tag_name;
            }
        }
    }
    return $rel;
}