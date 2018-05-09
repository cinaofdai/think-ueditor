<?php
/**
 * Created by dh2y.
 * bolg: http://blog.csdn.net/sinat_22878395
 * Date: 2018/4/26 0026 16:26
 * Time: 上午11: 32
 * UEditor路由控制
 */

//  遇到/ueditor/xxx 路由转换访问 UeditorController控制器

\think\Route::any('ueditor/[:id]', "\\dh2y\\ueditor\\UeditorController@index");




