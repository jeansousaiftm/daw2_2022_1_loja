<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('welcome');
});

Route::Resources([
	"cliente" => ClienteController::class,
	"produto" => ProdutoController::class
]);