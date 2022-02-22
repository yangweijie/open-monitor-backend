<?php
declare (strict_types = 1);

namespace app\model;

use app\admin\extend\Stack;
use Carbon\Carbon;

/**
 * @mixin \think\Model
 */
class Errors extends BaseModel
{
    public static $types = [
        'stack' => 'json',
    ];

    // 设置json类型字段
    protected $json = ['stack'];


    public function setHashAttr($value, $data)
    {
        return md5("{$data['project_id']}{$data['file']}{$data['line']}{$data['code']}{$data['message']}");
    }

    public function getLastSeenAtAttr($value, $data){
    	return Carbon::parse($data['create_time'])->diffForHumans();  
    }

    public function getFirstSeenAtAttr($value, $data){
    	$first = self::where('hash', $data['hash'])->order('id ASC')->find();
    	return Carbon::parse($first['create_time'])->diffForHumans();  
    }

    public static function title($data){
    	extract($data);
    	return <<<DIV
<div class="my-3">
	<div title="{$file} at line {$line} in {$class}{$type}{$function}" class="p-2 m-0 bg-light text-truncate small pointer">
		<strong>{$file}</strong> <span class="text-muted">at line</span> <strong>{$line}</strong> <span class="text-muted">&nbsp; · &nbsp;</span>
	    {$class}{$type}{$function}
	</div>
</div>
DIV;
    }

    public static function content($data){
    	// return '123';
    	extract($data);
    	$codes = '';
    	// halt($code);
    	foreach ($code as $key => $c) {
    		$codes .= $c['code'].PHP_EOL;
    	}
    	return Stack::create([
    		'start' => $code[0]['line']??0,
    		'line'  => $line,
    		'code'  => $codes,
    	]);
    }
}