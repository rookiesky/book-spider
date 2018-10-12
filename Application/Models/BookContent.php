<?php
namespace Spider\Models;


class BookContent extends Model
{
    public $fillable = ['title','content','created_at','updated_at','book_id'];

    public $timestamps = false;
}