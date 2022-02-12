<?php
declare (strict_types=1);

namespace app\model;


use Carbon\Carbon;
use think\facade\Request;

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

    public static function initFilter($filter){
        if($filter['end']){
            return $filter;
        }else{
            $filter['end'] = 'now';
            return $filter;
        }
    }

    public function getThroughputAttr($value, $data){
        $filter = self::initFilter(request()->filter);

        return self::where('name', $data['name'])
            ->where('project_id', request()->project_id)
            ->whereBetweenTime('create_time', $filter['start'], $filter['end'])
            ->count();
    }

    public function getPerformanceAttr($value, $data){
        // var_dump($data['last_record']);
        // return [];
        // $end_time = $data['last_record']->create_time?? null;
        $max      = 24;
        $unit     = 'hour';
        $statics  = [];

        for ($i=1; $i < $max+1; $i++) {
            $j         = $i+1;
            $start     = $max - $i;
            $end       = $max - $j;
            $statics[] = [
                'date'         => datetime("{$start} {$unit} ago"),
                'doc_count'    => self::whereBetweenTime('create_time', "{$start} {$unit} ago", "{$end} {$unit} ago")->cache(60)->count(),
                'value'        => self::whereBetweenTime('create_time', "{$start} {$unit} ago", "{$end} {$unit} ago")->cache(60)->avg('p50'),
            ];
        }
        return $statics;
    }

    public static function lastHourPerformance(){
        return self::staticPerformance(61, 'miniutes');
    }

    public static function last12HourPerformance(){
        return self::staticPerformance(731, 'miniutes');
    }

    public static function last24HourPerformance(){
        return self::staticPerformance(25, 'hour');
    }

    public static function last3dayPerformance(){
        return self::staticPerformance(49, 'hour');
    }

    public static function customDaysPerformance($days){
        return self::staticPerformance($days+1, 'day');
    }

    public static function customDaysPerformanceWithEnd($days, $start, $end){
        $project_id = request()->project_id;
        $statics    = [];
        $unit       = 'day';

        for ($i=$days; $i > -1; $i--) {
            $j          = $i-1;
            if($i == $days){
                $query_start = "1 day ago";
                $query_end   = $end;
            }else if($i == 0){
                $query_start = $start;
                $query_end   = "{$days} ago";
            }else{
                $query_start = ($days - $j)." day ago";
                $query_end   = ($days - $i)." day ago";
            }
            $statics[]  = [
                'date'         => datetime($query_start),
                'transactions' => self::where('project_id', $project_id)->whereBetweenTime('create_time', $query_start, $query_end)->cache(60)->count(),
                'median'       => self::where('project_id', $project_id)->whereBetweenTime('create_time', $query_start, $query_end)->cache(60)->avg('p50'),
                'memory_peak'  => self::where('project_id', $project_id)->whereBetweenTime('create_time', $query_start, $query_end)->cache(60)->avg('memory'),
            ];
        }
        return array_reverse($statics);
    }

    public static function staticPerformance($max, $unit){
        $project_id = request()->project_id;
        $statics = [];
        for ($i=1; $i < $max+1; $i++) {
            $j         = $i+1;
            $start     = $max - $j;
            $end       = $max - $i;
            $statics[] = [
                'date'         => datetime("{$start} {$unit} ago"),
                'transactions' => self::where('project_id', $project_id)->whereBetweenTime('create_time', "{$start} {$unit} ago", "{$end} {$unit} ago")->cache(60)->count(),
                'median'       => self::where('project_id', $project_id)->whereBetweenTime('create_time', "{$start} {$unit} ago", "{$end} {$unit} ago")->cache(60)->avg('p50'),
                'memory_peak'  => self::where('project_id', $project_id)->whereBetweenTime('create_time', "{$start} {$unit} ago", "{$end} {$unit} ago")->cache(60)->avg('memory'),
            ];
        }
        return $statics;
    }

    public static function hosts($filter_arr, $project_id){
        extract($filter_arr);
        $ret    = self::where('project_id', $project_id)->whereBetweenTime('create_time', $start, $end)->cache(60)->select();
        $return = [];
        if($ret){
            foreach($ret as $key=>$user){
                $return[] = $user['host'];
            }
        }
        return $return;
    }

    public static function hostsE($project_id){
        $date_type = Request::get('date_type', 'year');
        $query     = self::where('project_id', $project_id);
        $dateField = 'create_time';

        switch ($date_type) {
            case 'yesterday':
            case 'today':
                $query->whereDay($dateField, $date_type);
                break;
            case 'week':
                $value = $query->whereWeek($dateField);
                break;
            case 'month':
                $value = $query->whereMonth($dateField);
                break;
            case 'year':
                $value = $query->whereYear($dateField);
                break;
            case 'range':
                $start_date = Request::get('start_date');
                $end_date   = Request::get('end_date');
                $value      = $query->whereBetweenTime($dateField, $start_date, $end_date);
                break;
            default:
                ;
        }

        $ret    = $query->cache(60)->group('host')->select();
        $return = [];
        if($ret){
            foreach($ret as $key=>$user){
                $return[] = $user['host']->hostname;
            }
        }
        return $return;
    }

    public static function occurrences($filter_arr){
        $project_id = request()->project_id;
        extract($filter_arr);
        $ret = self::where('project_id', $project_id)->whereBetweenTime('create_time', $start, $end)->cache(60)->select();
        return $ret;
    }
}