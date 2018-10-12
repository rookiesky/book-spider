<?php
namespace Spider\Repositories;

use Spider\Models\BookSort;

class BookSortRepository extends Repository
{

    public function __construct()
    {
        $this->model = new BookSort();
    }

}