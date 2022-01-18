<?php
// 应用公共文件
use Hashids\Hashids;
use think\Facade\Env;
use think\Facade\Route;

function decodeId($str){
    $hashids = new Hashids(Env::get('JWT.SECRET'));
    return $hashids->decode($str);
}

function encodeId($id){
    $hashids = new Hashids(Env::get('JWT.SECRET'));
    return $hashids->encode($id);
}

if(!function_exists('datetime')){
    // 方便生成当前日期函数
    function datetime($str = 'now', $formart = 'Y-m-d H:i:s') {
        if(is_string($str)){
            return @date($formart, strtotime($str));
        }else{
            return @date($formart, $str);
        }
    }
}

Route::resource('user', 'User');