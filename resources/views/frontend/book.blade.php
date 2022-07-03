@extends('layouts.frontend.main')
@section('styles')
<style>
    span.invalid-feedback {
        display: inline;
    }
</style>
@endsection

@section('content')
<div class="container mbottom-88 mtop-56">
    <div class="row">
        @if(session()->has('success'))
        <div class="col-lg-12">
            <div class="alert alert-success border border-success">
                <small class="text-success">{{session()->get('success')}}</small>
            </div>
        </div>
        @endif
        @if(session()->has('error'))
        <div class="col-lg-12">
            <div class="alert alert-danger border border-danger">
                <small class="text-danger">{{session()->get('error')}}</small>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-7 col-md-6">
            <h3 class="text-primary mb-4">Book a Room</h3>
            <form action="{{ url('/book') }}" class="mb-4 mb-md-0" name="customForm" id="customForm" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="" class="@error('room_type_id') text-danger @enderror">Room Type</label>
                            <select class="custom-select" id="room_type_id" name="room_type_id">
                                <option selected="">Choose...</option>
                                @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_type_id') == $room->id ? "selected": "" }}>{{ $room->title }}</option>
                                @endforeach
                            </select>
                            @error('room_type_id')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="@error('check_in_date') text-danger @enderror">Check-In Date</label>
                            <input class="form-control" type="date" name="check_in_date" value="{{ old('check_in_date') }}" />
                            @error('check_in_date')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="@error('check_out_date') text-danger @enderror">Check-Out Date</label>
                            <input class="form-control" type="date" name="check_out_date" value="{{ old('check_out_date') }}" />
                            @error('check_out_date')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="@error('first_name') text-danger @enderror">First Name</label>
                            <input class="form-control" name="first_name" value="{{ old('first_name') }}" />
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="@error('last_name') text-danger @enderror">Last Name</label>
                            <input class="form-control" name="last_name" value="{{ old('last_name') }}" />
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="@error('phone') text-danger @enderror">Phone No.</label>
                            <input class="form-control" name="phone" value="{{ old('phone') }}" />
                            @error('phone')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="@error('email') text-danger @enderror">Email Address</label>
                            <input class="form-control" name="email" value="{{ old('email') }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex-end">
                    <button class="btn btn-secondary">Book Now</button>
                </div>
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