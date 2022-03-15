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
                    The perfect home away from home
                </h1>
                <p class="mt-2 mb-4 hero-textbox">
                    Hotel Chino Pokhara puts you by the side of city’s top
                    attractions while serving as your sophisticated home away from
                    home
                </p>
            </div>
        </div>
    </div>
</div>

@foreach($results as $key => $result)
@php
$index = $key+1;
@endphp
<section class="mbottom-88">
    <div class="container">
        <div class="row align-center">
            @if($index%2 != 0)
            <div class="col-md-6 pr-md-5">
                <small class="text-gray-40 font-semibold mb-1">{{ $result->title }}</small>
                <h3 class="mb-2">{{ $result->sub_title }}</h3>
                <div class="textbox">
                    <?php echo htmlspecialchars_decode($result->description); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-portrait mt-4 mt-md-0">
                    <img src="{{ asset('storage/'.$result->image) }}" alt="" />
                </div>
            </div>
            @else
            <div class="col-md-6 order-2 order-md-1">
                <div class="img-portrait mt-4 mt-md-0">
                    <img src="assets/images/about-2.png" alt="" />
                </div>
            </div>
            <div class="col-md-6 pl-md-5 order-1 order-md-2">
                <small class="text-gray-40 font-semibold mb-1">{{ $result->title }}</small>
                <h3 class="mb-2">{{ $result->sub_title }}</h3>
                <div class="textbox">
                    <?php echo htmlspecialchars_decode($result->description); ?>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endforeach
<section class="ptop-64 pb-4 bg-primary-96 position-relative">
    <div class="svg-box right top">
        <img src="assets/images/horz-dots.svg" alt="" />
    </div>
    <div class="container">
        <h3 class="mbottom-40">Customer Testimonials</h3>
        <div class="row flex-center">
            <div class="col-lg-4 col-md-6 mbottom-40">
                <div class="card card__rounded h-100">
                    <p class="mb-5 flex-grow-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquet malesuada leo feugiat sed cras sodales tellus
                        pellentesque. Id lectus nulla vulputate nibh. Eget netus arcu
                    </p>
                    <h6 class="clamp__1 mb-1">Russel Peters</h6>
                    <div class="spacing__horizontal compact">
                        <i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mbottom-40">
                <div class="card card__rounded h-100">
                    <p class="mb-5 flex-grow-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquet malesuada leo feugiat sed cras sodales tellus
                        pellentesque. Id lectus nulla vulputate nibh. Eget netus arcu
                    </p>
                    <h6 class="clamp__1 mb-1">Sheldon Cooper</h6>
                    <div class="spacing__horizontal compact">
                        <i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mbottom-40">
                <div class="card card__rounded h-100">
                    <p class="mb-5 flex-grow-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquet malesuada leo feugiat sed cras sodales tellus
                        pellentesque. Id lectus nulla vulputate nibh. Eget netus arcu
                    </p>
                    <h6 class="clamp__1 mb-1">Matthew Moniz</h6>
                    <div class="spacing__horizontal compact">
                        <i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i><i class="ic-star h5 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection