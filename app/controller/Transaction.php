<?php
declare (strict_types = 1);

namespace app\controller;

use app\BaseController;
use app\model\Project as ProjectModel;
use app\model\Transaction as TransactionModel;
use think\Request;
use Carbon\Carbon;

class Transaction extends BaseController
{
    public $uid;

    public function initialize(){
        $this->uid = $this->request->uid??0;
    }

    use traits\ApiJump;

    public function current($id){
        return ProjectModel::where('id', $id)->where('user_id', $this->uid)->find();
    }

    public function transactions($id, $size = 25, $filter = ''){
        trace($filter);
        $filter_arr = json_decode($filter, true);
        if(false == $filter_arr){
            return $this->error('参数格式错误', ['errors'=>[['filter'=>'格式错误']]]);
        }
        $this->request->filter     = $filter_arr;
        $this->request->project_id = $id;
        $project                   = $this->current($id);
        if(!$project){
            return $this->error404("非本人的项目");
        }
        return json(TransactionModel::where('project_id', $id)->field(['name','group_hash', 'last_record', 'memory', 'p50'])->append(['throughput', 'performance'])->select());
    }

    public function performance($id, $size = 25, $filter = ''){
        trace($filter);
        $filter_arr = json_decode($filter, true);
        if(false == $filter_arr){
            return $this->error('参数格式错误', ['errors'=>[['filter'=>'格式错误']]]);
        }
        $this->request->filter     = $filter_arr;
        $this->request->project_id = $id;
        $project                   = $this->current($id);
        if(!$project){
            return $this->error404("非本人的项目");
        }
        if(empty($filter_arr['end'])){
            $now = Carbon::now();
            $hours = $now->diffInRealHours($filter_arr['start']);
            switch ($hours) {
                case 1:
                    $ret = TransactionModel::lastHourPerformance();
                    break;
                case 12:
                    $ret = TransactionModel::last12HourPerformance();
                    break;
                case 24:
                    $ret = TransactionModel::last24HourPerformance();
                    break;
                case 72:
                    $ret = TransactionModel::last3dayPerformance();
                    break;
                default:
                    $end  = Carbon::parse($filter_arr['end']);
                    $days = $end->diffInDays($filter_arr['start']);
                    $ret  = TransactionModel::customDaysPerformance($days);
                    break;
            }
        }else{
            $end  = Carbon::parse($filter_arr['end']);
            $days = $end->diffInDays($filter_arr['start']);
            trace($end);
            trace($days);
            $ret  = TransactionModel::customDaysPerformanceWithEnd($days, $filter_arr['start'], $filter_arr['end']);
        }
        return json($ret);
    }

    public function occurrences($id, $size = 25, $filter = ''){
        trace($filter);
        $filter_arr = json_decode($filter, true);
        if(false == $filter_arr){
            return $this->error('参数格式错误', ['errors'=>[['filter'=>'格式错误']]]);
        }
        $this->request->project_id = $id;
        $project                   = $this->current($id);
        if(!$project){
            return $this->error404("非本人的项目");
        }
        if(empty($filter_arr['end'])){
            $now               = Carbon::now();
            $filter_arr['end'] = $now;
        }
        $this->request->filter = $filter_arr;
        $ret = TransactionModel::occurrences($filter_arr);
        return json($ret);
    }

}