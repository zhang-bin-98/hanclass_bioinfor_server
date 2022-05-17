<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\api\model\Seq;

class SeqController extends Controller
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
            $seqs = Seq::where(
                'virus_strain_name|accession_id|data_source|lineage|host|location|originating_lab|submitting_lab',
                'like',
                '%'.$filter.'%');
        } elseif(!is_null($advace)) {
            $seqs = Seq::where($advace);
        } else {
            $seqs = Db::table('seq'); 
        }

        // 排序
        if(!is_null($sort_by)) {
            $seqs = $seqs->order($sort_by, $descending ? 'asc' : 'desc');
        }
        // 分页
        $rowsNumber = $seqs->count();
        if($rows_per_page != 0) {
            $seqs = $seqs->limit(($page - 1) * $rows_per_page, $rows_per_page);
        }
        // 查询
        try {
            $seqs = $seqs->select();
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
                "returnedData" => $seqs
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
                $t = Seq::distinct(true)->field($col)->select();
                $t = json_decode(json_encode($t), true);
                $res[$col] = array_column($t, $col);
            }
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage(),
                "data" => $errSeq
            ]);
            die;
        }
        
        return json_encode([
            "code" => 200,
            "msg" => "查询成功",
            "data" => $res
        ]);
    }

    /**
     * 统计数量
     */
    public function count()
    {
        try {
            $city = Seq::field('location')->group('location')->count();
            $lineage = Seq::field('lineage')->group('lineage')->count();
            $items = Seq::count();
            $nuc_completeness_percent = $items == 0 
                ? 0 
                : Seq::where('nuc_completeness', 'Complete')->count() / $items;
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
        $seqs = $request->param('data');
        $user = $request->user;
        $errSeq = array();

        if(is_null($seqs) && count($seqs) > 0) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据缺失",
                'data' => $seqs
            ]);
            die;
        }
        
        // 校验
        $seqChecked = array_filter($seqs,function($seq) use (& $errSeq) {
            $result = $this->validate($seq, 'app\api\validate\Seq');

            if (true === $result) {
                return true;
            } else {
                $seq['err'] = $result;
                array_push($errSeq, $seq);
                return false;
            }
        });

        if(count($seqChecked) == 0 || count($errSeq) == count($seqs)) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据格式错误",
                "data" => $errSeq
            ]);
            die;
        }

        $seqChecked = array_map(function($seq) use ($user) {
            $seq['user_id'] = $user['user_id'];
            unset($seq['err']);
            return $seq;
        }, $seqChecked);

        // 插入数据库
        try {
            $successSeq = Db::name('seq')
                ->data($seqChecked)
                ->limit(1000)
                ->insertAll();
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage(),
                "data" => $errSeq
            ]);
            die;
        }

        if($successSeq == 0) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库连接错误",
                "data" => $errSeq
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "msg" => "添加 ".$successSeq." 条数据！",
            "data" => $errSeq,
            "count" => $successSeq
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
        $user = $request->user;
        $seq = Seq::where('seq_id', $id)->find();

        if(is_null($seq)) {
            echo json_encode([
                'code' => 400,
                'msg' => "seq_id不存在"
            ]);
            die;
        }

        if (!(1 === $user['user_role'] || $seq['user_id'] == $user['user_id'])) {
            echo json_encode([
                'code' => 400,
                'msg' => "权限不足"
            ]);
            die;
        }

        $seq_updata = $request->param('data');
        unset($seq_updata['seq_id']);

        try {
            Seq::where('seq_id', $id)->update($seq_updata);
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage()
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "meg" => "更新成功！"
        ]);
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
        $seq = Seq::where('seq_id', $id)->find();

        if(is_null($seq)) {
            echo json_encode([
                'code' => 400,
                'msg' => "seq_id不存在"
            ]);
            die;
        }

        if (!(1 === $user['user_role'] || $seq['user_id'] == $user['user_id'])) {
            echo json_encode([
                'code' => 400,
                'msg' => "权限不足"
            ]);
            die;
        }

        try {
            $seq->delete();
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "数据库错误：".$e->getMessage()
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "msg" => "删除成功！"
        ]);
    }

    /**
     * blast
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function blast(Request $request)
    {
        $db = '/opt/lampp/htdocs/students/202128010315003/tp5/extend/blast/db/coronavirida.blastdb';
        $seq = $request->param('seq');
        if(is_null($seq)) {
            return json_encode([
                "code" => 200,
                "msg" => "查询序列不存在"
            ]);
            die;
        }
        $blastn = "echo {$seq} | blastn -db {$db} -outfmt 0";

        $word_size = $request->param('word_size');
        if(!is_null($word_size)) {
            $blastn = $blastn." -word_size {$word_size}";
        }
        $evalue = $request->param('evalue');
        if(!is_null($evalue)) {
            $blastn = $blastn." -evalue {$evalue} ";
        }

        try {
            exec($blastn, $res);
        } catch (\Exception $e) {
            echo json_encode([
                'code' => 400,
                'msg' => "比对错误：".$e->getMessage()
            ]);
            die;
        }

        return json_encode([
            "code" => 200,
            "msg" => "比对完成",
            "data" => $res
        ]);
    }
}
