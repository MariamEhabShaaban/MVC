<?php
require_once "../src/Http/route.php";
require_once "../src/Http/response.php";
require_once "../src/Http/request.php";
require_once "../App/Controllers/HomeController.php";
use SecTheater\Http\Route;
use App\Controllers\HomeController;

 Route::get('/',[HomeController::class,'index']);
