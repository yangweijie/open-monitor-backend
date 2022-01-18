<?php
declare (strict_types = 1);

namespace app\model;

/**
 * @mixin \think\Model
 */
class User extends BaseModel
{
    public static $types = [
        'config' => 'json',
        'keys'   => 'json'
    ];

    public function setPasswordAttr($value, $data)
    {
        if(empty($value)){
            $this->disuse[] = 'password';
        }else{
            return \Hash::make((string)$value);
        }
    }


}