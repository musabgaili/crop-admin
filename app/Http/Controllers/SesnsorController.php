<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;

class SesnsorController extends Controller
{

    function index()
    {
        $group = auth()->user()->adminFarmGroup;
        $data = [
            $group->tdsSensors()->with(['readings' => function ($q) {
                $q->whereDate('created_at', Carbon::today())->limit(10)->get();
            }])->get(),
            $group->lightSensors()->with(['readings' => function ($q) {
                $q->whereDate('created_at', Carbon::today())->limit(10)->get();
            }])->get(),
            $group->temepratureSensors()->with(['readings' => function ($q) {
                $q->whereDate('created_at', Carbon::today())->limit(10)->get();
            }])->get(),
            $group->moistureSensors()->with(['readings' => function ($q) {
                $q->whereDate('created_at', Carbon::today())->limit(10)->get();
            }])->get(),
            $group->humiditySensors()->with(['readings' => function ($q) {
                $q->whereDate('created_at', Carbon::today())->limit(10)->get();
            }])->get(),
        ];

        return response()->json($data, 200,);
    }
}
