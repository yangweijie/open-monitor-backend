# e-admin

## 开发

### 管理员id获取

~~~
use Eadmin\Admin;

Admin::id();
~~~

### 菜单

### 表格

#### 自定义按钮
~~~
$grid->actions(function (Actions $action, $data) {
    //隐藏删除按钮
    $action->hideDel();
    //创建一个按钮
    $button = Button::create('监控')
        ->type('primary')
        ->size('small')
        ->icon('el-icon-key')
        ->plain()
        // ->dialog()
        ->redirect('/admin/monitor/index', ['id'=>$data['id']])
        ->title('监控');
        // halt($data['id']);
        // halt(url('/admin/Monitor/index', ['id'=>$data['id']])->__toString());
    // $link = Link::create('会话')->href(url('/admin/monitor/index', ['id'=>$data['id']])->__toString());


    //追加前面
    $action->prepend($button);
    //追加后面
    // $action->append($button);
});
~~~
跳转链接 要用 redirect 才会带上header 参数  不然会报 grid 无法 转为字符串的bug

### 表单

#### 验证

~~~
->required() // 前端带星
~~~

~~~

$table = 'project';
$field = 'name';
$text  = "[字段]已重复";
$form->text('name','名称')->uniqueRule($table, $field, $text)
~~~~

#### 事件
要写 return 
设置器 要 给需要的字段 指定空值 保证data 里有该字段的key

### 图表


### 函数

|        函数名         |        作用       |
|-----------------------|-------------------|
| sysconf               | 获取设置系统配置  |
| redis                 | redis缓存         |
| sysqueue              | 系统队列          |
| admin_success         | 后台成功提示      |
| admin_error           | 后台错误提示      |
| admin_info            | 后台信息提示      |
| admin_warn            | 后台警告          |
| admin_warn_message    |                   |
| admin_success_message |                   |
| admin_error_message   |                   |
| admin_info_message    |                   |
| hex2rgba              | 十六进制转化为RGB |
| admin_trans           | 获取语言变量值    |
| rgbToHex              | RGB转 十六进制    |
| color_mix             | 混合颜色          |
| plug                  | 插件管理          |
| plug_url              | 插件url           |
