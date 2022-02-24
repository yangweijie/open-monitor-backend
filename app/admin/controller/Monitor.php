<?php

namespace app\admin\controller;

use app\model\Transaction;
use app\admin\extend\Pre;
use app\admin\extend\Segement;
use app\admin\extend\Stack;
use app\model\Errors;
use app\model\Segement as ModelSegement;
use Carbon\Carbon;
use Eadmin\Controller;
use Eadmin\form\Form;
use Eadmin\grid\Actions;
use Eadmin\component\form\FormAction;
use Eadmin\detail\Detail;
use Eadmin\grid\Filter;
use Eadmin\grid\Grid;
use Eadmin\component\basic\Html;
use Eadmin\chart\Echart;
use Eadmin\chart\echart\LineChart;
use Eadmin\component\basic\Breadcrumb;
use Eadmin\component\basic\Statistic;
use Eadmin\component\basic\Drawer;
use Eadmin\component\basic\Tabs;
use Eadmin\component\basic\Button;
use Eadmin\component\basic\Collapse;
use Eadmin\component\layout\Content;
use Eadmin\component\layout\Row;

use think\facade\Request;

/**
 *
 * Class Monitor
 * @package app\admin\controller
 */
class Monitor extends Controller
{
	protected $title = '监控';

	/**
	 * 列表
	 * @auth true
	 * @login true
	 * @return Grid
	 */
	public function index(Content $content, $id)
	{
		$content->title('监控');

		// 统计报表
		// $content->row(function (Row $row) use($id){
		//     $row->gutter(10);
		//     $row->column($this->noTransaction($id), 24);
		// });

		// $content->row(function (Row $row) use($id){
		//     $row->gutter(10);
		//     $row->column($this->perfermance($id), 24);
		// });

		// $content->row(function (Row $row) use($id){
		//     $row->gutter(10);
		//     $row->column($this->kpi($id), 24);
		// });

		$content->row(function (Row $row) use($id){
			// $row->gutter(10);
			$row->column($this->table($id), 24);
		});

		return $content;
	}

	public function getFilterFromDataType(){
		$date_type = Request::get('date_type', 'today');
		$filter = [];
		switch ($date_type) {
			case 'yesterday':
				$filter['start'] = Carbon::yesterday()->format('Y-m-d 00:00:00');
				$filter['end']   = Carbon::now()->format('Y-m-d 00:00:00');
				break;
			case 'today':
				$filter['start'] = Carbon::now()->format('Y-m-d 00:00:00');
				$filter['end']   = Carbon::now()->format('Y-m-d 23:59:59');
				break;
			case 'week':
				$filter['start'] = Carbon::now()->subWeek()->format('Y-m-d 00:00:00');
				$filter['end']   = Carbon::now()->format('Y-m-d 23:59:59');
				break;
			case 'month':
				$filter['start'] = Carbon::now()->subMonth()->format('Y-m-d 00:00:00');
				$filter['end']   = Carbon::now()->format('Y-m-d 23:59:59');
				break;
			case 'year':
				$filter['start'] = Carbon::now()->subYear()->format('Y-m-d 00:00:00');
				$filter['end']   = Carbon::now()->format('Y-m-d 23:59:59');
				break;
			case 'range':
				$start_date      = Request::get('start_date');
				$end_date        = Request::get('end_date');
				$filter['start'] = $start_date;
				$filter['end']   = $end_date;
				break;
			default:
			   ;
		}
		return $filter;
	}

