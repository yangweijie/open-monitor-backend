<?php
use think\facade\Route;
Route::get('/',function (){
    return view('/index',['web_name'=>sysconf('system_web_name'),'multiApp'=>\Eadmin\Admin::getAppName()]);
});
