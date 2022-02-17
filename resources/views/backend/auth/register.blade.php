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
      <form method="POST" action="{{ route('admin.user-management.user.store') }}">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="first_name">{{ __('messages.first_name') }}</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="{{ __('messages.first_name') }}" value="{{ old('first_name') }}">
                @error('first_name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="middle_name">{{ __('messages.middle_name') }}</label>
                <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="{{ __('messages.middle_name') }}" value="{{ old('middle_name') }}">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="last_name">{{ __('messages.last_name') }}</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="{{ __('messages.last_name') }}" value="{{ old('last_name') }}">
                @error('last_name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="email">{{ __('messages.email') }}</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ __('messages.email') }}" value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="phone">{{ __('messages.phone') }}</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="{{ __('messages.phone') }}" value="{{ old('phone') }}">
                @error('phone')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="password">{{ __('messages.password') }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{ __('messages.password') }}" value="{{ old('password') }}">
                @error('password')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="{{ __('messages.confirm_password') }}" value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="status">{{ __('messages.status') }}</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                  <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>True</option>
                  <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>False</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="role">{{ __('messages.role') }}</label>
                <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                  <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>True</option>
                  <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>False</option>
                </select>
                @error('role')
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
          <button type="submit" class="btn bg-gradient-primary btn-flat">Create</button>
        </div>
      </form>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection