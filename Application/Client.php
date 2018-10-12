<?php
namespace Spider;

class Client
{

	protected $init = null;  //初始化curl
	protected $result = null; //curl结果集
	public $httpInfo;  //http 信息
	public $error;  //错误信息

	public function __construct()
	{
		if($this->init == null){
			$this->init = curl_init();
		}
	}

	public function get(string $url)
	{
		curl_setopt($this->init, CURLOPT_URL, $url);
		return $this->checkResult();
	}

	/**
	 * [checkResult 验证交互是否成功，如果失败返回false]
	 * @return [type] [description]
	 */
	private function checkResult()
	{
		$this->exec();

		$code = curl_errno($this->init);
		
		if($code){
			$this->error = 'Error Code:' . $code . ";error message:" . curl_error($this->init);
			return false;
		}
		$this->getInfo();
		return $this->result;
	}

	/**
	 * [getInfo 获取一个cURL连接资源句柄的信息]
	 * @return [type] [description]
	 */
	private function getInfo()
	{
		$this->httpInfo = curl_getinfo($this->init);
	}

	/**
	 * [exec 执行 cURL 会话]
	 * @return [type] [description]
	 */
	private function exec()
	{
		$ch = $this->init;

		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		//CURLOPT_FOLLOWLOCATION 跟踪网站302跳转
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		//CURLOPT_TIMEOUT 允许执行的最长秒数
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	
		$this->result = curl_exec($ch);
		$this->init = $ch;
	}
	/**
	 * [close 关闭连接]
	 * @return [type] [description]
	 */
	private function close()
	{
		curl_close($this->init);
	}

	public function __destruct()
    {
        $this->close();
    }



}