## 用户信息接口

### 1. 用户登录

**``POST``** {domain}/user/login

|参数|类型|必须/可选|默认|描述|
|-|-|-|-|-|
|username|string|**必须**|无|用户名|
|password|string|**必须**|无|加密后的用户密码|

```json {.line-numbers}
{
    "code": 200,
    "msg": "登陆成功！",
    "tocken": "",
    "data": {
        "user_id": "",
        "username": "",
        "email": "",
        "creat_at": "",
        "user_role": ""
    }
}
```

### 2. 用户注册

**`POST`** {domain}/user

|参数|类型|必须/可选|默认|描述|
|-|-|-|-|-|
|username|string|**必须**|无|用户名|
|password|string|**必须**|无|加密后的用户密码|
|email|string|可选|无|邮箱|

```json {.line-numbers}
{
    "code": 200,
    "msg": "注册成功！",
    "tocken": "",
    "data": {
        "user_id": "",
        "username": "",
        "email": "",
        "creat_at": "",
        "user_role": ""
    }
}
```

### 3. 获取用户信息

**`GET`** {domain}/user[/:user_id]

```json {.line-numbers}
{
    "code": 200,
    "msg": "获取成功！",
    "data": [
        {
            "user_id": "",
            "username": "",
            "email": "",
            "creat_at": "",
            "user_role": ""
        }
    ]
}
```

### 4. 更新(修改)用户信息

**PUT** {domain}/user/:user_id

|参数|类型|必须/可选|默认|描述|
|-|-|-|-|-|
|user_id|string|**必须**|无|用户id|
|username|string|可选|无|用户名|
|password|string|可选|无|用户密码|
|email|string|可选|无|邮箱|

```json {.line-numbers}
{
    "code": 200,
    "msg": "修改成功！"
}
```

### 6. 删除用户信息

**`DELETE`** {domain}/user/:user_id

```json {.line-numbers}
{
    "code": 200,
    "msg": "删除成功！"
}
```

## 用户服务接口

### 1. 请求服务接口

**`POST`** {domain}/user/server/:sever_name

### 2. 上传文件文件接口

**`POST`** {domain}/user/server/:sever_name/upload

### 3. 获取结果接口

**`GET`** {domain}/user/server/:server_id

### 4. 获取结果文件

**`GET`** {domain}/user/server/:server_id/:file_name