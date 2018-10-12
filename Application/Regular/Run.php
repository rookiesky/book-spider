<?php
namespace Spider\Regular;

use Spider\Regular\Reg;

class Run
{
    public $reg;

    public function __construct($content = '',$pattern = [])
    {
        $this->reg = new Reg($content,$pattern);
    }

    public function boot()
	{
		if(empty($this->reg->title())){
            return false;
        }
		$title = $this->gbkToUtf($this->reg->title()[0][1]);
		$name = $this->gbkToUtf($this->reg->name()[0][1]);
		$des = $this->gbkToUtf($this->reg->des()[0][1]);
		$thumb = $this->gbkToUtf($this->reg->thumb()[0][1]);
		$column = $this->gbkToUtf($this->reg->column()[0][1]);
		$list = $this->formatList($this->reg->content());

		return compact(['title','name','des','thumb','column','list']);
	}

    public function getContent($content)
    {
        $this->reg->setContent($content);
        $content = $this->reg->content();

        if(empty($content)){
            return false;
        }
        return $this->gbkToUtf($content[0][1]);
    }

	protected function formatList($list)
	{
		$content = array();

		foreach ($list as $key => $value) {
			$content[$key]['title'] = $this->gbkToUtf($value[2]);
			$content[$key]['link'] = $value[1];
		}
		return $content;
	}

	public function gbkToUtf($content)
	{
		return mb_convert_encoding($content,'UTF-8','GBK');
	}
}