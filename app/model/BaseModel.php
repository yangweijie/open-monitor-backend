<?php
declare (strict_types = 1);
namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 * @mixin \think\Model
 */
class BaseModel extends Model{
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    protected $dateFormat         = 'Y-m-d H:i:s';

    public function nextId(){
        return self::max('id') + 1;
    }
}