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
                @if(isset($mapping))
                <input type="hidden" name="_method" value="PUT">
                @endif
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">{{ __('messages.role_name') }}</label>
                                <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ (old('role', (isset($mapping) ? $mapping->role : '')) == 1) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="module">{{ __('messages.module_name') }}</label>
                                <select name="module" class="form-control @error('module') is-invalid @enderror" id="module">
                                    @foreach($modules as $module)
                                    <option value="{{ $module->id }}" {{ (old('module', (isset($mapping) ? $mapping->module : '')) == 1) ? 'selected' : '' }}>{{ $module->name }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group clearfix">
                                <label class="label-block" for="module_description">{{ __('messages.permission') }}</label>
                                <div id="permission_list"></div>
                            </div>
                        </div>
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
    $(document).ready(function() {
        $(document).off('change', '#module').on('change', '#module', function(e) {
            e.preventDefault();
            const url = "{{ route('admin.setting.mapping.get-permission-by-module') }}";
            const module = $(this).val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    module
                },
                beforeSend: function() {
                    $("#permission_list").html("");
                },

                success: function(resp) {
                    if (resp.status === 'success') {
                        $("#permission_list").html(resp.data)
                    }
                }
            })
        })
    })
</script>
@endsection