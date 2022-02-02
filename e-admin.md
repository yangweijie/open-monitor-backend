# e-admin

## 开发

### 管理员id获取

~~~
use Eadmin\Admin;

Admin::id();
~~~

### 菜单

### 表格

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