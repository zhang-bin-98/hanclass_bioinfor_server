<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class Gene extends Controller
{
    /**
     * 显示基因列表/详细信息
     *
     * @return \think\Response
     */
    public function index(Request $request, $id = null)
    {
        //
        if(is_null($id)) {
            echo "gene.index";
        } else {
            echo "gene.detail".$id;
        }
        
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        echo "gene.create";
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
