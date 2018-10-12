<?php
namespace Spider;

use Spider\Regular\Run;
use Spider\Repositories\BookContentRepository;
use Spider\Repositories\SpiderLinkErrorRepository;
use Spider\Repositories\SpiderLinkRepository;

class Content
{
    protected $spiderLinkRepository;
    protected $spiderLinkErrorRepository;
    protected $regular;
    const CONTENT_PATTER = '/<div id="content">(.*?)<\/div>/';

    public function __construct()
    {
        $this->spiderLinkRepository = new SpiderLinkRepository();
        $this->spiderLinkErrorRepository = new SpiderLinkErrorRepository();
        $this->regular =  new Run('',['content'=>self::CONTENT_PATTER]);

    }

    public function boot()
    {
       $list = $this->spiderLinkRepository->limitGet(50);
       $result = $this->listRegFormat($list);
        (new BookContentRepository())->addAll($result['data']);
        $this->spiderLinkRepository->destroy($result['id']);
        unset($list);
        unset($result);
    }

    private function listRegFormat($list)
    {
        $data = array();
        $url = env('SPIDER_URL');
        $cline = new Client();
        $date = date('Y-m-d H:i:s');
        $id = array();

        foreach ($list as $key=>$value){
            $data[$key]['content'] = $this->getContent($cline,$url . $value->link,$value);
            $data[$key]['title'] = $value->title;
            $data[$key]['book_id'] = $value->book_id;
            $data[$key]['created_at'] = $date;
            $data[$key]['updated_at'] = $date;
            $id[] = $value->id;
        }
        return compact(['data','id']);
    }

    private function getContent($cline,$url,$data)
    {
        $content = $cline->get($url);
        if($content === false){
            $this->createError($data,$cline->error);
            return null;
        }

        $regContent = $this->regular->getContent($content);
        if($regContent === false){
            $this->createError($data,'内容为空');
            return null;
        }
        return htmlspecialchars($regContent);
    }

    private function createError($data,$error)
    {
        $this->spiderLinkErrorRepository->create([
            'title' => $data['title'],
            'link' => $data['link'],
            'book_id' => $data['book_id'],
            'error' => $error,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}