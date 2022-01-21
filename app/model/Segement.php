<?php
declare (strict_types = 1);

namespace app\model;

/**
 * @mixin \think\Model
 */
class Segement extends BaseModel
{
    public static $types = [
        'host'    => 'json',
    ];

    // 设置json类型字段
    protected $json = ['host'];

    public function setHashAttr($value, $data)
    {
        return encodeId($this->nextId());
    }

    public static function onAfterInsert($row){
        // trace($row);
        Transaction::afterAddSegement($row);
    }
}