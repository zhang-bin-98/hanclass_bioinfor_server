<?php

namespace app\http\middleware;

class CheckTime
{
    public function handle($request, \Closure $next)
    {
        $time = $request->header('Time');

        if (!isset($time) || intval($time) <= 1) {
            echo json_encode([
                'code' => 400,
                'msg' => "时间戳不存在！"
            ]);
            die;
        }

        if (time() - intval($time) > 60) {
            echo json_encode([
                'code' => 400,
                'msg' => "请求超时！"
            ]);
            die;
        }

        return $next($request);
    }
}
