<?php
declare (strict_types = 1);

namespace app\model;

/**
 * @mixin \think\Model
 */
class Project extends BaseModel
{

    public static $types = [
        'platform' => 'json',
    ];

    public function setKeyAttr($value, $data)
    {
        $nextId = $this->nextId();
        trace($this->nextId());
        return encodeId($this->nextId());
    }

}