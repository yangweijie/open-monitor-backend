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
// Route::resource('project', 'Project');

Route::resource('project', 'Project')->middleware(['jwt']);
// Route::group('user', function () {
//     Route::get('user/<id>', 'user/read');
//     Route::put('user/<id>', 'user/update');
// })->middleware(['jwt']);
Route::group('project', function(){
    Route::post('/:id/transactions', 'project/transactions');
    Route::post('/:id/performance', 'project/performance');
})->middleware(['jwt']);


Route::get('user/<id>', 'user/read')->middleware(['jwt']);
Route::put('user/<id>', 'user/update')->middleware(['jwt']);



// Route::any('project')->middleware(['jwt']);