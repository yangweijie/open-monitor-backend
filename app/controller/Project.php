<?php
declare (strict_types = 1);

namespace app\controller;

use app\BaseController;
use app\model\Project as ProjectModel;
use app\model\Transaction;
use think\Request;
use Carbon\Carbon;

class Project extends BaseController
{

    public $uid;

    public function initialize(){
        $this->uid = $this->request->uid??0;
    }

    use traits\ApiJump;

    public function current($id){
        return ProjectModel::where('id', $id)->where('user_id', $this->uid)->find();
    }


    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $ret = ProjectModel::where('user_id', $this->uid)->select();
        return $this->success($ret);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data   = $request->post();
        $errors = [];
        if(empty($data['name'])){
            $errors['name'][] = '名称必填';
        }
        $exist = ProjectModel::where('name', $data['name'])->find();
        if($exist){
            $errors['name'][] = '名称已被使用';
        }
        if($errors){
            return $this->error(['message'=>'参数错误', 'errors'=>$errors]);
        }else{
            $ret = ProjectModel::create(['user_id'=>$this->uid, 'name'=>$data['name'], 'key'=>'']);
            return $this->success($ret);
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        // return 1111;
        return json($this->current($id)?:[]);
        // return json('1');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->param();
        return json(ProjectModel::where('id', $id)->where('user_id', $this->uid)->update($data));
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
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
        return json(Transaction::where('project_id', $id)->field(['name','group_hash', 'last_record', 'memory', 'p50'])->append(['throughput', 'performance'])->select());
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
                    $ret = Transaction::lastHourPerformance();
                    break;
                case 12:
                    $ret = Transaction::last12HourPerformance();
                    break;
                case 24:
                    $ret = Transaction::last24HourPerformance();
                    break;
                case 72:
                    $ret = Transaction::last3dayPerformance();
                    break;
                default:
                    $end  = Carbon::parse($filter_arr['end']);
                    $days = $end->diffInDays($filter_arr['start']);
                    $ret  = Transaction::customDaysPerformance($days);
                    break;
            }
        }else{
            $end  = Carbon::parse($filter_arr['end']);
            $days = $end->diffInDays($filter_arr['start']);
            trace($end);
            trace($days);
            $ret  = Transaction::customDaysPerformanceWithEnd($days, $filter_arr['start'], $filter_arr['end']);
        }
        return json($ret);
    }
}