<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class User extends Controller
{
    /**
     * 用户登录
     *
     * @return \think\Response
     */
    public function login(Request $request, $id = null)
    {
        //
        // echo "user.login";
        return json_encode($request->param());
    }


    /**
     * 获取用户列表或
     *
     * @return \think\Response
     */
    public function index(Request $request, $id = null)
    {
        // 返回用户列表，或一条用户数据
        return json_encode(["id" => $id, "request" => $request->get()]);
    }

    /**
     * 显示创建资源表单页.
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
