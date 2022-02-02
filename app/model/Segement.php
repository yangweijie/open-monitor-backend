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

    public static function time($filter_arr, $project_id, $group_hash){
        extract($filter_arr);
        $all = self::where('group_hash', $group_hash)
            ->whereBetweenTime('create_time', $start, $end)
            ->order('duration')
            ->field(['count(1)'=>'occurrences', 'ROUND(duration)'=>'ms'])
            ->group('duration')
            ->select();
        $durations = array_column($all->toArray(), 'ms');
        $min = min($durations);
        $max = max($durations);
        trace(['min'=>$min, 'max'=>$max]);
        if($min == $max){
            return $all;
        }else{
            $reset = [];
            $div = round(($max - $min)/7);
            trace($div);
            for ($i=0; ($i * $div + $min) < $max; $i++) {
                $j = $i+1;
                $end = $min + $j*$div;
                $reset[$end] = 0;
                foreach ($all as &$value) {
                    trace(['end'=>$end, 'ms'=>$value['ms']]);
                    if($value['ms'] > $end - $div && $value['ms'] <= $end){
                        $reset[$end]+= $value['occurrences'];
                    }
                    unset($value);
                }
            }
            $ret_sort = [];
            foreach ($reset as $key => $value) {
                $ret_sort[] = ['ms' => $key, 'occurrences'=>$value];
            }
            return $ret_sort;
        }
    }
}