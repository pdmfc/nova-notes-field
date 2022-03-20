<?php

use Illuminate\Support\Facades\Route;
use PDMFC\NovaNotesField\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('', [NoteController::class, 'index']);
Route::post('new', [NoteController::class, 'store']);

//DELETE


//EDIT