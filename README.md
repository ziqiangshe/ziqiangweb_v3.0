# ziqiangweb_v3.0

@Author: 谢泽丰

@Email: 616973936@qq.com

@Decription: 自强网站v3.0

@CreateTime: 2018/08/03

### NOTE

- 后台加一个自强相册如何？

## 开发概况

### 开发人员

前端人员：

- 陈中源[GitHub:chenzhongyuan]/[eolinker:1258502196@qq.com]
- 宋雨洁[GitHub:wut2017syj]/[eolinker:2250047931@qq.com]
- 周景尧[GitHub:zhouzhouzhouyao]/[eolinker:zhou13693908265@163.com]
- 阮心黎[GitHub:rxlelena]/[eolinker:935571464@qq.com]
- 郑成锋[GitHub:827752806]/[eolinker:827752806@qq.com]

后端人员：

- 谢泽丰[GitHub:XZFFF]/[eolinker:616973936@qq.com]
- 龙思杰[GitHub:lsj575]/[eolinker:768712778@qq.com]
- 李劲巍[GitHub:kdl12138]/[eolinker:ssbljw@163.com]
- 张明坤[GitHub:bmwanm123]/[eolinker:2687118914@qq.com]
- 林茂源[GitHub:MYDJJ]/[eolinker:1298469131@qq.com]

### 工作内容

- ~~前端所有页面的代码重构方案~~
- ~~后端给前端的接口以及后端自己的可视化后台~~
- ~~服务器的购置、配置和部署（保证不被QQ识别为危险）~~
- 网站接入百度统计，在可视化后台加入浏览情况折线图
- ~~用户信息加上出生年月，然后在用户管理中加入一个生日功能供查阅届数-每月生日成员~~
- ~~前端页面设计&优化讨论~~
- ~~彩蛋部分的讨论~~

### 工作分配

- 陈中源：~~网站主办块-首页&部门介绍&活动介绍&加入我们[PC/Phone]~~
- 周景尧：自强人物
- 郑成锋：~~自强博客~~
- 谢泽丰：~~后端通用框架搭建和函数的编写、用户管理接口&后台、自强人物接口&后台~~、用户系统加入头像、~~博客标签联动、活动单开一个表开发活动报名~~
- 龙思杰：~~数据库的编写和调优、活动接口&后台~~
- 李劲巍：~~了解不被QQ识别危险的云服务器的购置、配置和部署、加入我们[即报名信息]接口&后台~~
- 张明坤：~~自强博客接口&后台~~
- 林茂源：~~部门介绍接口&后台~~

### 开发技术

前端框架：Vue

后端框架：ThinkPHP

### 开发规范

### Git

- Git提交规范：https://www.imooc.com/article/16780
- Git不要直接在主分支修改，建立自己的分支，每隔一段时间合并一次
- SourceTree新建分支与分支合并：https://blog.csdn.net/qq_34975710/article/details/74469068
- Git的用户名后面带上个人邮箱
- Git有问题可以报issue在项目上

### API

- API在线工具：https://www.eolinker.com/

### PHP

- PHP代码规范：https://github.com/PizzaLiu/PHP-FIG/blob/master/PSR-2-coding-style-guide-cn.md

## 后端代码规范[重点]

### 注释！！！

- 函数注释，示例如下：

```php
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
```

注：在PhpStorm中函数上一行输入`/**`后回车，自动生成变量及返回注释，再加上函数的作用`api返回格式化函数`即可

- 语句注释，示例如下：

```php
// 检查权限
$panel_user = Session::get('panel_user');
if ($panel_user['role'] < 1) {
    return apireturn(-1, '权限不足，操作失败', '');
}
```



### 文件命名&函数命名&变量命名

- 文件命名中Controller使用



- 函数的命名使用下划线连接各个小写单词，示例如下：

```php
/**
* 传入用户id，渲染编辑用户界面
* @param Request $request
* @return mixed
*/
public function edit_user()
{
    $user_id = input('get.id');
    $user = new UserModel();
    $rel = $user->get_the_user($userid);
    $this->assign('id', $user_id);
    $this->assign('rel', $rel['data']);
    return $this->fetch('user/edit_user');
}
```



- 非define的变量使用下划线连接各个小写单词，示例如下：

```php
$panel_user = Session::get('panel_user');
$user_id = $panel_user['id'];
```



- define的变量使用下划线连接各个大写单词，示例如下：

```php
define("VALIDATE_PASS", true);
define("VALIDATE_ERROR", false);
define("CODE_SUCCESS", 0);
define("CODE_ERROR", -1);
```



### 控制器与模型

- **！全部写在panel下面！**
- 有且只有Model层与数据库直接产生交互（Model层需要try..catch，样例如下）

```php
/**
* 用户登录
* @param $username
* @param $password
* @return array
*/
public function user_login($username, $password)
{
    $field = ['id, username, password, realname, sex, role, status'];
    try {
        $info = $this->field($field)
            ->where('username', '=', $username)
            ->where('password', '=', $password)
            ->find();
        if ($info === false || empty($info)) {
            return ['code' => CODE_ERROR, 'msg' => $this->getError(), 'data' => $info];
        } else {
            return ['code' => CODE_SUCCESS, 'msg' => 'Success', 'data' => $info];
        }
    } catch (PDOException $e) {
        return ['code' => CODE_ERROR,'msg' => $e->getMessage(), 'data' => ''];
    }
}
```



### 定义变量&常用函数

在application/模块名/config.php中定义后台全局变量及模板参数替换，示例如下：

```php
define("VALIDATE_PASS", true);
define("VALIDATE_ERROR", false);
//配置文件
return [
    //模板参数替换
    'view_replace_str'       => array(
        '__PANEL__'=>'/ziqiangweb_v3.0/public/index.php/panel',
      ),
]
```



