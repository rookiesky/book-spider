<?php

namespace Spider\Upload;


use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Upload
{
    private $accessKey = '';
    private $secretKey = '';
    private $bucket = '';
    private $auth = null;
    private $token = null;

    public function __construct()
    {
        $this->accessKey = env('QINIU_ACCESS');
        $this->secretKey = env('QINIU_SECRET');
        $this->bucket = env('QINIU_BUCKET');
        $this->auth = new Auth($this->accessKey,$this->secretKey);
        $this->token = $this->auth->uploadToken($this->bucket);
    }

    public function put($content,$filename)
    {
        $uploadMgr = new UploadManager();
        list($ret,$err) = $uploadMgr->put($this->token,$filename,$content,null,'image/jpeg');

        if($err !== null){
            return null;
        }
        return $ret['key'];
    }

    /**
     * 删除文件
     * @param $file 文件名
     * @return mixed 如果有错误信息则返回，否则返回空
     */
    public function delete($file)
    {
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($this->auth, $config);
        return $bucketManager->delete($this->bucket, $file);
    }
}