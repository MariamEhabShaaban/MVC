
<?php
use Sectheater\Mvc\Http\Route;
use Sectheater\Mvc\Http\Response;
use Sectheater\Mvc\Http\Request;
require_once  __DIR__."/../src/Support/helpers.php";
require_once base_path()."vendor/autoload.php";
require_once base_path() ."routes/web.php";

$route = new Route(new Request,new Response);
$route->resolve();
