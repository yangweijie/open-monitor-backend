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
use app\model\Errors As ErrorsModel;

/**
 *
 * Class Errors
 * @package app\admin\controller
 */
class Errors extends Controller
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
        return Grid::create(new ErrorsModel, function (Grid $grid){
            $grid->title($this->title);
			$grid->column('id','id');
			$grid->column('project_id','project_id');
			$grid->column('create_time','create_time');
			$grid->column('update_time','update_time');
			$grid->column('message','message');
			$grid->column('handled','handled');
			$grid->column('group_hash','group_hash');
			$grid->column('muted','muted');
			$grid->column('last_seen_at','last_seen_at');
			$grid->column('class','class');
			$grid->column('file','file');
			$grid->column('line','line');
			$grid->column('code','code');
			$grid->column('stack','stack');
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
         return Form::create(new ErrorsModel,function (Form $form){
            $form->title($this->title);
			$form->text('id','id');
			$form->text('project_id','project_id');
			$form->text('create_time','create_time');
			$form->text('update_time','update_time');
			$form->text('message','message');
			$form->text('handled','handled');
			$form->text('group_hash','group_hash');
			$form->text('muted','muted');
			$form->text('last_seen_at','last_seen_at');
			$form->text('class','class');
			$form->text('file','file');
			$form->text('line','line');
			$form->text('code','code');
			$form->text('stack','stack');
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
        return Detail::create(new ErrorsModel, $id,function (Detail $detail){
            $detail->title($this->title);
			$detail->field('id','id');
			$detail->field('project_id','project_id');
			$detail->field('create_time','create_time');
			$detail->field('update_time','update_time');
			$detail->field('message','message');
			$detail->field('handled','handled');
			$detail->field('group_hash','group_hash');
			$detail->field('muted','muted');
			$detail->field('last_seen_at','last_seen_at');
			$detail->field('class','class');
			$detail->field('file','file');
			$detail->field('line','line');
			$detail->field('code','code');
			$detail->field('stack','stack');
			$detail->field('hash','hash');

        });
     }
}