	public function table($id){
		$request = request();
		$request->filter = $this->getFilterFromDataType();
		$rows = Transaction::where('project_id', $id)->field(['id','name','group_hash', 'last_record', 'memory', 'p50', 'http', 'context', 'create_time', 'result'])->append(['throughput', 'performance'])
		// ->whereBetweenTime('create_time', $request->filter['start'], $request->filter['end'])
		->order('id DESC')
		->select();
		return Grid::create($rows->toArray(), function (Grid $grid){
			$grid->title('会话');

			$grid->hideSelection();
			$grid->hideDeleteButton();

			$grid->column('name','名称');
			$grid->column('p50','时长(ms)');
			$grid->column('memory',      '内存(MB)');
			$grid->column('result',      'result');
			$grid->column('create_time', '时间');

			// $grid->column('memory', '内存');


			// $grid->filter(function (Filter $filter){
			//     $filter->dateRange('create_time','创建时间');
			// });

			$grid->quickSearch();

			$grid->filter(function (Filter $filter){
				$filter->datetimeRange('create_time', '创建时间');
			});
			// $grid->filter->datetimeRange('create_time', '创建时间');

			// 工具栏内容（可html组件嵌套）
			// $grid->tools('');
			// 头部内容（可html组件嵌套）
			// $grid->header('');
			// 操作工具栏
			$grid->actions(function (Actions $action, $data) {
				//隐藏删除按钮
				$action->hideDel();
				//创建一个按钮

				$content = new Content;
				$content->row(function (Row $row) use($data){
					$row->column('<span class="d-block text-muted">Timestamp</span><span class="font-weight-bold">'.$data['create_time'].'</span>', 8);
					$row->column('<span class="d-block text-muted">Result</span><span class="badge badge-default badge-success">'.$data['result'].'</span>', 8);
					$row->column('<span class="d-block text-muted">Duration</span><span class="font-weight-bold">'.$data['p50'].' ms</span>', 8);
				});
				$content->row(function(Row $row) use($data) {
					// halt($data);
					// $row->gutter(10);
					$rows = ModelSegement::where('group_hash', $data['group_hash'])->select();
					$rows = $rows->toArray();
					// halt($rows->toArray());
					$panel = Segement::create($rows? $rows:[['start' => 0, 'duration'=>$data['p50'], 'label'=>'', 'type'=>'app']]);
					$tabs    = Tabs::create()->pane('Timeline', $panel);
					$tabs->pane('Url', Pre::create($data['http']['url']));
					$tabs->pane('Request', Pre::create($data['http']['request']));
					if(!empty($data['context'])){
						foreach ($data['context'] as $key => $value) {
							$tabs->pane($key, $value);
						}
					}
					$row->column($tabs, 24);
				});
				// $content = Pre::create('123');
				$button = Drawer::create(Button::create('更多'))->title($data['name'])->direction('ltr')->width('900px')->content($content);

				//追加前面
				$action->prepend($button);
				
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
	 * 会话
	 */
	public function noTransaction($id)
	{
		$echart = new Echart('会话', 'bar', '200px');
		$echart->table('transaction');
		$echart->count('数量', function($query) use ($id){
			$query->where('project_id', $id);
		});
		return $echart;
	}

	/**
	 * 性能
	 */
	public function perfermance($id)
	{
		$echart = new Echart('性能', 'line', '200px');
		$echart->table('transaction');
		$echart->sum('时长','p50', function($query) use ($id){
			$query->where('project_id', $id);
		});
		return $echart;
	}

	/**
	 * kpi
	 */
	public function kpi($id)
	{
		$echart = new Echart('Server Kpi', 'pie', '200px');
		$echart->table('transaction');

		$hosts = Transaction::hostsE($id);
		// halt($hosts);
		foreach ($hosts as $key => $host) {
			$echart->group($host, function ($echart) use($id, $host){
				$echart->table('transaction', 'create_time');
				$echart->count($host, function($query) use ($id, $host){
					$query->where('host', 'like', "%{$host}%");
					$query->where('project_id', $id);
				});
			});
		}
		return $echart;
	}

	public function errors(Content $content, $id){
		$content->title('监控');

		$content->row(function (Row $row) use($id){
			$row->gutter(10);
			$row->column($this->error_trends($id), 24);
		});

		$content->row(function (Row $row) use($id){
			$row->gutter(10);
			$row->column($this->table2($id), 24);
		});
		return $content;
	}

	public function error_trends($id){
		$echart = new Echart('异常', 'bar', '200px');
		$echart->table('errors');
		$echart->count('数量', function($query) use ($id){
			$query->where('project_id', $id);
		});
		return $echart;
	}


	public function table2($id){
		$request = request();
		$request->filter = $this->getFilterFromDataType();
		$rows = Errors::where('project_id', $id)->field(['id', 'create_time', 'message', 'file'])
			->append(['last_seen_at'])
			->select();
		return Grid::create($rows->toArray(), function (Grid $grid){
			$grid->title('异常');
			$grid->hideSelection();
			$grid->hideDeleteButton();
			// $grid->hideDeleteSelection();
			$grid->column('message','message')->display(function ($val,$data){
				return "{$val}<br>{$data['file']}";
			});
			$grid->column('last_seen_at', '最后出现');

			$grid->filter(function (Filter $filter){
				$filter->datetimeRange('create_time', '创建时间');
			});
			
			// 操作工具栏
			$grid->actions(function (Actions $action, $data) {
				//隐藏删除按钮
				$action->hideDel();
				//创建一个按钮

				$button = Button::create('详情')
			        ->type('primary')
			        ->size('small')
			        ->icon('el-icon-key')
			        ->plain()
			        // ->dialog()
			        ->redirect('/admin/monitor/error', ['id'=>$data['id']])
			        ->title('异常');
				//追加后面
				$action->prepend($button);

			});
			// 删除前回调
			$grid->deling(function ($ids, $trueDelete) {

			});
			// 更新前回调
			$grid->updateing(function ($ids, $data) {

			});
		});
	}

	public function error($id){
		$data = Errors::find($id);
		$data->append(['last_seen_at', 'first_seen_at']);
		return \Eadmin\detail\Detail::create($data, $id, function (\Eadmin\detail\Detail $detail) {
            $detail->title('异常详情');
            $detail->row(function (Row $row) use ($detail) {
            	$data = $detail->getData();
            	$summary = <<<HTML
<div class="my-4" title="123"><h5 class="text-truncate">123</h5> <div title="Exception in {$data['file']} at line {$data['line']}" class="font-weight-lighter text-muted text-truncate">
            Exception in {$data['file']} at line {$data['line']}
        </div> <div class="small my-2">
            Last: <span class="badge badge-light">{$data['last_seen_at']}</span> <span class="mx-2">·</span>
            First: <span class="badge badge-light">{$data['first_seen_at']}</span></div></div>
HTML;
            	$row->column($summary);
            });

            $detail->row(function(Row $row) use($detail){
            	$error = $detail->getData();
            	$data  = Transaction::where('group_hash', $error['group_hash'])->find();

            	$stacks = Collapse::create();
            	foreach ($error['stack'] as $key => $value) {
            		$title   = Errors::title($value);
            		$content = Errors::content($value);
            		$stacks->item($title, $content);
            	}

            	$tabs = Tabs::create()->pane('Stacktrace', $stacks);
				$rows = ModelSegement::where('group_hash', $data['group_hash'])->select();
				$rows = $rows->toArray();
				$panel           = Segement::create($rows? $rows:[['start' => 0, 'duration'=>$data['p50'], 'label'=>'', 'type'=>'app']]);
				$transaction_tab = Tabs::create()->pane('Timeline', $panel);
				$transaction_tab->pane('Url', Pre::create($data['http']['url']));
				$transaction_tab->pane('Request', Pre::create($data['http']['request']));
				if(!empty($data['context'])){
					foreach ($data['context'] as $key => $value) {
						$transaction_tab->pane($key, Pre::create($value));
					}
				}
            	$tabs->pane('Transaction', $transaction_tab);

            	$tabs->pane('Context', '<p class="text-muted font-italic my-4">No context information.</p>');

				$row->column($tabs, 24);
			});
            // $detail->row(function (Row $row) use ($detail) {
            //     $steps = Steps::create(1);
            //     $steps->step('待付款', date('Y-m-d H:i:s'));
            //     $steps->step('待发货', date('Y-m-d H:i:s'))->content('支付宝', 'subTitle');
            //     $steps->step('待收货', date('Y-m-d H:i:s'));
            //     $steps->step('完成');
            //     $row->column(Card::create($steps));
            // });
            // $detail->row(function (Row $row) use ($detail) {
            //     $row->column($detail->card('', function (\Eadmin\detail\Detail $detail) {
            //         $detail->push(Html::create('订单信息')->tag('h2')->style(['marginTop' => '10px']));
            //         $detail->field('product', '订购产品')->md(24);
            //         $detail->field('order_no', '订单号')->md(6);
            //         $detail->field('money', '订单金额')->md(6);
            //         $detail->field('remark', '备注')->md(6);
            //         $detail->field('create_time', '下单时间')->md(6);

            //         $detail->push(Divider::create());
            //         $column = new Column();
            //         $detail->push($column->content(Html::create('用户信息')->tag('h2'))->style(['marginTop' => '10px']));
            //         $detail->field('nickname', '用户姓名')->md(6);
            //         $detail->field('phone', '	联系电话')->md(6);
            //         $detail->field('express', '常用快递')->md(6);
            //         $detail->field('address', '取货地址')->md(6);
            //         $detail->field('remark', '备注')->md(6);
            //     }),18);

            //     $faker = Factory::create('zh_CN');
            //     $timeLine = TimeLine::create();
            //     for ($i = 0; $i < 4; $i++) {
            //         $timeLine->item($faker->text(30))->timestamp($faker->time() );
            //     }
            //     $row->column(Card::create($timeLine)->header('发货信息'),6);
            // });
            // $detail->row(function (Row $row) use ($detail) {
            //     $row->column($detail->grid('goods', '商品信息', function (Grid $grid) {
            //         $grid->column('name', '商品名称');
            //         $grid->column('number', '商品条码');
            //         $grid->column('price', '单价');
            //         $grid->column('num', '数量');
            //         $grid->column('money', '金额');
            //     }));
            // });

        });
	}

}

