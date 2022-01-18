<?php
declare (strict_types = 1);

namespace app\model;

/**
 * @mixin \think\Model
 */
class Transaction extends BaseModel
{

    public static $types = [
        'host'        => 'json',
        'last_record' => 'json',
    ];

    public function setGroupHashAttr($value, $data)
    {
        return encodeId($this->nextId());
    }

    public static function afterAddSegement($row){
        $id = decodeId($row['group_hash']);
        if($id){
            // 更新统计 平均值 和 最后一次记录
            self::where('id', $id)->update([
                'last_record' => $row,
            ]);
        }
    }
}