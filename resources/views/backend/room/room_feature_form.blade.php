@extends('layouts.backend.main')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">{{ $heading }}</h3>
            </div>
            <!-- /.card-header -->

            <form action="{{ $requestUrl }}" name="customForm" id="customForm" method="POST">
                @csrf
                @if(isset($room))
                <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">{{ __('messages.title') }}</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('messages.title') }}" value="{{ old('title', isset($room) ? $room->title : '' ) }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slug">{{ __('messages.slug') }}</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('messages.slug') }}" value="{{ old('slug', isset($room) ? $room->slug : '') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">{{ __('messages.status') }}</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="1" {{ (old('status', (isset($room) ? $room->status : '')) == 1) ? 'selected' : '' }}>True</option>
                                    <option value="0" {{ (old('status', (isset($room) ? $room->status : '')) == 0) ? 'selected' : '' }}>False</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">{{ __('messages.description') }}</label>
                                <textarea name="description" class="form-control summernote" id="description" rows="3" placeholder="{{ __('messages.description') }}">{{ old('description', isset($room) ? $room->description : '' ) }}</textarea>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-success btn-flat">{{ $btnName }}</button>
                </div>
            </form>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection