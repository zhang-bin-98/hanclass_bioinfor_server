# 数据库设计

## 1. 用户模块
+ user 表: 存储用户信息

    | user_role.value | annotation |
    | :-: | :-: |
    | 0 | 普通用户 |
    | 1 | 管理员 |

```sql
--用户信息
CREATE TABLE IF NOT EXISTS user (
    user_id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(25) NOT NULL UNIQUE,
    password varchar(10) NOT NULL,
    email varchar(25),
    create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_role int NOT NULL DEFAULT 0
);
```

## 2. 序列模块
+ seq 表: 存储序列信息

```sql

--序列信息
CREATE TABLE IF NOT EXISTS seq (
    seq_id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    virus_strain_name varchar(255),
    accession_id varchar(100) NOT NULL UNIQUE,
    data_source varchar(100),
    related_id varchar(100),
    lineage varchar(100),
    nuc_completeness varchar(100),
    sequence_length int,
    sequence_quality varchar(100),
    quality_assessment varchar(100),
    host varchar(100),
    sample_collection_date DATETIME,
    location varchar(255),
    originating_lab varchar(350),
    submission_date DATETIME,
    submitting_lab varchar(350),
    create_time DATETIME,
    last_update_time DATETIME,
    CONSTRAINT user_seq 
        FOREIGN KEY(user_id) REFERENCES user(user_id)
);
```

## 3. 基因模块
+ gene_deg 表: 存储差异基因信息
```sql
--差异基因信息
CREATE TABLE IF NOT EXISTS gene_deg (
    gene_id varchar(25) PRIMARY KEY,
    baseMean varchar(25),
    log2_fold_change varchar(25),
    lfcSE varchar(25),
    stat varchar(25),
    pvalue varchar(25),
    padj varchar(25),
    gene_name varchar(25)
);
```

+ gene_exp 表: 存储rlog转换后的表达矩阵

```sql
--表达矩阵
CREATE TABLE IF NOT EXISTS gene_exp (
    gene_exp_id int PRIMARY KEY AUTO_INCREMENT,
    gene_id varchar(25),
    gene_name varchar(25),
    col varchar(25),
    data varchar(25)
);

```




