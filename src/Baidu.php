<?php
/**
 * Created by dh2y.
 * Blog: http://blog.csdn.net/sinat_22878395
 * Date: 2018/5/6 0006 22:49
 * For: 百度编辑器控制台
 */

namespace dh2y\ueditor;


use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;

class Baidu extends Command
{


    protected function configure(){
        $this->setName('baidu')
             ->addOption('path', 'd', Option::VALUE_OPTIONAL, 'path to move', null)
             ->addOption('config', null, Option::VALUE_OPTIONAL, 'config to init',null)
             ->setDescription('move baidu`s ueditor assets');
             //->setDescription('迁移百度编辑器资源');
    }


    protected function execute(Input $input, Output $output){

        if ($input->hasOption('config')) {
            $src = __DIR__.DS.'conf'.DS.'ueditor.php';
            $path = APP_PATH . 'extra' .DS.'ueditor.php';
            copy($src,$path);
            $output->writeln("<info>init Ueditor conf Successed</info>");
            return;
        }

        $option = $input->getOption('path');
        $path = $option ?: ROOT_PATH . 'public' . DS.'static'.DS;

        //不是根目录 放到默认目录下面的相对目录
        if(DS !=  substr($option,0,1)){
            $path =ROOT_PATH . 'public' . DS.'static'.DS.$option;
        }

        if (is_dir($path)) {
            $src = __DIR__.DS.'..'.DS.'assets';
            $this->moveAssets($src,$path);
            $output->writeln("<info>move Ueditor assets Successed</info>"); //编辑器资源文件初始化成功
        }else{
            $output->writeln("<info>input path is not dir</info>");  //输入的路径不存在
        }
    }

    /**
     * 迁移百度编辑器静态资源
     * @param @string $src  原来目录
     * @param @string $path 目标目录
     */
    protected function moveAssets($src,$path){
        $dir = opendir($src);
        @mkdir($path);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->moveAssets($src . '/' . $file,$path . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$path . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

}