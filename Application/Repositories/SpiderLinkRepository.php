<?php
namespace Spider\Repositories;

use Spider\Models\SpiderLink;

class SpiderLinkRepository extends Repository
{
    public function __construct()
    {
        $this->model = new SpiderLink();
    }

    public function limitGet($limit = 100, $order = 'id', $sort = 'asc')
    {
        return $this->model->orderBy($order,$sort)->limit($limit)->get();
    }

}