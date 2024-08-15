@extends('layouts.dashboard')

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
    <section class="section">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="title mt-30 mb-30">
                        <h2>Cards</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card-style-1 mb-250">

                        <div class="card-content">
                            <div class="col-xl-12"></div>
                            <h4><a href="#0">{{ $farm->name }}</a></h4>
                            <p>
                                {{ $farm->description }}
                            </p>
                            <p>
                                {{ $farm->crop_type }}
                            </p>
                            <br>
                            <p>
                                {{ $farm->location }}
                            </p>
                            {{-- <a href="#0" class="main-btn primary-btn btn-hover">Read More</a> --}}
                        </div>
                    </div>
                    <!-- end card -->
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="card-style-5 mb-25">
                        <div class="card-content">
                            <p> TDS Sensors <span> {{ $farm->tdsSensors()->count() }} </span> </p>
                            <p> LIGHT Sensors <span> {{ $farm->lightSensors()->count() }} </span> </p>
                            <p> TEMPERATURE Sensors <span> {{ $farm->temepratureSensors()->count() }} </span> </p>
                            <p> Moisture Sensors <span> {{ $farm->moistureSensors()->count() }} </span> </p>
                            <p> Humidity Sensors <span> {{ $farm->humiditySensors()->count() }} </span> </p>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>



            <div class="row">
                {{-- <div class="col-xl-6 col-lg-6">
                    <div style="width: 80%; margin: auto; margin-top : 100px">
                        <canvas id="lightLineChart"></canvas>
                    </div>
                    <!-- end card -->
                </div> --}}
                <div class="col-xl-6 col-lg-6">
                    <div style="width: 80%; margin: auto; margin-top : 100px">
                        <canvas id="lightLineChart"></canvas>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div style="width: 80%; margin: auto; margin-top :100px">
                        <canvas id="temperatureLineChart"></canvas>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div style="width: 80%; margin: auto; margin-top :100px">
                        <canvas id="humidityLineChart"></canvas>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">

                    <div style="width: 80%; margin: auto; margin-top :100px">
                        <canvas id="tdsLineChart"></canvas>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div style="width: 80%; margin: auto; margin-top :100px">
                        <canvas id="soilMoistureLineChart"></canvas>
                    </div>
                </div>


            </div>




        </div>
    </section>


    <hr>

    {{-- light script --}}

    <script>
        var ctx = document.getElementById('lightLineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($lightReads['labels']),
                datasets: [{
                    label: 'Light Data',
                    data: @json($lightReads['data']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    {{-- temperature script --}}
    <script>
        var ctx = document.getElementById('temperatureLineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($temperatureReads['labels']),
                datasets: [{
                    label: 'Temperature Data',
                    data: @json($temperatureReads['data']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    {{-- humidity sensor script --}}
    <script>
        var ctx = document.getElementById('humidityLineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($humidityReads['labels']),
                datasets: [{
                    label: 'Humidity Data',
                    data: @json($humidityReads['data']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    {{-- tds sensor script --}}
    <script>
        var ctx = document.getElementById('tdsLineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($tdsReads['labels']),
                datasets: [{
                    label: 'tds Data',
                    data: @json($tdsReads['data']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    {{-- soil Moisture sensor script --}}
    <script>
        var ctx = document.getElementById('soilMoistureLineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($soilMoistureReads['labels']),
                datasets: [{
                    label: 'soil Moisture Data',
                    data: @json($soilMoistureReads['data']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
