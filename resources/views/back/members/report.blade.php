@extends('back.layouts.master')
@section('title', 'Member Report')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <form action="{{route('back.members.report')}}" method="GET">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>ID Range</label>

                        <input type="text" value="{{request('id_range')}}" name="id_range" class="form-control form-control-sm" placeholder="ID range(1-2)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Status</label>

                        <select name="status" class="form-control form-control-sm">
                            <option value="">All</option>
                            <option value="approved" {{request('status') ? 'selected' : ''}}>Approved</option>
                            <option value="pending">Pending</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>City</label>

                        <input type="text" value="{{request('city')}}" name="city" class="form-control form-control-sm" placeholder="City">
                    </div>
                </div>

                <div class="col-md-4">
                    <label>Action</label>
                    <br>
                    <button name="action" value="view" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</button>
                    <button name="action" value="pdf" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                    <button name="action" value="excel" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> Excel</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th scope="col" style="width: 70px">#</th>
                <th scope="col">Name </th>
                <th scope="col">Email</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Session</th>
                <th scope="col">Blood Group</th>
                <th scope="col" class="text-right">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->member_id_string}}</th>
                        <td>
                            <p class="mb-0">{{$user->full_name}}</p>
                        </td>
                        <td>
                            <p class="mb-0">{{$user->email}}</p>
                        </td>
                        <td>{{$user->mobile_number}}</td>
                        <td>{{$user->academic_session}}</td>
                        <td>{{$user->blood_group}}</td>
                        <td class="text-right text-capitalize">{{$user->status}}</td>
                    </tr>
                @endforeach
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
            order: [[0, "asc"]],
        });
    });
</script>
@endsection
