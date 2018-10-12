<?php
namespace Spider\Repositories;

use Spider\Models\SpiderBookError;

class SpiderBookErrorRepository
{
    public $model = null;

    public function __construct()
    {
        $this->model = new SpiderBookError();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }
}