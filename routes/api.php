<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\InstitutionStructureController;
use App\Http\Controllers\InstitutionGalleryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\MessageController;

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

// Public can Access
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Only Authenticated User can Access
Route::middleware(['auth:api'])->group(function () {
    Route::get('top-activity', [ActivityController::class, 'getTopActivity']);
    Route::resource('activity', ActivityController::class);
    Route::get('top-achievement', [AchievementController::class, 'getTopAchievement']);
    Route::resource('achievement', AchievementController::class);
    Route::resource('video', VideoController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('news', NewsController::class);
    Route::resource('message', MessageController::class);
    Route::resource('complaint', ComplaintController::class);
    Route::post('import-citizen', [CitizenController::class, 'import']);
    Route::get('citizen-statistic', [CitizenController::class, 'countCitizen']);
    Route::resource('citizen', CitizenController::class);
    Route::resource('vision', VisionController::class);
    Route::resource('mission', MissionController::class);
    Route::resource('history', HistoryController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('organization', OrganizationController::class);
    Route::resource('institution', InstitutionController::class);
    Route::resource('institution-structure', InstitutionStructureController::class);
    Route::resource('institution-gallery', InstitutionGalleryController::class);
});