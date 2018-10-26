<?php

class Api_Finance_UploadBase64 extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'go' => array(
                'base64' => array('name' => 'base64', 'type' => 'string', 'require' => true)
            )
        );
    }

    public function go()
    {
        $img = $this->base64;

        //文件夹日期
        $ymd = date("Ymd");

        //图片路径地址
        $uploadFolder = sprintf('%s/Public/upload/', API_ROOT);
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0777);
        }

        $basedir = $ymd . '';
        $fullpath = $uploadFolder . $basedir;
        if (!is_dir($fullpath)) {
            mkdir($fullpath, 0777, true);
        }
        $types = empty($types) ? array('jpg', 'gif', 'png', 'jpeg') : $types;

        $img = str_replace(array('_', '-'), array('/', '+'), $img);

        $b64img = substr($img, 0, 100);

        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $b64img, $matches)) {

            $type = $matches[2];
            if (!in_array($type, $types)) {
                return array('code' => 0, 'msg' => '图片格式不正确，只支持 jpg、gif、png、jpeg哦！', 'content' => '');
            }

            $img = str_replace($matches[1], '', $img);
            $img = base64_decode($img);

            $photo = '/' . md5(date('YmdHis') . rand(1000, 9999)) . '.' . $type;
            if (file_put_contents($fullpath . $photo, $img)) {
                $ary['code'] = 1;
                $ary['msg'] = '保存图片成功';
                $ary['content'] = 'upload/' . $basedir . $photo;

                return $ary;
            }
            return array('code' => 0, 'msg' => '上传失败', 'content' => '');
        }

        $ary['code'] = 0;
        $ary['msg'] = '请选择要上传的图片';

        return $ary;
    }
}