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
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modules as $key => $module)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $module->name }}</td>
                            <td>{{ $module->description }}</td>
                            <td><span class="badge badge-{{ $module->status ? 'success' : 'warning' }}">{{ $module->status ? 'Active' : 'Inactive' }}</span></td>
                            <td>
                                <a href="{{ route('admin.setting.module.edit', ['id' => $module->id]) }}" class="btn btn-sm btn-success btn-flat" data-toggle="tooltip" data-placement="top" title="{{ __('messages.edit') }}"><i class="fa fa-edit"></i></a>&nbsp;
                                <a href="{{ route('admin.setting.module.destroy', ['id' => $module->id]) }}" class="btn btn-sm btn-danger btn-flat delete" data-toggle="tooltip" data-placement="top" data-title="{{ __('messages.confrim_title') }}" data-message="{{ __('messages.confirm_delete_message') }}" title="{{ __('messages.delete') }}""><i class=" fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection