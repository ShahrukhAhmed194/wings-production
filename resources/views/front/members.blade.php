@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Members - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>

@endsection

@section('master')

<div class="page_wrap">
    <div class="container table-responsive border">
        <h5 class="text-center">Member List</h5>
        <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>SL</th>
                <th>Membership ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Member Type</th>
                <th>Session</th>
                <th>Blood Group</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>

            <tbody>
            {{--@foreach ($members as $key => $member)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$member->member_id_string}}</td>
                    <td>
                        <p class="mb-0">{{$member->full_name}}</p>
                    </td>
                    <td>
                        <p class="mb-0">{{$member->email}}</p>
                    </td>
                    <td>{{$member->academic_session}}</td>
                    <td>{{$member->blood_group}}</td>
                    <td class="text-right">
                        @auth
                            <a href="{{route('memberDetails', $member->id)}}" class="btn btn-sm btn-success">View Details</a>
                        @endauth
                    </td>
                </tr>
            @endforeach--}}
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('footer')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{route('members.table')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "sl_desc"},
                    {"data": "member_id_string"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "type"},
                    {"data": "academic_session"},
                    {"data": "blood_group"},
                    {"data": "action"},
                ],
                "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
                order: [[0, "asc"]],
                "columnDefs": [
                    { orderable: true, className: 'reorder', targets: [0] },
                    { orderable: false, targets: '_all' }
                ]
            });
        });
    </script>
@endsection

