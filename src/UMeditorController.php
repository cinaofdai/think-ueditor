<?php
/**
 * Created by dh2y.
 * bolg: http://blog.csdn.net/sinat_22878395
 * Date: 2018/4/26 0026 16:26
 * functional: 精简版百度编辑器功能
 */

namespace dh2y\ueditor;



use think\Config;

class UMeditorController
{
    protected  $config = [
        "savePath" => "upload/image/" ,             //存储文件夹
        "maxSize" => 1000 ,                   //允许的文件最大尺寸，单位KB
        "allowFiles" => [
            ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp"
        ]  //允许的文件格式
    ];

    public function __construct(){
        header("Content-Type:text/html;charset=utf-8");
        error_reporting( E_ERROR | E_WARNING );
        $umeditor = Config::get('umeditor'); //如果存在PHP配置则使用PHP配置 否则使用默认配置
        if($umeditor&&isset($ueditor)){
            $this->config = $ueditor;
        }
    }


    /**
     * 精简版图片上传
     */
    public function index(){
        $up = new MUploader("upfile" , $this->config);

        $callback=$_GET['callback'];

        $info = $up->getFileInfo();

        //返回数据
        if($callback) {
            echo '<script>'.$callback.'('.json_encode($info).')</script>';
        } else {
            echo json_encode($info);
        }
    }

}