@extends('layouts.backend.main')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">{{ $subHeading }}</h3>
      </div>

      <form method="{{ $requestMethod }}" action="{{ $requestUrl }}">
        @csrf
        @if(isset($role))
        <input type="hidden" name="_method" value="PUT">
        @endif
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="role_name">{{ __('messages.role_name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="role_name" placeholder="{{ __('messages.role_name') }}" value="{{ old('name', isset($role) ? $role->name : '' ) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="role_code">{{ __('messages.role_code') }}</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="role_code" placeholder="{{ __('messages.role_code') }}" value="{{ old('code', isset($role) ? $role->code : '' ) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="role_status">{{ __('messages.role_status') }}</label>
                <select name="status" class="form-control" id="role_status">
                  <option value="1" {{ (old('status', (isset($role) ? $role->status : '')) == 1) ? 'selected' : '' }}>True</option>
                  <option value="0" {{ (old('status', (isset($role) ? $role->status : '')) == 0) ? 'selected' : '' }}>False</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="role_description">{{ __('messages.role_description') }}</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="role_description" rows="3" placeholder="{{ __('messages.role_description') }}">{{ old('code', isset($role) ? $role->code : '' ) }}</textarea>
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
        <div class="card-footer">
          <button type="submit" class="btn bg-gradient-success btn-flat">{{ $btnName }}</button>
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection