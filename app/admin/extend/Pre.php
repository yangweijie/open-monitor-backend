<?php
namespace app\admin\extend;

use Eadmin\component\form\Field;
use think\facade\View;

class Pre extends Field
{

	public static function create($content = null, $field = '')
	{
		// trace('in');
		$json_arr = is_string($content)? json_decode($content, 1): $content;
		if(null !== $json_arr){
			$content = json_encode($json_arr, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
		}
		// trace($content);
		$self = new self('', $content);
		return $self;
	}

	public function jsonSerialize()
	{
		if(empty(View::getConfig('view_path')) && request()->has('ajax_request_data')){
			View::config(['view_path'=>app_path().'/admin/view/']);
		}
		$this->content(View::fetch('/pre'));
		return parent::jsonSerialize();
	}
}