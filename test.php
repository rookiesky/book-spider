<?php


$content = file_get_contents('https://www.zwdu.com/book/30241/');

$title_pattern = '/<meta property="og:novel:book_name" content="(.*?)"/';

$name_pattern = '/<meta property="og:novel:author" content="(.*?)"/';

$type_pattern = '/<meta property="og:novel:category" content="(.*?)"/';

$des_pattern = '/<meta property="og:description" content="(.*?)"/';

$thumb_pattern = '/<meta property="og:image" content="(.*?)"/';

$content_pattern = '/<dd><a href="(.*?)">(.*?)<\/a><\/dd>/';

preg_match_all($content_pattern,$content,$name,PREG_SET_ORDER);

var_dump($name);
