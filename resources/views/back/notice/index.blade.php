@extends('back.layouts.master')
@section('title', 'Notice')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Notice List</h5>

        <a href="{{route('back.notice.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create New</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Send Mail To</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($notices as $notice)
                    <tr>
                        <th scope="row">{{$notice->id}}</th>
                        <td>{{$notice->title}}</td>
                        <td>{{$notice->send_mail_to ?? 'N/A'}}</td>
                        <td>
                            @include('switcher::switch', [
                                'table' => 'notices',
                                'data' => $notice
                            ])
                        </td>
                        <td>
                            <a href="{{route('back.notice.edit', $notice->id)}}"><i class="fas fa-edit"></i></a>
                            ||
                            <form class="d-inline-block" action="{{route('back.notice.destroy', $notice->id)}}" method="POST">
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
