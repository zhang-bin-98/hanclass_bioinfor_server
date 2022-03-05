<?php

namespace app\http\middleware;

class CheckTime
{
    public function handle($request, \Closure $next)
    {
        $arr = $request->only(['time']);
        if (!isset($arr['time']) || intval($arr['time']) <= 1) {
            echo json_encode([
                'code' => 400,
                'msg' => "时间戳不存在！"
            ]);
            die;
        }
        if (time() - intval($arr['time']) > 60) {
            echo json_encode([
                'code' => 400,
                'msg' => "请求超时！"
            ]);
            die;
        }

        return $next($request);
    }
}
