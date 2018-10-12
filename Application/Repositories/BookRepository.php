<?php
namespace Spider\Repositories;

use Spider\Models\Book;

class BookRepository extends Repository
{
    public $model = null;

    public function __construct()
    {
        $this->model = new Book();
    }
}