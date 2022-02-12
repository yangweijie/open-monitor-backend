<?php
declare (strict_types = 1);

namespace app;

use app\admin\extend\Pre;
use app\admin\extend\Segement;
use think\Service;
use Eadmin\form\Form;

/**
 * 应用服务类
 */
class AppService extends Service
{
    public function register()
    {
        // 服务注册
        Form::extend('pre', Pre::class);
        Form::extend('segment', Segement::class);
    }

    public function boot()
    {
        // 服务启动
    }
}