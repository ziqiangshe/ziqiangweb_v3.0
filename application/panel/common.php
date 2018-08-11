<?php

function change_user_info(array $rel) {
    if (isset($rel['data']['sex'])) {
        if ($rel['data']['sex'] == 1) {
            $rel['data']['sex'] = '男';
        } else {
            $rel['data']['sex'] = '女';
        }

        if ($rel['data']['role'] == 2) {
            $rel['data']['role'] = '大狗官';
        } elseif ($rel['data']['role'] == 1) {
            $rel['data']['role'] = '狗官';
        } else {
            $rel['data']['role'] = '平民';
        }
    } else {
        foreach ($rel['data'] as $key => $val) {
            if ($rel['data'][$key]['sex'] == 1) {
                $rel['data'][$key]['sex'] = '男';
            } else {
                $rel['data'][$key]['sex'] = '女';
            }

            if ($rel['data'][$key]['role'] == 2) {
                $rel['data'][$key]['role'] = '大狗官';
            } elseif ($rel['data'][$key]['role'] == 1) {
                $rel['data'][$key]['role'] = '狗官';
            } else {
                $rel['data'][$key]['role'] = '平民';
            }
        }
    }
    return $rel;
}