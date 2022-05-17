# 序列数据接口

domain: 10.1.70.10/students/202128010315003/tp5/public

## 1. 获取序列列表
  
**`GET`** {domain}/seq

> 支持全局搜索，高级搜索，排序，分页
  
|参数|类型|必须/可选|默认|描述|
|-|-|-|-|-|
|page|int|可选|1|当前页|
|list_rows|int|可选|20|每页数量|
|查询条件|string|可选|无|参数与值|
  
返回数据
```json
{
    "code": 200,
    "msg": "查询成功！",
    "data": {
        "total": 1,
        "list": [
            {
                "seq_id": "",
                "virus_strain_same": "",
                "accession_id": "",
                "data_source": "",
                "related_id": "",
                "lineage": "",
                "nuc_completeness": "",
                "sequence_length": "",
                "sequence_quality": "",
                "quality_assessment": "",
                "host": "",
                "sample_collection_date": "",
                "location": "",
                "originating_lab": "",
                "submission_date": "",
                "submitting_lab": "",
                "create_time": "",
                "last_update_time": ""
            }
        ]
    }
}
```


## 2. 添加序列信息
  
**`POST`** {domain}/seq

> 默认为批量添加，会返回上传失败的序列与失败原因
  
请求体：
```json
"data": [
    {
        "seq_id": "",
        "virus_strain_name": "",
        "accession_id": "",
        "data_source": "",
        "related_id": "",
        "lineage": "",
        "nuc_completeness": "",
        "sequence_length": "",
        "sequence_quality": "",
        "quality_assessment": "",
        "host": "",
        "sample_collection_date": "",
        "location": "",
        "originating_lab": "",
        "submission_date": "",
        "submitting_lab": "",
        "create_time": "",
        "last_update_time": ""
    }
]
```


返回数据
```json
{
    "code": 200,
    "msg": "成功添加*条数据！",
    "data": [
        {
            "seq_id": "",
            "virus_strain_name": "",
            "accession_id": "",
            "data_source": "",
            "related_id": "",
            "lineage": "",
            "nuc_completeness": "",
            "sequence_length": "",
            "sequence_quality": "",
            "quality_assessment": "",
            "host": "",
            "sample_collection_date": "",
            "location": "",
            "originating_lab": "",
            "submission_date": "",
            "submitting_lab": "",
            "create_time": "",
            "last_update_time": "",
            "err": ""
        }
    ],
    "count": 10
}
```

  
## 3. 更新(修改)序列信息
  
**`PUT`** {domain}/seq/:seq_id
  
请求体：
```json
"data": {
    "seq_id": "",
    "virus_strain_name": "",
    "accession_id": "",
    "data_source": "",
    "related_id": "",
    "lineage": "",
    "nuc_completeness": "",
    "sequence_length": "",
    "sequence_quality": "",
    "quality_assessment": "",
    "host": "",
    "sample_collection_date": "",
    "location": "",
    "originating_lab": "",
    "submission_date": "",
    "submitting_lab": "",
    "create_time": "",
    "last_update_time": ""
}
```
 

返回数据
```json
{
    "code": 200,
    "msg": "修改成功！"
}
```
  

## 4. 删除序列信息
  
**`DELETE`** {domain}/seq/:seq_id

返回数据
```json
{
    "code": 200,
    "msg": "删除成功！"
}
```


## 5. 条目集合查询
  
**`GET`** {domain}/seq/summary

> 返回序列列表高级筛选选项

返回数据
```json
{
    "code": 200,
    "msg": "查询成功！",
    "data": {
        "data_source": [],
        "lineage": [],
        "nuc_completeness": [],
        "sequence_quality": [],
        "host": [],
        "location": []
    }
}
```
  

## 6. 条目数量查询
  
**`GET`** {domain}/seq/summary

> 首页统计信息

返回数据 
```json
{
    "code": 200,
    "msg": "查询成功！",
    "data": {
        "city": 130,
        "lineage": 218,
        "nuc_completeness_percent": "92%",
        "items": 9588
    }
}
```


