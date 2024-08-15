<?php

use App\Http\Controllers\FarmWebController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesnsorController;
use App\Http\Controllers\TaskWebController;
use App\Http\Controllers\WorkerController;
use App\Models\Farm;
use App\Models\Sensor;
use App\Models\Sensors\SensorRead;
use App\Models\Sensors\Tds;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return Hash::make(12345678);
    return redirect()->route('home');

    $farm = Farm::where('area', '!=', null)->first();
    // return json_decode($farm)->area->coordinates;

    return view('farms.geofence', ['farm' => $farm]);

    return to_route('home');
    //
    return SensorRead::where('temperature_id', 259)->get();
    // $x =  new SensorRead(['read_value'=> 1,'temperature_id'=> 1 ]);
    // return $x->save();

    // return 's';
    for ($i = 0; $i < 100; $i++) {
        SensorRead::create([
            'read_value' => doubleval(1.1 + $i),
            'temperature_id' => rand(200, 280),
            'tds_id' => rand(200, 280),
            'humidity_id' => rand(200, 280),
            'soil_moisture_id' => rand(200, 280),
            'light_id' => rand(200, 280),
        ]);
    }

    return SensorRead::count();

    // return Tds::with('readings')->first();

    $f = Farm::first();
    return $f->lightSensors()->with(['readings' => function ($q) {
        $q->whereDate('created_at', Carbon::today())->limit(10)->get();
    }])->get();


    // return User::with('tasks')->get();

    return User::where('farm_group_id', auth()->user()->adminFarmGroup->id)
        ->pluck('id', 'name')
        ->toArray();


    // Assuming you have a 'orders' table with a 'created_at' column

    $lastWeekStart = Carbon::now()->startOfWeek()->subWeek();
    $lastWeekEnd = Carbon::now()->endOfWeek()->subWeek();

    $orders = User::query()
        ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
        ->get();

    // Group orders by day of week (0 = Sunday, 6 = Saturday)
    $ordersByDay = $orders->groupBy(function ($order) {
        return $order->created_at->dayOfWeek;
    });

    // Create an array with weekdays as keys and order data as values
    $weeklyData = [];
    foreach ($ordersByDay as $dayOfWeek => $orders) {
        $weekday = Carbon::createFromFormat('Y-m-d', now()->subDays(6 - $dayOfWeek)->format('Y-m-d'))->format('l');
        $weeklyData[$weekday] = $orders;
    }

    // dd($weeklyData);

    return $weeklyData;
    // $sensor = Sensor::findOrFail(1);

    // return $sensor->sensorReads()->latest()->limit(5)->get();

    // return view('welcome');



    // return User::first()->dueTodayTasks();
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/workers', WorkerController::class)->middleware('auth');

Route::resource('/farms', FarmWebController::class)->middleware('auth');

Route::resource('/tasks', TaskWebController::class)->middleware('auth');
Route::get('/workers/create-task', function (Worker $worker) {
    return view('workers.create_task', ['worker' => $worker]);
})->name('workers.create_task');


Route::resource('/sensors', SesnsorController::class);

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::post('/update-info', [ProfileController::class, 'updateInfo'])->name('settings.account_update');
Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('settings.account_update_password');
