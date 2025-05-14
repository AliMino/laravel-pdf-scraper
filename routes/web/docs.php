<?php

use Illuminate\Support\Facades\Route;

Route::get('docs', fn () =>view('docs.swagger'))->name('swagger-document');
