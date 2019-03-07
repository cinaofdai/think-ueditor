<?php
/**
 * Created by dh2y.
 * bolg: http://blog.csdn.net/sinat_22878395
 * Date: 2018/4/26 0026 16:26
 * Time: 上午11: 32
 * UEditor路由控制
 */

//  遇到/ueditor/xxx 路由转换访问 UeditorController控制器

\think\facade\Route::any('ueditor/[:id]', "\\dh2y\\ueditor\\UeditorController@index");


//百度精简版
\think\facade\Route::any('umeditor/[:id]', "\\dh2y\\ueditor\\UMeditorController@index");





/**
 * 遍历获取目录下的指定类型的文件
 * @param $path
 * @param array $files
 * @return array
 */
function getfiles($path, $allowFiles, &$files = array())
{
    if (!is_dir($path)) return null;
    if(substr($path, strlen($path) - 1) != '/') $path .= '/';
    $handle = opendir($path);
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            $path2 = $path . $file;
            if (is_dir($path2)) {
                getfiles($path2, $allowFiles, $files);
            } else {
                if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
                    $files[] = array(
                        'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                        'mtime'=> filemtime($path2)
                    );
                }
            }
        }
    }
    return $files;
}