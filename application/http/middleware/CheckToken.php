<?php

namespace app\http\middleware;

use app\common\Jwt;

class CheckToken
{
    public function handle($request, \Closure $next)
    {       
        $token = $request->header('X-Authorization');

        if (!$token) {
            echo json_encode([
                "code" => 400,
                "msg" => "tocken缺失!"
            ]);
            die;
        }

        //对token进行验证签名
        $payload = Jwt::verifyToken($token);

        if (!$payload || !isset($payload['user_id']) || !isset($payload['user_role'])) {
            echo json_encode([
                "code" => 400,
                "msg" => "tocken错误!"
            ]);
            die;
        }

        $request->user = $payload;

        return $next($request);
    }
}
