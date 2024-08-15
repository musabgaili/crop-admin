@extends('layouts.dashboard');


@section('content')
    <section class="tab-components">
        <div class="container-fluid">

            <div class="form-elements-wrapper">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- input style start -->
                        <div class="card-style mb-30">
                            <h6 class="mb-25">{{ __('Create Farm') }}</h6>

                            <!-- end input -->
                            <form style="" action="{{ route('farms.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="input-style-2">
                                    <input type="text" placeholder="{{ __('Name') }}" required name="name" />
                                </div>
                                <!-- end input -->
                                <div class="input-style-1">
                                    <input type="text" placeholder="{{ __('Location') }}" required name="location"
                                        type="text" />
                                    @error('location')
                                        <div class=" text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- end input -->

                                <div class="input-style-1">
                                    <input type="text" placeholder="{{ __('Size') }}" required name="size"
                                        type="size" />
                                    @error('size')
                                        <div class=" text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="input-style-1">
                                    <input type="text" placeholder="{{ __('Crop Type') }}" required name="crop_type"
                                        type="crop Type" />
                                    @error('crop Type')
                                        <div class=" text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="input-style-1">
                                    <label>{{ __('Description') }}</label>
                                    <textarea placeholder="Message" rows="5" name="description"></textarea>
                                </div>
                                <div class=" d-flex justify-content-center align-items-center mt-5">

                                    <button type="submit" class="btn btn-primary">{{__("save")}}</button>
                                </div>
                            </form>

                        </div>
                        <!-- end card -->
                        <!-- ======= input style end ======= -->

                        <!-- ======= input switch style end ======= -->
                    </div>

                </div>
                <!-- end row -->
            </div>

        </div>
    </section>
@endsection
