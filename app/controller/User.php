<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;
use app\model\User AS UserModel;
use thans\jwt\facade\JWTAuth;

class User
{
    use traits\ApiJump;
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->param();
        // return $this->error($data);
        $errors = [];
        if(empty($data['name'])){
            $errors['name'][] = '昵称必填';
        }
        if(empty($data['password'])){
            $errors['password'][] = '密码必填';
        }
        if($errors){
            return $this->error(['message'=>'参数错误', 'errors'=>$errors]);
        }else{
            $exist = UserModel::where('name', $data['name'])->find();
            if($exist){
                return $this->error(['message'=>'用户已存在', 'errors'=>['name'=>['用户已存在']]]);
            }
            $ret = UserModel::create($data);
            return $this->success($ret);
        }
    }

    public function login($name, $password){
        $exist = UserModel::where('name', $name)->find();
        if($exist){
            if(\Hash::check($password, $exist['password']) === true){
                $exist['token'] = $token = 'Bearer ' . JWTAuth::builder(['uid' => $exist['id']]);
                return $this->success($exist);
            }else{
                // trace($password);
                // trace(\Hash::make($password));
                return $this->error404('密码错误');
            }
        }else{
            return $this->error404('账号不存在');
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
        return json(UserModel::find($id));
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
        return json(UserModel::where('id', $id)->update($data));
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        UserModel::where($id)->delete();
    }
}