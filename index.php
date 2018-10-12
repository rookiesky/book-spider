<?php
require('vendor/autoload.php');

define("DEBUG",true);

if(DEBUG){
	$whoolsHandler = new Whoops\Handler\PrettyPageHandler();
	$whoolsHandler->setPageTitle('页面出错啦！');
	$whools = new Whoops\Run();
	$whools->pushHandler($whoolsHandler);
	$whools->register();
}else{
	ini_set('display_errors','off');
}

require('function/function.php');

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require('plugin/Eloquent.php');

if(!isset($_GET['type'])){
    return false;
}

if($_GET['type'] == 'books'){
    $book = new \Spider\Book();
    $book->boot();
}elseif($_GET['type'] == 'books-content'){
    $list = new \Spider\Content();
    $list->boot();
}







