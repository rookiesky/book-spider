<?php
namespace Spider\Models;


class SpiderLinkError extends Model
{
    public $table = 'spider_link_error';

    public $fillable = ['title','link','book_id','error','created_at'];

    public $timestamps = false;
}