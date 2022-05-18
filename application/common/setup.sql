

CREATE TABLE IF NOT EXISTS user (
    user_id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(25) NOT NULL UNIQUE,
    password varchar(10) NOT NULL,
    email varchar(25),
    create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_role int NOT NULL DEFAULT 0
);

DESC user;

-- INSERT INTO user (username, password, user_role) VALUES ('zhangbin', 'zb123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('guoxutong', 'gxt123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('lingfangmin', 'lfm123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('zhangmeng', 'zm123456', '1');

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

DESC seq;

CREATE TABLE IF NOT EXISTS gene_exp (
    gene_exp_id int PRIMARY KEY AUTO_INCREMENT,
    gene_id varchar(25),
    gene_name varchar(25),
    col varchar(25),
    data varchar(25)
);

DESC gene_exp;

LOAD DATA LOCAL INFILE '/opt/lampp/htdocs/students/202128010315003/tp5/extend/DEG/deseq2_171742/rlog_data_longer.csv' 
INTO TABLE s202128010315003.gene_exp 
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(gene_id,gene_name,col,data);

CREATE TABLE IF NOT EXISTS gene_deg (
    gene_id varchar(25) PRIMARY KEY,
    baseMean varchar(25),
    log2FoldChange varchar(25),
    lfcSE varchar(25),
    stat varchar(25),
    pvalue varchar(25),
    padj varchar(25),
    gene_name varchar(25)
);

DESC gene_deg;

LOAD DATA LOCAL INFILE '/opt/lampp/htdocs/students/202128010315003/tp5/extend/DEG/deseq2_171742/res_gene_data.csv' 
INTO TABLE s202128010315003.gene_deg 
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
