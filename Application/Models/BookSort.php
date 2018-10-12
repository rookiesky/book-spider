<?php
namespace Spider\Models;


class BookSort extends Model
{
    public $table = 'book_sort';

    public $timestamps = false;

    public $fillable = ['title','alias'];
}