在application/模块名/common.php中定义常用函数，示例如下：

```php
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
```





### 获取请求数据

使用TP框架中的助手函数获取请求接口传来的数据

参考：https://www.kancloud.cn/manual/thinkphp5/118044

get/post：

```php
input('get.username'); // 获取get类型中name为username的数据
input('get.'); // 获取所有get请求发来的数据
```

```php
input('post.username'); // 获取post类型中name为username的数据
input('post.'); // 获取所有post请求发来的数据
```



### 数据验证



#### 控制器中的数据验证

参考：https://www.kancloud.cn/manual/thinkphp5/129354

controller中代码：

验证核心代码：

```php
$result = $this->validate($data,'Vtest'); // 用/application/common/validate/Vtest验证器中的验证格式来验证
```

场景验证代码：

```php
// 根据场景进行验证
$result = $this->validate($data, 'Vtest.add');
if(true !== $result){
    // 验证失败 输出错误信息
}
```



validate验证代码：（放在/application/common/validate下）

```php
namespace app\common\validate;

use think\Validate;

class Vtest extends Validate
{
    // 提交规则，|号之间不能加多余符号，包括空格
    protected $rule = [
        'username'    => 'require|max:40',
        'password' => 'require',
        'email'   => 'email',

    ];

    // 不符规则的错误提示
    protected $message = [
        'username.require'  =>  '必须输入用户名',
        'username.max'     => '名称最多不能超过25个字符',
        'password.require' => '必须输入密码',
        'email.email' =>  '邮箱格式错误',
    ];

    // 场景验证
    protected $scene = [
        'add'   =>  ['username','email'], // 必须输入用户名且长度不可超过40，可选输入邮箱但格式必须正确
        'edit'  =>  ['email', 'password'], // 必须输入用户名及密码
    ];

}
```

注：在验证文件中，必须有rule变量、message变量，场景验证可选



#### 模型中的数据验证

参考：https://www.kancloud.cn/manual/thinkphp5/129355

注：由于验证方式与控制器验证基本一致，因此不再赘述，但是在调用验证时，调用方式统一成如下格式，即写明验证器名称！

```php
// 调用Member验证器类进行数据验证
$result = $User->validate('Member')->save($data);
```

### 路由

路由规则严格按照RESTfulAPI。

在app目录下的route.php进行路由定义

具体格式参考：

```php
/**
 * 活动相关路由
 */
//添加活动
Route::post('panel/activity', 'panel/activity/add');
//查询活动
Route::get('panel/activity', 'panel/activity/get');
```

路由也要加注释！！！



# 网页设计

## 网站主板块[PC]

### Note：

- 使用fullPage进行部门介绍&活动介绍的开发https://alvarotrigo.com/fullPage/#page3
- 导航栏分为主页，部门介绍，活动介绍，加入我们。

### 首页

#### 顶栏

- 顶栏部分分为主页，部门介绍，活动介绍，加入我们
- 当页面下滑时，顶栏固定，可以在其他内容之间切换
- 点击顶栏自强社图标跳转到自强博客
- 背景用自强社的图片充当背景

#### 部门介绍

- 使用全屏式展示所有部门，纯色作为背景填充

### 活动介绍

- 活动介绍样式参考之前版本，不同之处在于图片和内容左右排版

#### 底栏

- 底栏参考 https://github.com 的底栏，左边为自强社的相关连接，右边是友情链接

#### 其他

- 各类图标素材上 http://www.iconfont.cn 找

### 加入我们

- 优化加入我们界面
- 最好可以是竖着的，目前横着的有两列有三列的排版太难受了



## 网站主板块[Phone]

### Note：

- 底栏部分与PC端保持一样的风格

### 首页

- 首页图为单张图片，右侧有一个上下滑动的导航条，可以切换至部门介绍，活动介绍，加入我们。

### 部门介绍

- 每个部门一屏，使用fullPage进行侧栏的控制的跳转[服务队要第一个]

### 活动介绍

- 与部门介绍类似，每个活动一屏，但是样式最好跟部门介绍不要完全一样
- 部门介绍下面如果位置较多，可以考虑使用部门Tag

### 加入我们

- 加入我们希望可以对移动端做好适配！！！
- 最好可以对用户信息进行缓存，不至于突然刷新就啥都没有了
- 用户跳出加入我们页面时，提示用户可能会导致已填写数据丢失



## 自强人物

- 界面UI参考http://periodic.famo.us/
- 卡片漂浮、卡片球、卡片螺旋等效果可以选择
- 一定要是响应式！



## 自强博客

- 每页10条博客记录，加入头像
- 博客侧边加入按浏览量推荐模快和按Tag分类模块
- 下拉后出现置顶按钮
- 一定要是响应式！



## 彩蛋

<<<<<<< HEAD
- 宣传过程中，开发一个测一测大学能不能找到女朋友的页面，然后跳转到自强网页

- ~~F12的console写上一些有趣的内容~~

- 自强人物里面加入自强社人的随机照片

- 移动端在加入我们页面下拉两次（都要有提示）后进入隐藏页面，隐藏页面跳转到彩蛋世界界面

- 进入彩蛋世界的时候，提示需要获取手机壳颜色

- 彩蛋世界可以有入口进入自强人物页以及自强博客页

- 彩蛋世界点击某个地方会进入到一个无限弹窗的页面

- 彩蛋世界点击某个彩蛋可以玩连连看自强人？（反正如果我来开发，思杰の照片只能跟阮匹配

  
=======
- ~~F12 console彩蛋~~
- 自强人物+随机照片
- 移动端在首页下拉两次后进入隐藏页面，隐藏页面跳转到自强人物页以及自强博客页
>>>>>>> czy
