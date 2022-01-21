<?php
declare (strict_types = 1);

namespace app\model;

/**
 * @mixin \think\Model
 */
class Error extends BaseModel
{
    public static $types = [
        'stack' => 'json',
    ];

    // 设置json类型字段
    protected $json = ['stack'];


    public function setHashAttr($value, $data)
    {
        return md5("{$data['file']}{$data['line']}{$data['code']}{$data['message']}");
    }
}