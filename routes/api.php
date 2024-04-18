<?php

use App\Http\Controllers\ClienteControler;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::post('/produtos', [ProdutoController::class, 'store']);
Route::get('/produtos/all', [ProdutoController::class, 'retornarTodos']);

Route::get('/clientes', [ClienteControler::class, 'indexCliente']);
Route::post('/clientes', [ClienteControler::class, 'storeCliente']);
Route::get('/clientes', [ClienteControler::class, 'retornarTodos']);

