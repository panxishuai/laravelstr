<?php

namespace App\Libs\org;

//验证码类
class Vcode
{
    public function aaa()
    {
        //保存到session上
        session_start();
        //用来存储数据
        $captcha = "";
        //创建画布
        $image = imagecreatetruecolor(100, 40);
        //设置背景
        $bgcolor = imagecolorallocate($image, 255, 0, 0);
        //填充背景颜色
        imagefill($image, 0, 0, $bgcolor);
        //实现数字
        for ($i = 0; $i < 4; $i++) {
            //定义字体
            $fontsize = 6;
            //定义颜色
            $fontcolor = imagecolorallocate($image, rand(1, 120), rand(1, 120), rand(1, 120));
            //定义内容
            $fontcontent = rand(1, 9);

            $captcha .= $fontcontent;

            //将内容画到画布上去
            $x = ($i * 100 / 4) + rand(5, 10);
            $y = rand(5, 10);
            imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
        }
        //设置干扰素
        for ($i = 0; $i < 200; $i++) {
            //设置颜色
            $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
            imagesetpixel($image, rand(1, 99), rand(1, 29), $pointcolor);
        }
        //保存到session中
        // $_SESSION["captcha"] = $captcha;
        session()->put('captcha', $captcha);
        //输出图片
        header("content-type:image/png");
        imagepng($image);
        //销毁照片
        imagedestroy($image);
    }
}
