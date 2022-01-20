<?php

namespace app\controller;

use app\BaseController;

use app\model\Project;
use app\model\Transaction;
use app\model\Segement;

class Error extends BaseController
{

    public $project_id = 0;
    public $transaction_id = 0;

    public function __call($method, $args)
    {
        $header = $this->request->header();
        if (isset($header['x-inspector-key'])) {
            $key = $header['x-inspector-key'];
            $version = $header['x-inspector-version'];
            return $this->parseMonitor($key, $version, $this->request->getInput());
        } else {
            return '404';
        }
        $param = $this->request->server();
        trace('in error');
        // trace($param);
        // trace($args);
        // trace($this->request->post());
        // trace($this->request->header());
        $param = $this->request->getInput();
        // trace($param);
        // trace(base64_decode($param));
        // trace(json_decode(base64_decode($param)));
        return json($param);
    }

    public function parseMonitor($key, $version, $input)
    {
        $project = Project::where('key', $key)->find();
        if ($project) {
            $this->project_id = $project->id;
            $data = json_decode(base64_decode($input), 1);
            if ($data) {
                $transcation = array_shift($data);
                if ($transcation->model == 'transaction') {
                    $transcation_insert = [
                        'name'        => $transcation['name'],
                        'type'        => $transcation['type'],
                        'host'        => $transcation['host'],
                        'http'        => $transcation['http']?? null,
                        'url'         => $transcation['url'],
                        'create_time' => datetime($transcation['timestamp']),
                        'context'     => $transcation['context']?? null,
                        'result'      => $transcation['result'],
                        'memory'      => $transcation['memory_peak'],
                        'p50'         => $transcation['duration'],
                    ];
                    $t_row = Transaction::create($transcation_insert);
                    if($data){
                        foreach ($data as $key => $value) {
                            if($value['model'] == 'segment'){
                                Segement::create([
                                    'type'        => $value['type'],
                                    'label'       => $value['label'],
                                    'group_hash'  => $t_row['group_hash'],
                                    'project_id'  => $t_row->id,
                                    'host'        => $value['host'],
                                    'create_time' => datetime($value['timestamp']),
                                    'duration'    => $value['duration'],
                                ]);
                            }else{
                                trace($value);
                            }
                        }
                    }
                    return json('ok');
                } else {
                    return json('402');
                }
            } else {
                return json('404');
            }
        } else {
            return json('404');
        }
    }
}