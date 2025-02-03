@extends('back.layouts.master')
@section('title', 'Committees')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="row">
    <div class="col-md-8">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="d-inline-block">Committee List</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($committees as $committee)
                            <tr>
                                <th scope="row">{{$committee->id}}</th>
                                <td>{{$committee->name}}</td>
                                <td>{{date('d/m/Y', strtotime($committee->created_at))}}</td>
                                <td>
                                    @include('switcher::switch', [
                                        'table' => 'committees',
                                        'data' => $committee
                                    ])
                                </td>
                                <td>
                                    <a href="{{route('back.committees.edit', $committee->id)}}"><i class="fas fa-edit"></i></a>
                                    ||
                                    <form class="d-inline-block" action="{{route('back.committees.destroy', $committee->id)}}" method="POST">
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
    </div>

    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="mb-0">Create Committee</h5>
            </div>
            <form action="{{route('back.committees.store')}}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label><b>Name*</b></label>

                        <input type="text" class="form-control form-control-sm" name="name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label><b>Short Description</b></label>

                        <textarea name="short_description" cols="30" rows="4" class="form-control form-control-sm">{{old('short_description')}}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Create</button>
                    <br>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </form>
        </div>
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
