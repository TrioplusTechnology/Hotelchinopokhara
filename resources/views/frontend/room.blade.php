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
                    Rooms that meet your needs &amp; expectations
                </h1>
                <p class="mt-2 mb-4 hero-textbox">
                    Hotel Chino Pokhara rooms are equipped with air conditioning, a
                    flat-screen TV with satellite channels, an electric tea pot, a
                    shower, slippers and a desk
                </p>
            </div>
        </div>
    </div>
</div>
<section class="mbottom-56">
    <div class="container">
        <div class="row flex-center">
            <div class="col-md-10">
                @foreach($results as $key => $result)
                <div class="card card-02 mbottom-32">
                    <div class="row align-center">
                        <div class="col-lg-5 col-md-6 order-2 order-md-1">
                            <div class="img-portrait mt-4 mt-md-0">
                                <img src="{{ asset('storage/'.$result->images->first()->file_path) }}" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 order-1 order-md-2 pr-md-5">
                            <h3 class="mb-2">{{ $result->title }}</h3>
                            <div class="textbox">
                                <?php echo htmlspecialchars_decode($result->description); ?>
                                <ul>
                                    @foreach($result->features as $feature)
                                    <li>{{ $feature->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection