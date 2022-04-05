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
            <div class="card-body table-responsive p-0" style="height: 700px;">
                @if($lists->isEmpty())
                <div class="jumbotron">
                    <h1 class="display-4 text-center">No any data available.</h1>
                </div>
                @else
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            @foreach($keys as $key => $data)
                            @if(!in_array($data, ['id', 'created_by', 'updated_by']))
                            <th>{{ ucfirst($data) }}</th>
                            @endif
                            @endforeach
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lists as $key => $list)
                        <tr>
                            <td>{{ ++$key }}</td>
                            @foreach($list->toArray() as $key1 => $value)
                            @if(!in_array($key1, ['id', 'created_by', 'updated_by']))
                            @if($key1 === 'status')
                            <td><span class="badge badge-{{ $value ? 'success' : 'warning' }}">{{ $value ? 'Active' : 'Inactive' }}</span></td>
                            @elseif($key1 === 'image')
                            <td><img src="{{ asset('storage/'.$value) }}" style="max-width:80px; max-height:80px;"></td>
                            @elseif($key1 === 'description')
                            <td>
                                {{ substr_replace($value, "....", 40) }}
                            </td>
                            @else
                            <td>{{ $value }}</td>
                            @endif
                            @endif
                            @endforeach
                            <td>
                                <a href="{{ route($editUrl, ['id' => $list->id]) }}" class="btn btn-sm btn-success btn-flat" data-toggle="tooltip" data-placement="top" title="{{ __('messages.edit') }}"><i class="fa fa-edit"></i></a>&nbsp;
                                <a href="{{ route($deleteUrl, ['id' => $list->id]) }}" class="btn btn-sm btn-danger btn-flat delete" data-toggle="tooltip" data-placement="top" data-title="{{ __('messages.confrim_title') }}" data-message="{{ __('messages.confirm_delete_message') }}" title="{{ __('messages.delete') }}""><i class=" fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection