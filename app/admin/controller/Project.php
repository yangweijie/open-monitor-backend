<?php

namespace app\admin\controller;

use Eadmin\Admin;
use Eadmin\Controller;
use Eadmin\form\Form;
use Eadmin\grid\Actions;
use Eadmin\component\form\FormAction;
use Eadmin\detail\Detail;
use Eadmin\grid\Filter;
use Eadmin\grid\Grid;
use Eadmin\component\basic\Html;
use Eadmin\component\basic\Button;
use Eadmin\component\basic\Link;


/**
 *
 * Class Project
 * @package app\admin\controller
 */
class Project extends Controller
{
    protected $title = '项目';

    /**
     * 列表
     * @auth true
     * @login true
     * @return Grid
     */
    public function index() : Grid
    {
        return Grid::create(new \app\model\Project, function (Grid $grid){
            $grid->title($this->title);
			$grid->column('id','id');
			$grid->column('name','名称');
			$grid->column('platform','使用的平台');
			$grid->column('is_active','是否启用')->switch([
                [1 => '开启'],
                [0 => '关闭']
            ]);
			$grid->column('weekly_report','是否需要周报')->switch([
                [1 => '开启'],
                [0 => '关闭']
            ]);
			$grid->column('user_id','用户id');
			$grid->column('create_time','create_time');
			$grid->column('update_time','update_time');
			$grid->column('last_usage_day','last_usage_day');
			$grid->column('key','项目的key');
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
                //隐藏删除按钮
                $action->hideDel();
                //创建一个按钮
                $button = Button::create('监控')
                    ->type('primary')
                    ->size('small')
                    ->icon('el-icon-key')
                    ->plain()
                    // ->dialog()
                    ->redirect('/admin/monitor/index', ['id'=>$data['id']])
                    ->title('监控');
                    // halt($data['id']);
                    // halt(url('/admin/Monitor/index', ['id'=>$data['id']])->__toString());
                // $link = Link::create('会话')->href(url('/admin/monitor/index', ['id'=>$data['id']])->__toString());


                //追加前面
                $action->prepend($button);

                $button = Button::create('异常')
			        ->type('primary')
			        ->size('small')
			        ->icon('el-icon-key')
			        ->plain()
			        // ->dialog()
			        ->redirect('/admin/monitor/errors', ['id'=>$data['id'], 'date_type'=>'month'])
			        ->title('异常');
				//追加后面
				$action->prepend($button);
                //追加后面
                // $action->append($button);
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
         return Form::create(new \app\model\Project,function (Form $form){
            $form->title($this->title);
            if($form->isEdit()){
                $form->text('name','名称');
                $form->text('platform','使用的平台');
                $form->switch('is_active','是否启用')->state([
                    [1 => '开启'],
                    [0 => '关闭']
                ]);
                $form->switch('weekly_report','是否需要周报')->state([
                    [1 => '开启'],
                    [0 => '关闭']
                ]);
            }else{
                $table = 'project';
                $field = 'name';
                $text  = "[字段]已重复";
                $form->text('name','名称')->uniqueRule($table, $field, $text)->required();
            }
			// $form->text('user_id','用户id');
			// $form->text('create_time','create_time');
			// $form->text('update_time','update_time');
			// $form->text('last_usage_day','last_usage_day');
			// $form->text('key','项目的key');

            // 操作栏
			$form->actions(function (FormAction $action) {
			    // 隐藏重置按钮
                // $action->hideResetButton();
			});
            // 保存前回调
            $form->saving(function ($post) {
                if(isset($post['id'])){

                }else{
                    $post['user_id'] = Admin::id();
                    $post['key']     = '';
                }
                return $post;
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
        return Detail::create(new \app\model\Project,$id,function (Detail $detail){
            $detail->title($this->title);
			$detail->field('id','id');
			$detail->field('name','名称');
			$detail->field('platform','使用的平台');
			$detail->field('is_active','是否启用')->using(['1'=>'是', '0'=>'否']);
			$detail->field('weekly_report','是否需要周报')->using(['1'=>'是', '0'=>'否']);
			$detail->field('user_id','用户id');
			$detail->field('create_time','create_time');
			$detail->field('update_time','update_time');
			$detail->field('last_usage_day','last_usage_day');
			$detail->field('key','项目的key');

        });
     }
}