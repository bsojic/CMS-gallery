<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'c:' . DS . 'MAMP' . DS . 'htdocs' . DS . 'gallery' );
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
 
require_once __DIR__ . "/functions.php";
require_once __DIR__ . "/new_config.php";
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/db_object.php";
require_once __DIR__ . "/session.php";
require_once __DIR__ . "/photo.php";
require_once __DIR__ . "/comment.php";
require_once __DIR__ . "/user.php";
require_once __DIR__ . "/paginate.php";

 ?>