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
                    Services to get you the perfect vacation home
                </h1>
                <p class="mt-2 mb-4 hero-textbox">
                    We ensure quality and efficiency in service delivery to our
                    customers/ clients, therefore the hotel has adopted latest
                    accomodations &amp; amenities
                </p>
            </div>
        </div>
    </div>
</div>
<section class="section-service mbottom-56 position-relative">
    <div class="container">
        <div class="row">
            @foreach($results as $service)
            <div class="col-lg-4 col-md-6 mbottom-32 media-detail">
                <div class="d-flex flex-column h-100">
                    <div class="img-landscape">
                        <img src="{{ asset('storage/'.$service->image) }}" alt="" />
                    </div>
                    <h6 class="clamp__1 mt-4">{{ $service->title }}</h6>
                    <p class="clamp__3 mt-3">
                        <?php echo htmlspecialchars_decode($service->description); ?>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection