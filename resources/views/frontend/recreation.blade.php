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
                    Recreational actvities to drain your stress
                </h1>
                <p class="mt-2 mb-4 hero-textbox">
                    Indulge in the recreational activities at our hotel to sweep
                    away your stress, be fresh and enjoy the perfect hotel
                    experience
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row flex-center">
        <div class="col-lg-10">
            @foreach($results as $key => $recreation)
            @php
            $index = $key+1;
            @endphp
            <section class="mbottom-88">
                <div class="row align-center">
                    @if ($index%2 != 0)
                    <div class="col-md-6 order-2 order-md-1">
                        <div class="img-landscape mt-4 mt-md-0">
                            <img src="{{ asset('storage/'.$recreation->image) }}" alt="" />
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-5 order-1 order-md-2">
                        <h4 class="mb-2">{{ $recreation->title }}</h4>
                        <div class="textbox">
                            <p>
                                <?php echo htmlspecialchars_decode($recreation->description); ?>
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="col-md-6 pr-md-5">
                        <h4 class="mb-2">{{ $recreation->title }}</h4>
                        <div class="textbox">
                            <p>
                                <?php echo htmlspecialchars_decode($recreation->description); ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="img-landscape mt-4 mt-md-0">
                            <img src="{{ asset('storage/'.$recreation->image) }}" alt="" />
                        </div>
                    </div>
                    @endif
                </div>
            </section>
            @endforeach
        </div>
    </div>
</div>
@endsection