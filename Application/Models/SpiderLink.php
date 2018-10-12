<?php
namespace Spider\Models;

class SpiderLink extends Model
{
    public $fillable = ['title','link','book_id','created_at'];

    public $timestamps = false;
}