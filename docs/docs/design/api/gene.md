## 基因表达数据接口

### 1. 获取基因列表

**`GET`** {domain}/gene

返回数据
```json
{
    "code": 200,
    "msg": "查询成功！",
    "data": [
        {
            "gene_id": "",
            "gene_name": "",
            "log2_fold_change": 0,
            "pvalue": 0,
            "padj": 0
        },
    ]
}
```


### 2. 获取基因表达数据
  
**`POST`** {domain}/gene

|参数|类型|必须/可选|默认|描述|
|-|-|-|-|-|
|ids|string|必选|无|查询的gene id 集合，以`,`连接|

> 此处返回`rlog`转换的表达矩阵，格式为长表

返回数据
```json
{
    "code": 200,
    "msg": "查询成功！",
    "data": [
        {
            "gene_id": "",
            "gene_name": "",
            "col": "",
            "data": ""
        },
    ]
}
```
