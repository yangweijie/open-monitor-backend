<?php
namespace app\admin\extend;

use Eadmin\component\form\Field;
use think\facade\View;

class Stack extends Field
{

	public static function create($content = null, $field = '')
	{
		if(!isset($content['line']) || $content['line'] == 0){
			$content['line'] = false;
		}
		$content['start'] = $content['start']??1;

		$self = new self('', json_encode($content));
		return $self;
	}

	public function jsonSerialize()
	{
		if(empty(View::getConfig('view_path')) && request()->has('ajax_request_data')){
			View::config(['view_path'=>app_path().'/admin/view/']);
		}
		$this->content(View::fetch('/stack'));
		return parent::jsonSerialize();
	}
}