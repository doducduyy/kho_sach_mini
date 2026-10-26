<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('books.index');
Route::post('/books', [App\Http\Controllers\BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}/edit', [App\Http\Controllers\BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [App\Http\Controllers\BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [App\Http\Controllers\BookController::class, 'destroy'])->name('books.destroy');
