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

//GET
Route::get('', [NoteController::class, 'index']);

//CREATED
Route::post('new', [NoteController::class, 'store']);

//DELETE NOTE (DELETE -> DESTROY)
Route::delete('{note}', [NoteController::class, 'destroy']);

//EDIT NOTE (PATCH?)
Route::put('update/{id}', [NoteController::class, 'update']);
