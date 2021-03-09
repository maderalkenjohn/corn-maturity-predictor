<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('predictor/index');
});

Route::get('/list-corn-batch', [PredictorController::class, 'list_batch'])->name('testButton');

Route::resource('predictor', PredictorController::class);

Route::get('/list_batch', [PredictorController::class, 'list_batch']);
Route::get('/predictor_table', [PredictorController::class, 'list_crop_batch']);

Route::post('/predictor/insert_batch', [PredictorController::class, 'insert_batch']);
Route::post('/predictor/search', [PredictorController::class, 'search_batch']);
Route::post('/predictor/delete_crop', [PredictorController::class, 'delete_crop']);

Route::post('/predictor/save_crop', [PredictorController::class, 'save_crop'])->name('/predictor/save_crop');
Route::post('/predictor/edit_crop', [PredictorController::class, 'edit_crop']);

// Route::post('/materials/update', [StockController::class, 'update']);
// Route::get('/materials/+post_id+/edit', [StockController::class, 'edit']);

