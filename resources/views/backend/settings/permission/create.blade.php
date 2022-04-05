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

      <form method="{{ $requestMethod }}" action="{{ $requestUrl }}">
        @csrf
        @if(isset($permission))
        <input type="hidden" name="_method" value="PUT">
        @endif
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="permission_name">{{ __('messages.permission_name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="permission_name" placeholder="{{ __('messages.permission_name') }}" value="{{ old('name', isset($permission) ? $permission->name : '' ) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="permission_code">{{ __('messages.permission_code') }}</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="permission_code" placeholder="{{ __('messages.permission_code') }}" value="{{ old('code', isset($permission) ? $permission->code : '' ) }}">
                @error('code')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="permission_status">{{ __('messages.permission_status') }}</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="permission_status">
                  <option value="1" {{ (old('status', (isset($permission) ? $permission->status : '')) == 1) ? 'selected' : '' }}>True</option>
                  <option value="0" {{ (old('status', (isset($permission) ? $permission->status : '')) == 1) ? 'selected' : '' }}>False</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="permission_description">{{ __('messages.permission_description') }}</label>
                <textarea name="description" class="form-control @error('name') is-invalid @enderror" id="permission_description" rows="3" placeholder="{{ __('messages.permission_description') }}">{{ old('code', isset($permission) ? $permission->code : '' ) }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <!-- /.form-group -->
          </div>
        </div>
        <!-- /.row -->
        <!-- /.card-body -->
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