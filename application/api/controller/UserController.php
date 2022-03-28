<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\common\Jwt;
use app\api\model\User;

class UserController extends Controller
{

    /**
     * 获取用户列表或
     *
     * @return \think\Response
     */
    public function index(Request $request, $user_id = null)
    {
        $user =$request->user;
        // 获取列表 先鉴权
        if (is_null($user_id)) {
            if ($user['user_role'] != 1) {
                echo json_encode([
                    "code" => 400,
                    "msg" => "权限不足！"
                ]);
                die;
            }
            $res = User::select();
        } elseif ($user['user_id'] == $user_id) {
            $res = User::where('user_id', $user_id)->select();
        } else {
            echo json_encode([
                "code" => 400,
                "msg" => "请求错误！"
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "meg" => "获取成功！",
            "data" => $res
        ]);
    }

    /**
     * 获取 tocken
     * 
     * $user.user_id
     * $user.username
     * $user.user_role
     * 
     * @return json
     */
    private function get_tocken($user)
    {
        if (is_nan($user["user_id"]) || is_null($user["username"]) || is_nan($user["user_role"])) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误！"
            ]);
            die;
        }

        $payload = array(
            'iss' => 'admin',
            'iat' => time(),
            'exp' => time() + 86400,
            'nbf' => time(),
            'user_id' => $user["user_id"],
            'username' => $user["username"],
            'user_role' => $user["user_role"]
        );
        $token=Jwt::getToken($payload);

        unset($user["password"]);
        
        return json_encode([
            "code" => 200,
            "meg" => "登陆成功！",
            "token" => $token,
            "data" => $user
        ]);
    }

    /**
     * 用户登录
     *
     * @return \think\Response
     */
    public function login(Request $request)
    {
        $username = $request->param('username');
        $pwd = $request->param('password');
        // print($username);

        if(is_null($username) || is_null($pwd)) {
            echo json_encode([
                'code' => 400,
                'msg' => "传入参数错误"
            ]);
            die;
        }

        $user = User::where('username', $username)->find();

        if(is_null($user)) {
            echo json_encode([
                'code' => 400,
                'msg' => "用户不存在"
            ]);
            die;
        }

        if($pwd != $user["password"] || $pwd ==""){
            echo json_encode([
                'code' => 400,
                'msg' => "密码或用户名错误！"
            ]);
            die;
        }

        return self::get_tocken($user);
    }

    /**
     * 注册用户
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function create(Request $request)
    {
        $user = [
            'username' => $request->param('username'),
            'password' => $request->param('password'),
            'email' => $request->param('email'),
            'user_role' => 0
        ];

        $result = $this->validate($user, 'app\api\validate\User');

        if (true !== $result) {
            echo json_encode([
                'code' => 400,
                'msg' => "信息格式有误！",
                "data" => $result,
            ]);
            die;
        }

        try {
            $user = User::create($user);
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage()
            ]);
            die;
        }

        return self::get_tocken($user);
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
     * 删除用户
     *
     * @param  int  $user_id
     * @return \think\Response
     */
    public function delete(Request $request, $user_id)
    {
        $user = $request->user;
        
        if (!(1 === $user['user_role'] || $user_id == $user['user_id'])) {
            echo json_encode([
                'code' => 400,
                'msg' => "权限不足"
            ]);
            die;
        }

        $user = User::where('user_id', $user_id)->find();

        if(is_null($user)) {
            echo json_encode([
                'code' => 400,
                'msg' => "用户不存在"
            ]);
            die;
        }

        if(1 === $user['user_role']) {
            echo json_encode([
                'code' => 400,
                'msg' => "管理员无法删除"
            ]);
            die;
        }

        try {
            User::destroy($user['user_id']);
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage()
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "meg" => "删除成功！"
        ]);
    }
}
