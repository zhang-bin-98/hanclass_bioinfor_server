

CREATE TABLE IF NOT EXISTS user (
    user_id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(25) NOT NULL UNIQUE,
    password varchar(10) NOT NULL,
    email varchar(25),
    create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_role int NOT NULL DEFAULT 0
);

DESC user;

CREATE TABLE IF NOT EXISTS gene (
    gene_id int PRIMARY KEY AUTO_INCREMENT,
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
    CONSTRAINT user_gene 
        FOREIGN KEY(user_id) REFERENCES user(user_id)
);

DESC genes;


-- INSERT INTO user (username, password, user_role) VALUES ('zhangbin', 'zb123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('guoxutong', 'gxt123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('lingfangmin', 'lfm123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('zhangmeng', 'zm123456', '1');