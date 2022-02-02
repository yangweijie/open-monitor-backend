<?php

namespace app\admin\controller;

use Eadmin\Controller;
use Eadmin\form\Form;
use Eadmin\grid\Actions;
use Eadmin\component\form\FormAction;
use Eadmin\detail\Detail;
use Eadmin\grid\Filter;
use Eadmin\grid\Grid;
use Eadmin\component\basic\Html;
use app\model\Transaction;

/**
 *
 * Class Monitor
 * @package app\admin\controller
 */
class Monitor extends Controller
{
    protected $title = '标题';

    /**
     * 列表
     * @auth true
     * @login true
     * @return Grid
     */
    public function index() : Grid
    {
        return Grid::create(new Transaction, function (Grid $grid){
            $grid->title($this->title);
			$grid->column('id','id');
			$grid->column('group_hash','path 加密后的');
			$grid->column('project_id','project_id');
			$grid->column('memory','内存');
			$grid->column('p50','耗时平均');
			$grid->column('last_record','最后一次记录');
			$grid->column('name','name');
			$grid->column('type','type');
			$grid->column('host','host');
			$grid->column('create_time','create_time');
			$grid->column('update_time','update_time');
			$grid->column('context','context');
			$grid->column('http','http');
			$grid->column('hash','hash');
			$grid->filter(function (Filter $filter){
                $filter->dateRange('create_time','创建时间');
            });

            $grid->quickSearch();
            $grid->setForm($this->form())->dialog();
            $grid->setDetail($this->detail());
            // 工具栏内容（可html组件嵌套）
            // $grid->tools('');
            // 头部内容（可html组件嵌套）
            // $grid->header('');
            // 操作工具栏
            $grid->actions(function (Actions $action, $data) {

            });
            // 删除前回调
            $grid->deling(function ($ids, $trueDelete) {

            });
            // 更新前回调
            $grid->updateing(function ($ids, $data) {

            });
        });
    }

    /**
     * 表单
     * @auth true
     * @login true
     * @return Form
     */
    public function form() : Form
    {
         return Form::create(new Transaction,function (Form $form){
            $form->title($this->title);
			$form->text('id','id');
			$form->text('group_hash','path 加密后的');
			$form->text('project_id','project_id');
			$form->text('memory','内存');
			$form->text('p50','耗时平均');
			$form->text('last_record','最后一次记录');
			$form->text('name','name');
			$form->text('type','type');
			$form->text('host','host');
			$form->text('create_time','create_time');
			$form->text('update_time','update_time');
			$form->text('context','context');
			$form->text('http','http');
			$form->text('hash','hash');

            // 操作栏
			$form->actions(function (FormAction $action) {
			    // 隐藏重置按钮
                // $action->hideResetButton();
			});
            // 保存前回调
            $form->saving(function ($post) {

            });
            // 保存后回调
            $form->saved(function ($post, $data) {

            });
         });
    }

    /**
     * 详情
     * @auth true
     * @login true
     * @param int $id
     * @return Detail
     */
     public function detail($id=0) : Detail
     {
        return Detail::create(new Transaction,$id,function (Detail $detail){
            $detail->title($this->title);
			$detail->field('id','id');
			$detail->field('group_hash','path 加密后的');
			$detail->field('project_id','project_id');
			$detail->field('memory','内存');
			$detail->field('p50','耗时平均');
			$detail->field('last_record','最后一次记录');
			$detail->field('name','name');
			$detail->field('type','type');
			$detail->field('host','host');
			$detail->field('create_time','create_time');
			$detail->field('update_time','update_time');
			$detail->field('context','context');
			$detail->field('http','http');
			$detail->field('hash','hash');

        });
     }
}
