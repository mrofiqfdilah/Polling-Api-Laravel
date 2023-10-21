<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PollsController;
use App\Http\Controllers\API\VotesController;
use App\Http\Controllers\PaslonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('paslon',PaslonController::class);

Route::post('api/auth/login', [AuthController::class, 'login']);
Route::post('api/auth/logout', [AuthController::class, 'logout']);
Route::post('api/auth/register', [AuthController::class, 'register']);
Route::post('api/auth/logout', [AuthController::class, 'logout']);
Route::post('api/auth/me', [AuthController::class, 'me']);

Route::post('api/poll/create', [PollsController::class, 'index']);
Route::post('api/poll/get', [PollsController::class, 'allpoll']);
Route::post('api/poll/apoll', [PollsController::class, 'getapoll']);

Route::post('api/vote', [VotesController::class, 'vote']);
Route::get('api/vote/all', [VotesController::class, 'all']);

Route::get('halamanadmin', [AuthController::class, 'halamanadmin']);
Route::get('halamanuser', [AuthController::class, 'halamanuser']);


Route::match(['post','get'],'daftarakun', [AuthController::class, 'daftarakun']);

Route::match(['post','get'],'loginakun', [AuthController::class, 'loginakun']);
