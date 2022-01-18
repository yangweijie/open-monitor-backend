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

    public function setHashAttr($value, $data)
    {
        return encodeId($this->nextId());
    }

    public static function onAfterInsert($row){
        Transaction::afterAddSegment($row);
    }
}