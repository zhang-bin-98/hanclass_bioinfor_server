# 序列数据管理

## 1. 序列列表页面

+ 页面描述：序列信息的浏览与检索
+ 功能：
    + 数据表格(排序，分页，列控制)
        > virus_strain_name "病毒株名" **点击链接至详情页**
        > accession_id "序列号" **点击链接至NCBI**
        > data_source "数据来源"
        > related_id "相关ID"
        > lineage "谱系"
        > nuc_completeness "序列完整度"
        > sequence_length "序列长度"
        > sequence_quality "序列质量"
        > quality_assessment "质量评估"
        > host "宿主"
        > sample_collection_date "采样日期"
        > location "采样地点"
        > originating_lab "样本提供单位"
        > submission_date "提交时间"
        > submitting_lab "数据递交单位"
        > create_time "发布时间"
        > last_update_time "更新时间"
    + 全局搜索 
    + 高级搜索
    + 下载数据(暂缓)
            
## 2. 序列详情页面

+ 页面描述：
    + 序列数据的基本信息，以及genebank的序列说明
    + 普通用户仅可见个人数据
    + 管理员可见所有数据
+ 功能：
    + 基本数据浏览(需调用NCBI的API)
    + 登录用户删改数据，需二次确认，反馈处理结果

## 3. 序列上传页面

+ 页面描述: 可以单条或使用文件多条上传序列信息
+ 功能：
    + 加载本地文件
    + 手动录入数据
    + 预览待上传数据
        > 同序列列表页面数据表格
    + 修改待上传数据
    + 上传数据
        
# 基因数据管理

## 1. 基因表达

+ 页面描述：人类基因列表，以及列表中基因在某数据集中的表达情况
+ 功能：
    + 基因列表(选择，筛选，搜索)
        > gene_id
        > seq_id "序列的编号"
        > start "该基因或转录本在参考序列上的起始位置"
        > end "该基因或转录本在参考序列上的终止位置"
        > strand "正链(+)或负链(-)"
        > logfc "差异基因"
    + 数据集
    + 基因表达热图


、


        
