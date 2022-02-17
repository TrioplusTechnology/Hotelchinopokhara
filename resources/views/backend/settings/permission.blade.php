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
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="permission_name">{{ __('messages.permission_name') }}</label>
              <input type="text" name="name" class="form-control" id="permission_name" placeholder="{{ __('messages.permission_name') }}">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="permission_code">{{ __('messages.permission_code') }}</label>
              <input type="text" name="code" class="form-control" id="permission_code" placeholder="{{ __('messages.permission_code') }}">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="permission_status">{{ __('messages.permission_status') }}</label>
              <select name="status" class="form-control" id="permission_status">
                <option value="1">True</option>
                <option value="0">False</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="permission_description">{{ __('messages.permission_description') }}</label>
              <textarea name="description" class="form-control" id="permission_description" rows="3" placeholder="{{ __('messages.permission_description') }}"></textarea>
            </div>
          </div>
          <!-- /.form-group -->
        </div>
      </div>
      <!-- /.row -->
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="button" class="btn bg-gradient-primary btn-flat">Create</button>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection