<?php

namespace app\controller\traits;


trait ApiJump
{
    public function success($msg = ''){
        return json($msg, 200);
    }

    public function error($msg){
        return json($msg, 422);
    }

    public function error401(){
        return json('No valid API Key was given', 401);
    }
}