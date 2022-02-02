<?php
declare (strict_types = 1);

namespace app\controller;

use app\BaseController;
use app\model\Project as ProjectModel;
use app\model\Transaction as TransactionModel;
use app\model\Segement as SegementModel;
use think\Request;
use Carbon\Carbon;

class Segement extends BaseController
{
    use traits\ApiJump;

    public $uid;

    public function initialize(){
        $this->uid = $this->request->uid??0;
    }

    public function current($id){
        return ProjectModel::where('id', $id)->where('user_id', $this->uid)->find();
    }

    public function index($id, $group_hash){
        $project = $this->current($id);
        if(!$project){
            return $this->error404("非本人的项目");
        }
        $ret = SegementModel::where('group_hash', $group_hash)->select();
        return $this->success($ret);
    }
}