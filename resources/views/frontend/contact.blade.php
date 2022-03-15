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
                    We are always here for your assistance
                </h1>
                <p class="mt-2 mb-4 hero-textbox">
                    Need any help or have any queriires regarding reservations, you
                    can contact us from the details below any time. We will get back
                    to you within 24 hours
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container mbottom-88">
    <div class="img-landscape-02 mb-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.298034784557!2d85.31982911506212!3d27.708082882791558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19c9a1f2227d%3A0xd91ba01e9014d1b!2sMuktinath%20Capital%20Limited!5e0!3m2!1sen!2snp!4v1642149001916!5m2!1sen!2snp" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="row">
        <div class="col-lg-7 col-md-6">
            <h3 class="text-primary mb-4">Send us a Message</h3>
            <form class="mb-4 mb-md-0" action="">
                <div class="form-row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">First Name</label><input class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Last Name</label><input class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Phone No.</label><input class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Email Address</label><input class="form-control" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Message</label><textarea class="form-control" id="exampleFormControlTextarea1" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-secondary">Submit</button>
            </form>
        </div>
        <div class="col-lg-4 col-md-6 offset-lg-1">
            <div class="card card-02 px-3 mb-4">
                <h5 class="text-primary mb-2">Location</h5>
                <p>Lakeside Road Devisthan Path Street No.16 'B', Pokhara</p>
            </div>
            <div class="card card-02 px-3 mb-4">
                <h5 class="text-primary mb-2">Contact Details</h5>
                <p class="mb-2">Email Address: info@pokharachino.com</p>
                <p>Phone No.: +977 985-6036619</p>
            </div>
            <div class="card card-02 px-3">
                <h5 class="text-primary mb-2">Social Media</h5>
                <div class="align-center spacing__horizontal">
                    <div class="icon-square">
                        <a class="ic-fb text-primary" href="#"></a>
                    </div>
                    <div class="icon-square">
                        <a class="ic-instagram text-primary" href="#"></a>
                    </div>
                    <div class="icon-square">
                        <a class="ic-twitter text-primary" href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection