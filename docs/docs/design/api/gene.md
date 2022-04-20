## 基因表达元数据接口
  
### 1. 获取基因表达元数据
  
**`GET`** {domain}/gene/meta
  
### 2. 添加基因表达元数据
  
**`POST`** {domain}/gene/meta
  
### 3. 更新(修改)基因表达元数据
  
**`PUT`** {domain}/gene/meta/:data_id
  
### 4. 删除基因表达元数据
  
**`DELETE`** {domain}/gene/meta/:data_id
  
## 基因表达数据接口
  
### 1. 获取基因表达数据
  
**`GET`** {domain}/gene/expression/:data_id/:gene_id
  
### 2. 上传基因表达数据(count矩阵)
  
**`POST`** {domain}/gene/expression/:data_id
  
### 3. 删除基因表达数据
  
**`DELETE`** {domain}/gene/expression/:data_id
