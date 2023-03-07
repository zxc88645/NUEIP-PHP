<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*
 *
 * Route::resource（） 自動定義七個 RESTful 風格的路由，包括
 * 
 * GET /users - 顯示所有使用者的資源列表
 * GET /users/create - 顯示用於建立新使用者的表單
 * POST /users - 將用於建立新使用者的表單提交到資料庫
 * GET /users/{id} - 顯示特定使用者的詳細資訊
 * GET /users/{id}/edit - 顯示用於編輯特定使用者資訊的表單
 * PUT/PATCH /users/{id} - 更新特定使用者的資訊
 * DELETE /users/{id} - 刪除特定使用者的資訊
 * 
 * Verb          URI                    Action         Route Name
 * GET           /accountAPI            index          accountAPI.index
 * GET           /accountAPI/create     create         accountAPI.create
 * POST          /accountAPI            store          accountAPI.store
 * GET           /accountAPI/{id}       show           accountAPI.show
 * GET           /accountAPI/{id}/edit  edit           accountAPI.edit
 * PUT|PATCH    /accountAPI/{id}        update         accountAPI.update
 * DELETE       /accountAPI/{id}        destroy        accountAPI.destroy
 *
 */
Route::prefix('NUEIP')->group(function () {
    Route::resource('accountAPI', AccountController::class);
    Route::delete('/batchDestroy', [AccountController::class, 'batchDestroy'])->name('accountAPI.batchDestroy');
    //Route::put('/account/{id}', [AccountController::class, 'update'])->name('account.update');
    //Route::delete('/account/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
    //Route::post('/account/store', [AccountController::class, 'store'])->name('account.store');
});