<?php
namespace Spider\Regular;

class Reg
{
	
	protected $pattern = array(
		'title' => '/<meta property="og:novel:book_name" content="(.*?)"/',
		'name' => '/<meta property="og:novel:author" content="(.*?)"/',
		'column' => '/<meta property="og:novel:category" content="(.*?)"/',
		'thumb' => '/<meta property="og:image" content="(.*?)"/',
		'des' => '/<meta property="og:description" content="(.*?)"/',
		'content' => '/<dd><a[^>]*href=[\'"]([^"]*)[\'"][^>]*>(.*?)<\/a><\/dd>/',
	);

	protected $content = '';

	public function __construct($content = '', array $pattern = [])
	{
		if($pattern != ''){
			$this->pattern = array_merge($this->pattern,$pattern);
		}
		if($content != ''){
			$this->content = $content;
		}
	}

	public function setContent($content)
	{
		$this->content = $content;
	}
	/**
	 * [title 标题]
	 * @return [array] [description]
	 */
	public function title()
	{
		return $this->run($this->pattern['title']);
	}
	/**
	 * [name 作者]
	 * @return [array] [description]
	 */
	public function name()
	{
		return $this->run($this->pattern['name']);
	}
	/**
	 * [column 小说分类]
	 * @return [array] [description]
	 */
	public function column()
	{
		return $this->run($this->pattern['column']);
	}
	/**
	 * [des 简介]
	 * @return [array] [description]
	 */
	public function des()
	{
		return $this->run($this->pattern['des']);
	}
	/**
	 * [thumb 封面图]
	 * @return [array] [description]
	 */
	public function thumb()
	{
		return $this->run($this->pattern['thumb']);
	}
	/**
	 * [content 文章列表]
	 * @return [array] [description]
	 */
	public function content()
	{
		return $this->run($this->pattern['content']);
	}


	private function run(string $pattern)
	{
		if(empty($this->content)){
			return false;
		}
		preg_match_all($pattern,$this->content,$result,PREG_SET_ORDER);
		return $result;
	}

}