<?php
declare (strict_types = 1);

namespace app\controller;

use app\BaseController;
use think\Request;
use app\model\Project as ProjectModel;

class Project extends BaseController
{

    public $uid;

    public function initialize(){
        $this->uid = $this->request->uid??0;
    }

    use traits\ApiJump;
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return json('1');
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
        return json(ProjectModel::where('user_id', $this->uid)->where('id', $id)->find()?:[]);
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
        //
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
}