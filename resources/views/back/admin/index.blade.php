@extends('back.layouts.master')
@section('title', 'Admins')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Admin list</h5>

        <a href="{{route('back.admins.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create new</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->full_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile_number}}</td>
                        <td>
                            <a href="{{route('back.admins.edit', $user->id)}}"><i class="fas fa-edit"></i></a>

                            <form class="d-inline-block" action="{{route('back.admins.destroy', $user->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="table_btn" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash text-danger"></i></button>
                            </form>
                        </td>
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
            order: [[0, "desc"]],
        });
    });
</script>
@endsection
