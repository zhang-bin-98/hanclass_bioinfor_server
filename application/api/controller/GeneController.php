<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\GeneDeg;
use app\api\model\GeneExp;

class GeneController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        try {
            // $degs = GeneDeg::all();
            $degs = GeneDeg::field('gene_id,gene_name,log2FoldChange,pvalue,padj')
            ->order(['padj','log2FoldChange'=>'desc'])
            ->select();
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "查询错误：".$e->getMessage(),
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "msg" => "查询成功",
            "data" => $degs
        ]);
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function exp(Request $request)
    {
        $id_arrray = explode(",",$request->param('ids'));
        
        try {
            $exps = GeneExp::where([
                'gene_id' => $id_arrray
            ])
            ->field('gene_id,gene_name,col,data')
            ->select();
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "查询错误：".$e->getMessage(),
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "msg" => "查询成功",
            "data" => $exps
        ]);
    }
    
}
