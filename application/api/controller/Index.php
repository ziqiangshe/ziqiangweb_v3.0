<?php
namespace app\api\controller;

use app\api\model\BlogModel;

class Index
{
    public function index()
    {
        echo "Hello World!";
    }

    public function todo()
    {
        MessageBox("功能待添加", -1);
    }
}
