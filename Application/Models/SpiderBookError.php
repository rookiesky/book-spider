<?php
namespace Spider\Models;


class SpiderBookError extends Model
{
    public $table = 'spider_book_error';

    public $timestamps = false;

    public $fillable = ['link','error','created_at'];
}