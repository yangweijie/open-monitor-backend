<?php
declare (strict_types=1);

namespace app\model;

/**
 * @mixin \think\Model
 */
class Transaction extends BaseModel
{

    // 设置json类型字段
    protected $json = ['host', 'context', 'http', 'last_record'];

    public static $types = [
        'host'        => 'json',
        'context'     => 'json',
        'http'        => 'json',
        'last_record' => 'json',
    ];

    public static function afterAddSegement($row)
    {
        // 更新统计 平均值 和 最后一次记录
        self::where('group_hash', $row['group_hash'])->update([
            'last_record' => $row,
        ]);
    }

    public function setGroupHashAttr($value, $data)
    {
        return encodeId($this->nextId());
    }
}