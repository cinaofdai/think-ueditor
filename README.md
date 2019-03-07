# think-ueditor
The ThinkPHP5 ueditor/umeditor
百度编辑器 composer模块
## 安装

### 一、执行命令安装
```
composer require dh2y/think-ueditor
```

或者

### 二、require安装
##### thinkphp5.0安装
```
"require": {
        "dh2y/think-ueditor":"1.*"
},
```
##### thinkphp5.1安装
```
"require": {
        "dh2y/think-ueditor":"2.*"
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


## 完全版使用
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
     
   >引用百度编辑器js
```   
  <!-- 配置文件 -->
  <script type="text/javascript" src="__static__/admin/js/ueditor/ueditor.config.js"></script>
  <!-- 编辑器源码文件 -->
  <script type="text/javascript" src="__static__/admin/js/ueditor/ueditor.all.js"></script>
```
  >普通使用案例
```
 //###############html代码###############
    <!---------完整的编辑器功能--------->
    <div style="display: none">
             <!-- 加载编辑器的容器 -->
            <script id="container" type="text/plain"></script>
    </div>
    
  //###############JS代码###############  
  
  _Ueditor = UE.getEditor('container');
    
```
  
  >VueJS使用案例
```
    //###############html代码###############
    <div style="display: none">
         <!-- 加载编辑器的容器使用图片上传功能 -->
        <script id="image" type="text/plain"></script>
    </div>
    
    <!---------完整的编辑器功能--------->
    <div style="display: none">
             <!-- 加载编辑器的容器 -->
            <script id="container" type="text/plain"></script>
    </div>
    
    
   //###############JS代码###############
    var _editor;           //初始化百度编辑器图片

    var model = {
        model: {}
    };
    var store_model = new Vue({
        el: "#form-admin",
        data: model,
        mounted: function () {
            this.initTime();
            this.initImage();
        },
        methods: {
        
             //初始化百度编辑器
            initUEditor:function () {
                _Ueditor = UE.getEditor('container');
            },

            //初始化时间选择插件
            initTime:function (event) {
                laydate.render({elem: '#start_time'});
                laydate.render({elem: '#end_time'});
            },

            //初始化百度编辑器上传图片
            initImage:function(event){
                _editor = UE.getEditor('image');
                _editor.ready(function () {
                    //设置编辑器不可用
                    //_editor.setDisabled();
                    //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
                    _editor.hide();
                    //侦听图片上传
                    _editor.addListener('beforeInsertImage', function (t, arg) {
                        console.log( arg);
                        //app_model.model.pic = arg[0].src;
                        //图片预览
                        //$("#form-input-pic").attr("src", arg[0].src);
                    })

                });

            },

            //上传图片点击事件弹出图片框
            upImage:function () {
                var myImage = _editor.getDialog("insertimage");
                myImage.open();
            },


            doSubmit: function () {
                $.ajax({
                    type: 'post',
                    data: this.model,
                    url: "xxxx/xxxx",
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                       
                    }
                });
            }
        }
    });

```

## 精简版版使用
#### 添加配置文件

 1、需要自己的配置将 conf下面的umeditor.php复制到 extra目录下面（或者通过下面console添加配置文件）
 

#### 使用方法

#### 前端调用
     
   >引用百度编辑器js
```   
  样式皮肤
  <link href="__static__/admin/js/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">

  <script type="text/javascript" charset="utf-8" src="__static__/admin/js/umeditor/umeditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="__static__/admin/js/umeditor/umeditor.min.js"></script>
```
  >普通使用案例
```
 //###############html代码###############
    <!---------完整的编辑器功能--------->
     <div class="formControls col-xs-8 col-sm-9">
            <!-- 加载编辑器的容器 -->
            <script type="text/plain" id="container" style="width:100%;height:240px;"></script>
     </div>
    
  //###############JS代码###############  
  
  _UMeditor = UM.getEditor('container', {
      /* 传入配置参数,可配参数列表看umeditor.config.js */
      toolbar: ['undo redo | bold italic underline | link unlink | image video ']
  });
    
```
  
  >VueJS使用案例
```
    //###############html代码###############
    <div style="display: none">
         <!-- 加载编辑器的容器使用图片上传功能 -->
        <script id="image" type="text/plain"></script>
    </div>
    
    <!---------完整的编辑器功能--------->
    <div style="display: none">
             <!-- 加载编辑器的容器 -->
            <script id="container" type="text/plain"></script>
    </div>
    
    
   //###############JS代码###############
    var _UMeditor;           //初始化百度编辑器图片

    var model = {
        model: {}
    };
    var store_model = new Vue({
        el: "#form-admin",
        data: model,
        mounted: function () {
            this.initImage();
        },
        methods: {
        
             //初始化百度编辑器
            initUEditor:function () {
                _UMeditor = UM.getEditor('container');;
            },

            //初始化百度编辑器上传图片
            initImage:function(event){
                _meditor = UM.getEditor('image');
                _meditor.ready(function () {
                    //设置编辑器不可用
                    //_meditor.setDisabled();
                    //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
                    _meditor.hide();
                    //侦听图片上传
                    _meditor.addListener('beforeInsertImage', function (t, arg) {
                        console.log( arg);
                        //app_model.model.pic = arg[0].src;
                        //图片预览
                        //$("#form-input-pic").attr("src", arg[0].src);
                    })

                });

            },

            //上传图片点击事件弹出图片框
            upImage:function () {
                var myImage = _meditor.getDialog("insertimage");
                myImage.open();
            },


            doSubmit: function () {
                $.ajax({
                    type: 'post',
                    data: this.model,
                    url: "xxxx/xxxx",
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                       
                    }
                });
            }
        }
    });

```