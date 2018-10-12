<?php
namespace Spider\Repositories;

use Spider\Models\SpiderLinkError;

class SpiderLinkErrorRepository extends Repository
{
    public function __construct()
    {
        $this->model = new SpiderLinkError();
    }
}