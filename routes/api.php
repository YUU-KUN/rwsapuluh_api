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

// Activity
Route::get('top-activity', [ActivityController::class, 'getTopActivity']);
Route::get('activity', [ActivityController::class, 'index']);
Route::get('activity/{id}', [ActivityController::class, 'show']);
Route::get('top-achievement', [AchievementController::class, 'getTopAchievement']);
Route::get('citizen-statistic', [CitizenController::class, 'countCitizen']);

// Achievement
Route::resource('achievement', AchievementController::class);

// Video
Route::resource('video', VideoController::class);

// Category
Route::resource('category', CategoryController::class);

// Service
Route::resource('service', ServiceController::class);

// Message
Route::resource('message', MessageController::class);

// Complaint
Route::resource('complaint', ComplaintController::class);

// Citizen
Route::resource('citizen', CitizenController::class);

// Vision
Route::resource('vision', VisionController::class);

// Mission
Route::resource('mission', MissionController::class);

// History
Route::resource('history', HistoryController::class);

// Contact
Route::resource('contact', ContactController::class);

// Organization
Route::resource('organization', OrganizationController::class);

// Institution
Route::resource('institution', InstitutionController::class);

// Institution Structure
Route::resource('institution-structure', InstitutionStructureController::class);

// Insittution Gallery
Route::resource('institution-gallery', InstitutionGalleryController::class);

// Only Authenticated User can Access
Route::middleware(['auth:api'])->group(function () {
    Route::resource('activity', ActivityController::class)->except(['index', 'show']);
    Route::resource('achievement', AchievementController::class)->except(['index', 'show']);
    Route::resource('video', VideoController::class)->except(['index', 'show']);
    Route::resource('category', CategoryController::class)->except(['index', 'show']);
    Route::resource('service', ServiceController::class)->except(['index', 'show']);
    Route::resource('message', MessageController::class)->except(['index', 'show']);
    Route::resource('complaint', ComplaintController::class)->except(['index', 'show']);
    Route::post('import-citizen', [CitizenController::class, 'import']);
    Route::resource('citizen', CitizenController::class)->except(['index', 'show']);
    Route::resource('vision', VisionController::class)->except(['index', 'show']);
    Route::resource('mission', MissionController::class)->except(['index', 'show']);
    Route::resource('history', HistoryController::class)->except(['index', 'show']);
    Route::resource('contact', ContactController::class)->except(['index', 'show']);
    Route::resource('organization', OrganizationController::class)->except(['index', 'show']);
    Route::resource('institution', InstitutionController::class)->except(['index', 'show']);
    Route::resource('institution-structure', InstitutionStructureController::class)->except(['index', 'show']);
    Route::resource('institution-gallery', InstitutionGalleryController::class)->except(['index', 'show']);
});