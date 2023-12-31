<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StaffController;
use App\Models\Form;
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

Route::get('/dashboard/chart', [StaffController::class, 'getChart']);
Route::get('get-forms/{section_id}', [StaffController::class, 'getFormsBySection']);
Route::post('/forms/getbysection', function (Request $request) {
    return response(Form::where("section_id", $request->section_id)->get(), 200);
});

Route::post('/flw-webhook', [InvoiceController::class,'webhook']);
