<?php
declare (strict_types = 1);

namespace app\controller;

use app\BaseController;
use app\model\Project as ProjectModel;
use app\model\Error;

class Errors extends BaseController
{
    use traits\ApiJump;

    public $uid;

    public function initialize(){
        $this->uid = $this->request->uid??0;
    }

    public function current($id){
        return ProjectModel::where('id', $id)->where('user_id', $this->uid)->find();
    }

    public function trend($id){
        $project = $this->current($id);
        if(!$project){
            return $this->error404("非本人的项目");
        }
        $days    = nealy_days('31');
        $start   = $days[0][0];
        $end     = $days[count($days) - 1][0];

        // $statics = Error::where('project_id', $id)->whereBetweenTime('create_time', $start, $end)->select();
        // return json($statics);

        $statics = Error::where('project_id', $id)
            ->fieldRaw("DATE_FORMAT(create_time, '%Y-%m-%d') as date, count(1) as num, create_time")
            ->whereBetweenTime('create_time', $start, $end)
            // ->field(["DATE_FORMAT(create_time, '%Y-%m-%d')"=>'date', 'count(1)'=>'num', 'create_time'])
            ->group("DATE_FORMAT(create_time, '%Y-%m-%d')")
            ->select();
        if($statics){
            $statics = $statics->toArray();
            $statics = array_column($statics, 'num', 'date');
        }
        $ret = [];
        foreach ($days as $date) {
            if(isset($statics[$date])){
                $ret[] = ['date'=>$date, 'num'=>$statics[$date]];
            }else{
                $ret[] = ['date'=>$date, 'num'=>0];
            }
        }
        return $this->success($ret);
    }

    public function errors($id, $size = 25){
        $project = $this->current($id);
        if(!$project){
            return $this->error404("非本人的项目");
        }
        $all = Error::where('project_id', $id)->withoutField(['stack'])->limit($size)->order('create_time desc')->select()?:[];
        return $this->success($all);
    }

    public function detail($id){
        $row = Error::find($id);
        if(!$row){
            $this->error404('记录不存在');
        }
        return $this->success($row);
    }
}