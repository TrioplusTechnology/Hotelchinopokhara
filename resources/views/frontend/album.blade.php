@extends('layouts.frontend.main')
@section('content')
<section class="pyaxis-56">
    <div class="container">
        <div class="row flex-center">
            <div class="col-md-10 col-lg-8">
                <h4>{{ $results->first()->gallery->title }}</h4>
                <div class="flex-center-between my-3">
                    <small class="text-primary">{{ $results->count() }} pictures</small><small>{{ date_format($results->first()->gallery->created_at,"d/m/Y") }}</small>
                </div>
                <div class="slider-for mb-4">
                    @foreach($results as $image)
                    <div class="img-landscape">
                        <img src="{{ asset('storage/'.$image->file_path) }}" alt="" />
                    </div>
                    @endforeach
                </div>
                <div class="slider-nav slide__spacer">
                    @foreach($results as $image)
                    <div class="item img-landscape">
                        <img src="{{ asset('storage/'.$image->file_path) }}" alt="" />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection