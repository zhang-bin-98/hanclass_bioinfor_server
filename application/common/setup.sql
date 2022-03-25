
USE s202128010315003

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
    virus_strain_name varchar(25),
    accession_id varchar(25) NOT NULL UNIQUE,
    data_resource varchar(25),
    related_id varchar(25),
    lineage varchar(25),
    nuc_completeness varchar(25),
    sequence_length int,
    sequence_quality varchar(25),
    quality_assessment varchar(25),
    host varchar(25),
    sample_collection_date DATETIME,
    sample_location varchar(25),
    originating_lab varchar(25),
    submission_date DATETIME,
    submitting_lab varchar(25),
    create_time DATETIME,
    last_update_time DATETIME,
    CONSTRAINT user_gene 
        FOREIGN KEY(user_id) REFERENCES user(user_id)
);

DESC genes;


-- INSERT INTO user (username, password, user_role) VALUES ('zhangbin', 'zb123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('guoxutong', 'gxt123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('zhangmeng', 'zm123456', '1');
-- INSERT INTO user (username, password, user_role) VALUES ('lingfangmin', 'lfm123456', '1');