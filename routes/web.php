<?php

use App\Models\Stock;
use App\Models\StockIn;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
