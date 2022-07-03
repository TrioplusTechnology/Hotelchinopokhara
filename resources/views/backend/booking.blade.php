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
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Check In Date</th>
                            <th>Check Out Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lists as $key => $list)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $list->first_name }}</td>
                            <td>{{ $list->last_name }}</td>
                            <td>{{ $list->phone }}</td>
                            <td>{{ $list->check_in_date }}</td>
                            <td>{{ $list->check_out_date }}</td>
                            <td>
                                @if($list->status === "booked")
                                <span class="badge badge-warning">Pending</span>
                                @elseif($list->status === "confirmed")
                                <span class="badge badge-success">Confirmed</span>
                                @elseif($list->status === "cancelled")
                                <span class="badge badge-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                @if($list->status === "booked")
                                <a href="" class="btn btn-sm btn-success btn-flat" data-toggle="tooltip" data-placement="top" title="{{ __('messages.edit') }}"><i class="fa fa-edit"></i></a>
                                @endif
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