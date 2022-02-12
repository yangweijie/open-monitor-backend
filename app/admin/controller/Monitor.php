<?php

namespace app\admin\controller;

use app\model\Transaction;
use app\admin\extend\Pre;
use app\admin\extend\Segement;
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

		// $content->row(function (Row $row) use($id){
		// 	// $row->gutter(10);
		// 	$row->column(Pre::create('aaa'), 24);
		// });

		// $content->row(function (Row $row) use($id){
		// 	// $row->gutter(10);
		// 	$rows = ModelSegement::where('group_hash', '2J')->select();
		// 	// halt($rows->toArray());
		// 	$row->column(Segement::create($rows->toArray()), 24);
		// });

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
		$rows = Transaction::where('project_id', $id)->field(['id','name','group_hash', 'last_record', 'memory', 'p50', 'http', 'context'])->append(['throughput', 'performance'])
		// ->whereBetweenTime('create_time', $request->filter['start'], $request->filter['end'])
		->select();
		return Grid::create($rows->toArray(), function (Grid $grid){
			$grid->title('会话');
			$grid->column('name','名称');
			$grid->column('throughput','发生');
			$grid->column('memory', '内存');
			// $grid->column('last_record.create_time', '最后查看');
			$grid->column('result', 'result');
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
// $content = <<<HTML
// <div class="row my-4"><div class="col-sm-4"><span class="d-block text-muted">Timestamp</span> <span class="font-weight-bold">04 Feb 16:05:57</span></div> <div class="col-sm-4"><span class="d-block text-muted">Result</span> <span data-v-00a627cf="" class="badge badge-default badge-success">
//     200
// </span></div> <div class="col-sm-4"><span class="d-block text-muted">Duration</span> <span data-v-58b1a006="" class="font-weight-bold">1.19 sec</span></div></div>
// HTML;

				$content = new Content;
				$content->row(function (Row $row){
					// $row->gutter(3);
					$row->column(Html::create('内容'), 8);
					$row->column(Html::create('内容'), 8);
					$row->column(Html::create('内容'), 8);
				});
				$content->row(function(Row $row) use($data) {
					// halt($data);
					// $row->gutter(10);
					$rows = ModelSegement::where('group_hash', $data['group_hash'])->select();
					$rows = $rows->toArray();
					// halt($rows->toArray());
					$panel = Segement::create($rows? $rows:[['start' => 0, 'duration'=>$data['p50'], 'label'=>'', 'type'=>'app']]);
					$tabs    = Tabs::create()->pane('Timeline', $panel);
					// $jsonStr = pretty_json($data['http']['url']);
					$tabs->pane('Url', Pre::create($data['http']['url']));
					$tabs->pane('Request', Pre::create($data['http']['request']));
					if(!empty($data['context'])){
						foreach ($data['context'] as $key => $value) {
							$tabs->pane($key, $value);
						}
					}
					// ->pane('提示2','内容2');
					$row->column($tabs, 24);
				});
				// $content = Pre::create('123');
				$button = Drawer::create(Button::create('按钮'))->title($data['name'])->direction('ltr')->width('900px')->content($content);

				//追加前面
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

}