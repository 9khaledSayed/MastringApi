<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\AuthorTicketsController;
use App\Http\Controllers\Api\V1\TicketController;


Route::apiResource('authors', AuthorController::class);
Route::apiResource('tickets', TicketController::class)->except('update');
Route::apiResource('authors.tickets', AuthorTicketsController::class);

Route::put('tickets/{ticket}', [TicketController::class, 'replace'])->name('tickets.replace');
Route::patch('tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
