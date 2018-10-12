<?php
namespace Spider\Repositories;

use Spider\Models\BookContent;

class BookContentRepository extends Repository
{
    public function __construct()
    {
        $this->model = new BookContent();
    }
}