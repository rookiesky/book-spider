<?php
if(!function_exists('env')){
    /**
     * 获取env文件
     * @param string $key
     * @param null $default
     * @return array|false|null|string
     */
    function env($key,$default = null){
        $value = getenv($key);
        if ($value == '' && $default != null) {
            $value = $default;
        }
        return $value;
    }
}
if(function_exists('dd') === false){
    function dd($data)
    {
        dump($data);die;
    }
}