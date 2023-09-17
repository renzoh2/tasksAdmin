<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication
route::post("/login",[AuthController::class, "loginAccount"]);
route::post("/logout",[AuthController::class, "logoutAccount"]);

//Tasks
route::get("/tasks",[TasksController::class,"index"]);
route::post("/tasks",[TasksController::class,"store"]);
route::get("/tasks/{id}",[TasksController::class,"show"]);
route::patch("/tasks/{id}",[TasksController::class,"update"]);
route::patch("/tasks/archive/{id}",[TasksController::class,"archive"]);
route::delete("/tasks/{id}",[TasksController::class,"destroy"]);