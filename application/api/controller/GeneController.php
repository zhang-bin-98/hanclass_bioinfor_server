<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\api\model\Gene;

class GeneController extends Controller
{
    /**
     * 显示基因列表/详细信息
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $filter = $request->param("filter");
        $advace = (array)json_decode($request->param("advace"));

        $page = $request->param("page");
        $rows_per_page = $request->param("rowsPerPage");

        $sort_by = $request->param("sortBy");
        $descending = $request->param("descending");

        if(is_nan($page) || $page <= 0 || is_nan($rows_per_page) || $rows_per_page < 0) {
            echo json_encode([
                'code' => 400,
                'msg' => "参数错误",
                'data' => $request->param()
            ]);
            die;
        }

        
        if(!is_null($filter)) {
            // 全局检索
            $genes = Gene::where(
                'virus_strain_name|accession_id|data_source|lineage|host|location|originating_lab|submitting_lab',
                'like',
                '%'.$filter.'%');
        } elseif(!is_null($advace)) {
            $genes = Gene::where($advace);
        } else {
            $genes = Db::table('gene'); 
        }

        // 排序
        if(!is_null($sort_by)) {
            $genes = $genes->order($sort_by, $descending ? 'asc' : 'desc');
        }
        // 分页
        $rowsNumber = $genes->count();
        if($rows_per_page != 0) {
            $genes = $genes->limit(($page - 1) * $rows_per_page, $rows_per_page);
        }
        // 查询
        try {
            $genes = $genes->select();
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
            "data" => [
                "rowsNumber" => $rowsNumber,
                "returnedData" => $genes,
                "p" => $advace
            ]
        ]);
    }

    /**
     * 查询集合
     */
    public function summary()
    {
        $data = [
            "data_source",
            "lineage",
            "nuc_completeness",
            "sequence_quality",
            "host",
            "location",
        ];

        $res = array();
        try {
            foreach($data as $col) {
                $t = Gene::distinct(true)->field($col)->select();
                $t = json_decode(json_encode($t), true);
                $res[$col] = array_column($t, $col);
            }
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage(),
                "data" => $errGene
            ]);
            die;
        }
        
        return json_encode([
            "code" => 200,
            "msg" => "查询成功",
            "data" => $res
        ]);
    }

    public function count()
    {
        try {
            $city = Gene::distinct(true)->field('location')->count();
            $lineage = Gene::distinct(true)->field('lineage')->count();
            $items = Gene::count();
            $nuc_completeness_percent = $items == 0 
                ? 0 
                : Gene::where('nuc_completeness', 'Complete')->count() / $items;
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage()
            ]);
            die;
        }
        
        return json_encode([
            "code" => 200,
            "msg" => "查询成功",
            "data" => [
                "city" => $city,
                "lineage" => $lineage,
                "items" => $items,
                "nuc_completeness_percent" => $nuc_completeness_percent
            ]
        ]);

    }

    /**
     * 添加基因.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {
        $genes = $request->param('data');
        $user = $request->user;
        $errGene = array();

        if(is_null($genes) && count($genes) > 0) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据缺失",
                'data' => $genes
            ]);
            die;
        }
        
        // 校验
        $geneChecked = array_filter($genes,function($gene) use (& $errGene) {
            $result = $this->validate($gene, 'app\api\validate\Gene');

            if (true === $result) {
                return true;
            } else {
                $gene['err'] = $result;
                array_push($errGene, $gene);
                return false;
            }
        });

        if(count($geneChecked) == 0 || count($errGene) == count($genes)) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据格式错误",
                "data" => $errGene
            ]);
            die;
        }

        $geneChecked = array_map(function($gene) use ($user) {
            $gene['user_id'] = $user['user_id'];
            unset($gene['err']);
            return $gene;
        }, $geneChecked);

        // 插入数据库
        try {
            $successGene = Db::name('gene')
                ->data($geneChecked)
                ->limit(100)
                ->insertAll();
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage(),
                "data" => $errGene
            ]);
            die;
        }

        if($successGene == 0) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库连接错误",
                "data" => $errGene
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "msg" => "添加 ".$successGene." 条数据！",
            "data" => $errGene
        ]);
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
    public function delete(Request $request, $id)
    {
        $user = $request->user;
        $gene = Gene::where('gene_id', $id)->find();

        if(is_null($gene)) {
            echo json_encode([
                'code' => 400,
                'msg' => "gene_id不存在"
            ]);
            die;
        }

        if (!(1 === $user['user_role'] || $gene['user_id'] == $user['user_id'])) {
            echo json_encode([
                'code' => 400,
                'msg' => "权限不足"
            ]);
            die;
        }

        try {
            $gene->delete();
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
