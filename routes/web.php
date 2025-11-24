<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/form', function () {
//     return view('formpage');
// });
Route::get('/form', [SubmissionController::class, 'showForm']);
Route::post('/form', [SubmissionController::class, 'submitForm']);

