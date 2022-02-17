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

      <form method="{{ $requestMethod }}" action="{{ $requestUrl }}">
        @csrf
        @if(isset($module))
        <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="module_name">{{ __('messages.module_name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="module_name" placeholder="{{ __('messages.module_name') }}" value="{{ old('name', isset($module) ? $module->name : '' ) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="module_code">{{ __('messages.module_code') }}</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="module_code" placeholder="{{ __('messages.module_code') }}" value="{{ old('code', isset($module) ? $module->code : '') }}">
                @error('code')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="module_status">{{ __('messages.module_status') }}</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="module_status">
                  <option value="1" {{ (old('status', (isset($module) ? $module->status : '')) == 1) ? 'selected' : '' }}>True</option>
                  <option value="0" {{ (old('status', (isset($module) ? $module->status : '')) == 0) ? 'selected' : '' }}>False</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="module_description">{{ __('messages.module_description') }}</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="module_description" rows="3" placeholder="{{ __('messages.module_description') }}">{{ old('description', isset($module) ? $module->description : '' ) }}</textarea>
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