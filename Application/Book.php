<?php
namespace Spider;

use Spider\Regular\Run;
use Spider\Repositories\BookRepository;
use Spider\Repositories\BookSortRepository;
use Spider\Repositories\SpiderBookErrorRepository;
use Spider\Repositories\SpiderLinkRepository;
use Spider\Upload\Upload;


class Book
{
    static protected $url = '';
    static protected $book_id = 7552;
    protected $bookRepository = null;
    const THUMB_PREFIX = 'zwdu';

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
        self::$url = env('SPIDER_URL') . '/book/';
    }

    public function boot()
    {
        $book = $this->bookRepository->first();
        if($book){
            self::$book_id = $book->spider_id + 1;
        }

        $data = $this->getBook(self::$url . self::$book_id . '/');

        if(empty($data)){
            return false;
        }

        $result = $this->bookRepository->create([
            'title' => $data['title'],
            'name' => $data['name'],
            'thumb' => $data['thumb'],
            'summary' => $data['des'],
            'sort_id' => $this->sort($data['column']),
            'spider_id' => self::$book_id
        ]);

        if(!$result){
            $this->upload()->delete($data['thumb']);
            return false;
        }

        $linkResult = $this->createSpiderList($data['list'],$result->id);

        if(!$linkResult){
            $this->bookRepository->destroy($result->id);
            return false;
        }
        return true;
    }

    private function createSpiderList($list, $bookId)
    {
        $data = array();
        $date = date('Y-m-d H:i:s');
        foreach ($list as $key=>$value){
            $data[$key]['title'] = $value['title'];
            $data[$key]['link'] = $value['link'];
            $data[$key]['book_id'] = $bookId;
            $data[$key]['created_at'] = $date;
        }
        $spiderLinkRepository = new SpiderLinkRepository();
        return $spiderLinkRepository->addAll($data);
    }

    private function sort($title)
    {
        $bookSortRepository = new BookSortRepository();
        $sort = $bookSortRepository->first(['title'=>$title]);
        if(empty($sort)){
            $retsult = $bookSortRepository->create([
                'title' => $title
            ]);
            return $retsult->id;
        }
        return $sort->id;
    }

    private function getBook(string $url)
    {
         $client = new Client();
         $result = $client->get($url);
         if($result == false){
                $this->createError($url,$client->error);
               self::$book_id++;
               return $this->getBook(self::$url . self::$book_id . '/');
         }

         $content = $this->reg($result);

         if($content == false){
             $this->createError($url,'采集内容为空！');
             self::$book_id++;
             return $this->getBook(self::$url . self::$book_id . '/');
         }
        $filename = explode('/',$content['thumb']);
        $content['thumb'] = $this->upload()->put(
             $client->get($content['thumb']),
             self::THUMB_PREFIX . '/' .end($filename)
         );
        return $content;
    }

    private function upload()
    {
        return new Upload();
    }

    private function createError($url,$error)
    {
        $spiderBookErrorRepository = new SpiderBookErrorRepository();
        $spiderBookErrorRepository->create([
            'link' => $url,
            'error' => $error,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    private function reg($content)
    {
        $regular = new Run($content);
        return $regular->boot();
    }

}