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

function nealy_days($before_days, $w = false, $d = false){
    $start = date('Y-m-d', strtotime("-{$before_days} day"));
    $end   = date('Y-m-d');

    // 通过开始 和结束来获取区间日期
    $xAxis    = [];
    $start    = new DateTime($start);
    $interval = new DateInterval('P1D');
    $end      = new DateTime($end);
    $period   = new DatePeriod($start, $interval, $end->modify('+1 day'));
    // dump($period);
    // die;
    foreach ($period as $date) {
        $row = [$date->format('Y-m-d')];
        if($w) $row[] = $date->format('w');
        if($d) $row[] = $date->format('d');
        $xAxis[] = $row;
    }
    return $xAxis;
}

// Route::resource('user', 'User');
// Route::resource('project', 'Project');

// Route::resource('project', 'Project')->middleware(['jwt']);
// Route::group('user', function () {
//     Route::get('user/<id>', 'user/read');
//     Route::put('user/<id>', 'user/update');
// })->middleware(['jwt']);
// Route::group('project', function(){
//     Route::post('/:id/hosts$', 'project/hosts');
//     Route::post('/:id/transactions/time-distribution$', 'project/occurrences');
// })->middleware(['jwt']);

// Route::group('transactions', function(){
//     Route::post('/:id$', 'transaction/transactions');
//     Route::post('/:id/performance$', 'transaction/performance');
//     Route::post('/:id/occurrences$', 'transaction/occurrences');
// })->middleware(['jwt']);

// Route::post('segements/:id$', 'segement/index')->middleware(['jwt']);

// Route::group('errors', function(){
//     Route::post('/:id/trend$', 'errors/trend');
// })->middleware(['jwt']);

// Route::get('user/<id>', 'user/read')->middleware(['jwt']);
// Route::put('user/<id>', 'user/update')->middleware(['jwt']);



// Route::any('project')->middleware(['jwt']);