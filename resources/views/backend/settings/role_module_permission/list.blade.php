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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 700px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Role</th>
                            <th>Module</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mappingList as $key => $list)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $list->role_name }}</td>
                            <td>{{ $list->module_name }}</td>
                            <td>
                                @php
                                $permissions = json_decode($list->permissions);
                                @endphp

                                @foreach($permissions as $permission)
                                <span class="badge badge-success }}">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.setting.mapping.edit', ['roleId' => $list->role_id, 'moduleId' => $list->module_id]) }}" class="btn btn-sm btn-success btn-flat" data-toggle="tooltip" data-placement="top" title="{{ __('messages.edit') }}"><i class="fa fa-edit"></i></a>&nbsp;
                                <a href="{{ route('admin.setting.mapping.destroy', ['roleId' => $list->role_id, 'moduleId' => $list->module_id]) }}" class="btn btn-sm btn-danger btn-flat delete" data-toggle="tooltip" data-placement="top" data-title="{{ __('messages.confrim_title') }}" data-message="{{ __('messages.confirm_delete_message') }}" title="{{ __('messages.delete') }}""><i class=" fa fa-trash"></i></a>
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