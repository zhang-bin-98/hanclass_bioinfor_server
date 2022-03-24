<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\common\Jwt;
use app\api\model\User;

class UserController extends Controller
{
    /**
     * 用户登录
     *
     * @return \think\Response
     */
    public function login(Request $request)
    {
        $user_name = $request->param('username');
        $password = $request->param('password');
        
        $payload = array(
            'iss' => 'admin',
            'iat' => time(),
            'exp' => time()+7200,
            'nbf' => time(),
            'user_id' => 0,
            'username' => $user_name,
            'user_role' => 0
        );
        $token=Jwt::getToken($payload);
        // echo "user.login";
        
        return json_encode([          
            "code" => 200,
            "meg" => "登陆成功！",
            "token" => $token,
            "data" => [
                "user_id" => 0,
                "username" => $user_name,
                "email" => "test@test.com",
                "creat_at" => time(),
                "user_role" => 0
            ]
        ]);
    }


    /**
     * 获取用户列表或
     *
     * @return \think\Response
     */
    public function index(Request $request, $user_id = null)
    {
        // // 获取列表 先鉴权
        // if (is_null($user_id)) {
        //     if ($request->user['user_role'] != 1) {
        //         echo json_encode([
        //             "code" => 400,
        //             "msg" => "权限不足！"
        //         ]);
        //         die;
        //     }
        //     $res = User::select();
        // } else {
        //     $res = User::where('user_id', $user_id)->select();
        // }

        // return json_encode([
        //     "code" => 200,
        //     "meg" => "获取成功！",
        //     "data" => $res
        // ]);

        return "123";
    }

    /**
     * 显示创建资源表单页.
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function create(Request $request)
    {
        //
        return "user.create";
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $user_id
     * @return \think\Response
     */
    public function update(Request $request, $user_id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $user_id
     * @return \think\Response
     */
    public function delete($user_id)
    {
        //
    }
}
