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
                    Need a place to host a seminar or a conference?
                </h1>
                <p class="mt-2 mb-4 hero-textbox">
                    If you are looking for a place to host a conference or a seminar
                    for you and your company, our event hall is the best place for
                    it
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row flex-center">
        <div class="col-lg-10">
            <section class="mbottom-56">
                <h4 class="mb-2">
                    {{ $results->title }}
                    <p class="mb-4">
                        <?php echo htmlspecialchars_decode($results->description); ?>
                    </p>
                    <div class="row align-center">
                        @foreach($results->images as $image)
                        <div class="col-md-6">
                            <div class="img-landscape mbottom-32">
                                <img src="{{ asset('storage/'.$image->file_path) }}" alt="" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </h4>
            </section>
        </div>
    </div>
</div>
@endsection