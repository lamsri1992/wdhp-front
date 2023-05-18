<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('history', 'api\v_history');
Route::apiResource('ccpi', 'api\v_ccpi');
Route::apiResource('diag', 'api\v_diag');
Route::apiResource('drug', 'api\v_drug');
Route::apiResource('lab', 'api\v_lab');
Route::apiResource('hpi', 'api\v_hpi');
Route::apiResource('pe', 'api\v_pe');