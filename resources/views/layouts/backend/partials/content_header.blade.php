<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ $heading }}</h1>
      </div><!-- /.col -->
      @if(isset($addUrl))
      <div class="col-sm-6">
        <div class="float-sm-right">
          <a href="{{ $addUrl }}" class="btn btn-sm bg-gradient-success btn-flat">{{ __('messages.add') }}</a>
        </div>
      </div><!-- /.col -->
      @endif

      @if(isset($backUrl))
      <div class="col-sm-6">
        <div class="float-sm-right">
          <a href="{{ $backUrl }}" class="btn btn-sm bg-gradient-primary btn-flat">{{ __('messages.back') }}</a>
        </div>
      </div><!-- /.col -->
      @endif
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>