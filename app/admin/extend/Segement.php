<?php
namespace app\admin\extend;

use Eadmin\component\form\Field;
use think\facade\View;

class Segement extends Field
{

	public static function create($content = [], $field = '')
	{
		$last      = $content[count($content) - 1];
		$total     = $last['start'] + $last['duration'];
		$items     = [];
		$intervals = [];
		$types     = [['label'=>'All types', 'value'=>'']];
		$parts     = round($total / pow(10, strlen((string) intval($total)) - 1));
		$balance = $total / $parts;
		for ($i    = 0; $i < $parts-1; $i++) {
			$current     = round($i * $balance, 1); 
			$intervals[] = "{$current}ms";
		}
		$intervals[] = "{$total}ms";
		foreach ($content as $key => $item) {
			$new_type = ['label' => $item['type'], 'value'=>$item['type']];
			if(!in_array($new_type, $types)){
				$types[] = $new_type;
			}
			$items[] = [
				'type'       => $item['type'],
				'label'      => $item['label'],
				'start'      => $item['start'],
				'duration'   => $item['duration'],
				'marginLeft' => round($item['start'] * 100 / $total , 2),
				'bg'         => $item['duration'] >= 10? 'bg-warning' :'bg-danger',
				'width'      => round($item['duration'] * 100 / $total , 2),
			];
		}
		// halt([
		// 	'types'     => $types, 
		// 	'total'     => $total,
		// 	'intervals' => $intervals, 
		// 	'count'     => count($items), 
		// 	'items'     => $items
		// ]);
		$self = new self('', json_encode([
			'types'     => $types, 
			'total'     => $total,
			'intervals' => $intervals, 
			'count'     => count($items), 
			'items'     => $items
		]));
		return $self;
	}

	public function jsonSerialize()
	{
		$this->content(View::fetch('/segement'));
		return parent::jsonSerialize();
	}
}