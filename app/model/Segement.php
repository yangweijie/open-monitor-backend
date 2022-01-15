<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Segement extends Model
{
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    protected $dateFormat         = 'Y-m-d H:i:s';

    public static $types = [
        'context' => 'json',
        'host'    => 'json',
        'http'    => 'json',
    ];
}