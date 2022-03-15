@extends('layouts.frontend.main')

@section('content')
<div class="section-hero-inner text-center position-relative pyaxis-80 bg-primary-96 mbottom-88">
    <div class="svg-box left">
        <img src="assets/images/hero-left.svg" alt="" />
    </div>
    <div class="svg-box right">
        <img src="assets/images/hero-right.svg" alt="" />
    </div>
    <div class="container">
        <div class="row flex-center">
            <div class="col-md-8">
                <h1 class="text-primary hero-textbox">
                    Few glimpses of our hotel &amp; services
                </h1>
                <p class="mt-2 mb-4 hero-textbox">
                    Hotel Chino Pokhara aims to be a partner in hospitality &amp;
                    accomodation for every tourist/traveller by providing different
                    schemes, best rates, best amenities from the very best
                </p>
            </div>
        </div>
    </div>
</div>
<section class="mbottom-56">
    <div class="container">
        <div class="row">
            @foreach($results as $gallery)
            <div class="col-lg-4 col-md-6 mbottom-32 media-detail">
                <a class="d-flex flex-column h-100" href="{{ url('/gallery/album/'.$gallery->id) }}">
                    <div class="img-landscape">
                        <img src="{{ asset('storage/'.$gallery->images->first()->file_path) }}" alt="" />
                    </div>
                    <div class="mt-3 d-flex flex-column flex-grow-1">
                        <h6 class="clamp__2 flex-grow-1">
                            {{ $gallery->title }}
                        </h6>
                        <div class="flex-center-between mt-3">
                            <small class="text-primary">{{ $gallery->images->count() }} pictures</small><small>{{ date_format($gallery->created_at,"d/m/Y") }}</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection