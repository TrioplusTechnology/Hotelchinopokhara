@extends('layouts.backend.main')
@section('styles')
<style>
  img#previewImg {
    max-width: 300px;
    max-height: 300px;
  }
</style>
@endsection
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

      <form method="{{ $requestMethod }}" action="{{ $requestUrl }}" enctype="multipart/form-data">
        @csrf
        @if(isset($aboutUs))
        <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">{{ __('messages.title') }}</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="{{ __('messages.title') }}" value="{{ old('title', isset($aboutUs) ? $aboutUs->title : '' ) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="sub_title">{{ __('messages.sub_title') }}</label>
                <input type="text" name="sub_title" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" placeholder="{{ __('messages.sub_title') }}" value="{{ old('sub_title', isset($aboutUs) ? $aboutUs->sub_title : '') }}">
                @error('code')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="code">{{ __('messages.code') }}</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="{{ __('messages.code') }}" value="{{ old('code', isset($aboutUs) ? $aboutUs->code : '') }}">
                @error('code')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="status">{{ __('messages.status') }}</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="module_status">
                  <option value="1" {{ (old('status', (isset($aboutUs) ? $aboutUs->status : '')) == 1) ? 'selected' : '' }}>True</option>
                  <option value="0" {{ (old('status', (isset($aboutUs) ? $aboutUs->status : '')) == 0) ? 'selected' : '' }}>False</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="order">{{ __('messages.order') }}</label>
                <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" id="order" placeholder="{{ __('messages.order') }}" value="{{ old('order', isset($aboutUs) ? $aboutUs->order : '') }}">
                @error('order')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="description">{{ __('messages.description') }}</label>
                <textarea name="description" class="form-control summernote @error('description') is-invalid @enderror" id="description" rows="3" placeholder="{{ __('messages.description') }}">{{ old('description', isset($aboutUs) ? $aboutUs->description : '' ) }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="image">{{ __('messages.image') }}</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image">
                  <label class="custom-file-label" for="customFile" id="file_name">{{ isset($aboutUs) ? $aboutUs->image : "Choose file" }}</label>
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert" style="display: inline;">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="col-md-12">
              <img id="previewImg" src="{{ isset($aboutUs) ? asset('storage/'.$aboutUs->image) : '' }}" max-width="500px">
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

@section('scripts')

<script>
  $(document).ready(() => {
    $("#image").change(function() {
      const file = this.files[0];

      if (file) {
        let reader = new FileReader();
        reader.onload = function(event) {
          $("#previewImg")
            .attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
        $("#file_name").html("").html(file.name);
      }
    });
  });
</script>

@endsection