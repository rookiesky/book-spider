<?php
namespace Spider\Models;

class Book extends Model
{

	public $fillable = ['title','name','thumb','summary','sort_id','spider_id'];
}