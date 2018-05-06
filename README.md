# think-sms
The ThinkPHP5 ueditor
短信通用SDK
## 安装

### 一、执行命令安装
```
composer require dh2y/think-ueditor
```

或者

### 二、require安装
```
"require": {
        "dh2y/think-ueditor":"*"
},
```

或者
###  三、autoload psr-4标准安装
```
   a) 进入vendor/dh2y目录 (没有dh2y目录 mkdir dh2y)
   b) git clone 
   c) 修改 git clone下来的项目名称为think-ueditor
   d) 添加下面配置
   "autoload": {
        "psr-4": {
            "dh2y\\sms\\": "vendor/dh2y/think-ueditor/src"
        }
    },
    e) php composer.phar update
```


## 使用
#### 添加配置文件
 1、默认配置在 conf下面的config.json
 2、需要自己的配置将 conf下面的ueditor.php复制到 extra目录下面（或者通过下面console添加配置文件）
 

#### 使用方法

#### 初始化项目资源
  > 在项目目录下面找到 command.php 添加控制台添加下面配置
```
    return [
        'dh2y\ueditor\Baidu'
    ];
  
```
  > 执行console命令初始化assets资源 
```
    php think baidu   ##默认资源目录
    php think baidu --path /src/path   ##绝对路径
    php think baidu --path admin/js   ##默认资源目录下面的路径
  
```
  > 执行console命令初始化config配置
```
    php think baidu --config y   ##初始化config配置
```

#### 前端调用
     
     1、在think-sms/src/service/ 新增短信服务商类 Dh2y（列如短信服务商为：dh2y）
     2、Dh2y类继承 MessageInterface 短信接口实现里面的方法（其实是抽象类）
     3、实现里面的sendSms 和 getRequestUrl方法

