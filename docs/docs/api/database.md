# 数据库设计

1. 用户模块: 
    + user 表

        | user_role.value | annotation |
        | :-: | :-: |
        | 0 | 普通用户 |
        | 1 | 管理员 |

    + user_action

3. 基因模块: 
    + seq 表
    + gene_meta 表
    + gene_anno 表
    + gene_exp 表

```mermaid
erDiagram
    user ||--o{ seq : "create"
    user ||--o{ gene_meta : "create"
    gene_meta ||--|{ gene_exp : ""
    gene_anno ||--|{ gene_exp : ""
    user ||--o{ user_action : "create"

    user {
        int user_id PK
        varchar username "用户名"
        varcahr password "密码"
        varchar email "邮箱"
        timestamp create_at "注册时间"
        int user_role "用户角色"
    }

    user_action {
        int user_action_id PK
        int user_id FK
        timestamp create_at "操作时间"
        varchar action "操作的项目"
        varchar result_path "结果数据路径"
        varchar log_path "日志文件路径"
    }

    seq {
        int seq_id PK
        int user_id FK "上传者"
        varchar virus_strain_name "病毒株名"
        varchar accession_id "序列号"
        varchar data_source "数据来源"
        varchar related_id "相关ID"
        varchar lineage "谱系"
        varchar nuc_completeness "序列完整度"
        int sequence_length "序列长度"
        varchar sequence_quality "序列质量"
        varchar quality_assessment "质量评估"
        varchar host "宿主"
        datetime sample_collection_date "采样日期"
        varchar location "采样地点"
        varchar originating_lab "样本提供单位"
        datetime submission_date "提交时间"
        varchar submitting_lab "数据递交单位"
        datetime create_time "发布时间"
        datetime last_update_time "更新时间"
    }

    gene_meta {
        int gene_meta_id PK
        int user_id FK "上传者"
        varchar data_set_name "数据集名"
        varchar article_dio
        varchar note "数据集介绍"
        timestamp create_at "创建时间"
        DATETIME upload_at "数据上传时间"
    }

    gene_exp {
        int gene_exp_id PK
        int gene_meta_id FK
        varchar gene_id FK "行名" 
        varchar col "列名"
        varcahr data "数据"
        decimal tpm 
    }

    gene_anno {
        int gene_anno_id PK
        varchar seq_id "序列的编号"
        varchar source "注释的来源"
        varchar type "注释信息的类型"
        int start "该基因或转录本在参考序列上的起始位置"
        int end "该基因或转录本在参考序列上的终止位置"
        varchar score
        varchar strand "正链(+)或负链(-)"
        varchar phase "仅对注释类型为“CDS”有效，表示起始编码的位置"
        varchar gene_id 
        varchar transcript_id
    }
```
