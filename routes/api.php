<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\SensorReadController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FarmAdmin\WorkerController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FarmGroupController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\SesnsorController;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/auth')->group(function () {

    // Registeration of user
    Route::post('/register', [AuthController::class, 'register']);

    // login of the user
    Route::post('/login', [AuthController::class, 'login']);

    // Logout of the user
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // forgot and reset passwords:
    Route::post('password/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('password/reset', [ResetPasswordController::class, 'passwordReset']);
});


// Sensor Readings Routes:
//
// 1. Store a single sensor reading
Route::post('/sensor-read/store', [SensorReadController::class, 'store']);
// 2. Display all readings of a specified sensor
Route::get('/sensor-read/{sensor_id}', [SensorReadController::class, 'index']);
Route::post('/sensors-read/read-sensor-data', [SensorReadController::class, 'readSensorDataById']);

// Sensor Route

// Route::apiResource('/sensors' , SensorController::class);

Route::post('/sensor-readings/read-sensor-data', [SensorReadController::class, 'readSensorDataById']);


/**
 *AdminUser Api routes disabled
 *Admin will work on dashboard
 */
// Route::prefix('admin')->middleware('auth:sanctum')->group(function () {

//     /// Tasks Managent

//     Route::prefix('tasks')->group(function () {
//         Route::get('/unassigned-tasks', [TaskController::class, 'unassignedTasks']);

//     });


//     ///  Workers Managment
//     Route::prefix('workers')->group(function () {
//         Route::post('', [WorkerController::class, 'store']);
//         Route::delete('/{userId}', [WorkerController::class, 'deactivateUser']); // Using DELETE for deactivation
//         Route::delete('/{userId}/force', [WorkerController::class, 'deleteUser']); // Force delete
//     });
// });

// change
// Farm routes
//  1. to store a farm

Route::apiResource('/farms', FarmController::class);



// FarmGroupRoutes:
Route::apiResource('/farm-groups', FarmGroupController::class);



Route::prefix('/tasks')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/update-status/{task}', [TaskController::class, 'updateStatus']);
    Route::post('/revisoin-request', [TaskController::class, 'sendRevisionRequest']);
});


Route::prefix('/sensors')->group(function () {
    // Rouget
    Route::get('/read-single-farm/{farm}', [SesnsorController::class, 'singleFarmReading'])->name('singleFarmReading');

    // Route::get('/tds/{farm}', [SesnsorController::class , 'tds'])->name('tds');
    // Route::get('/light/{farm}', [SesnsorController::class , 'light'])->name('light');
    // Route::get('/thumidityds/{farm}', [SesnsorController::class , 'humidity'])->name('humidity');
    // Route::get('/tds/{farm}', [SesnsorController::class , 'tds'])->name('tds');
    // Route::get('/tds/{farm}', [SesnsorController::class , 'tds'])->name('tds');
});


Route::post('/random', function (Request $request) {


    $geo =  json_decode($request->polygon)->geometry->coordinates[0];

    $boundary = new Collection();

    // foreach ($request->geo[0] as $key => $geo) {
    /**
     * when changed to then new @Component
     * will access geo directly
     */
    foreach ($geo as $key => $geo) {
        $pt =  new Point($geo[0], $geo[1]);
        // $pt = [$geo['lat'], $geo['lng']];
        $boundary->push($pt);
    }

    $x =   $boundary->push($boundary->first());

    $farm = Farm::create([
        'farm_group_id' => 3,
        'name' => 'name',
        'location' => 'location',
        'size' => 1,
        'crop_type' => 'crop_type',
        'description' => 'description',
        'area' => new Polygon([
            new LineString($boundary),
        ]),
    ]);
    return $farm;

    return $boundary;
    // return $request;
})->name('post-random');
