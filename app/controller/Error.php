<?php

namespace app\controller;

use app\BaseController;

use app\model\Project;
use app\model\Transaction;
use app\model\Segement;
use app\model\Error AS ErrorModel;

class Error extends BaseController
{

    public $project_id = 0;
    public $transaction_id = 0;

    public function __call($method, $args)
    {
        $header = $this->request->header();
        trace('in error');
        // trace($param);
        // trace($args);
        // trace($this->request->post());
        // trace($this->request->header());
        // trace($param);
        // trace(base64_decode($param));
        if (isset($header['x-inspector-key'])) {
            $key     = $header['x-inspector-key'];
            $version = $header['x-inspector-version'];
            $param   = $this->request->getInput();
            trace(base64_decode($param));
            trace(json_decode(base64_decode($param)));
            return $this->parseMonitor($key, $version, $this->request->getInput());
        } else {
            return '404';
        }
    }

    public function parseMonitor($key, $version, $input)
    {
        $project = Project::where('key', $key)->find();
        if ($project) {
            $this->project_id = $project->id;
            $data             = json_decode(base64_decode($input), 1);
            $t_row            = null;
            if ($data) {
                foreach ($data as $key => $item) {
                    switch ($item['model']) {
                        case 'transaction':
                            $transaction_insert = [
                            'name'        => $item['name'],
                            'type'        => $item['type'],
                            'host'        => $item['host'],
                            'http'        => $item['http']?? null,
                            'create_time' => datetime($item['timestamp']),
                            'context'     => $item['context']?? null,
                            'result'      => $item['result'],
                            'memory'      => $item['memory_peak'],
                            'p50'         => $item['duration'],
                            'group_hash'  => '',
                            'hash'        => $item['hash'],
                            'project_id'  => $this->project_id,
                            'result'      => $item['result'],
                        ];
                        $t_row = Transaction::create($transaction_insert);
                            break;
                        case 'segment':
                            if($t_row){
                                $group_hash = $t_row['group_hash'];
                            }else{
                                $group_hash = Transaction::where('hash', $item['transaction']['hash'])->value('group_hash')??'';
                                if($group_hash){
                                    $t_row = ['group_hash' => $group_hash];
                                }
                            }
                            if($group_hash){
                                Segement::create([
                                    'type'        => $item['type'],
                                    'label'       => $item['label'],
                                    'group_hash'  => $group_hash,
                                    'project_id'  => $this->project_id,
                                    'hash'        => '',
                                    'host'        => $item['host'],
                                    'create_time' => datetime($item['timestamp']),
                                    'duration'    => $item['duration'],
                                    'label'       => $item['label'],
                                    'start'       => $item['start'],
                                ]);
                            }
                            break;
                        default:
                            if($t_row){
                                $group_hash = $t_row['group_hash'];
                            }else{
                                $group_hash = Transaction::where('hash', $item['transaction']['hash'])->value('group_hash')??'';
                                if($group_hash){
                                    $t_row = ['group_hash' => $group_hash];
                                }
                            }
                            ErrorModel::create([
                                'project_id'  => $this->project_id,
                                'create_time' => datetime($item['timestamp']),
                                'message'     => $item['message'],
                                'group_hash'  => $group_hash,
                                'muted'       => 0,
                                'class'       => $item['class'],
                                'file'        => $item['file'],
                                'line'        => $item['line'],
                                'code'        => $item['code'],
                                'stack'       => $item['stack'],
                                'hash'        => '',
                                'handled'     => 1,
                            ]);
                            break;
                    }
                }
            } else {
                return json('404');
            }
        } else {
            return json('404');
        }
    }
}