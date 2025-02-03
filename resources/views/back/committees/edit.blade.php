@extends('back.layouts.master')
@section('title', 'Committee')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="row">
    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="mb-0">Edit Committee</h5>
            </div>
            <form action="{{route('back.committees.update', $committee)}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="card-body">
                    <div class="form-group">
                        <label><b>Name*</b></label>

                        <input type="text" class="form-control form-control-sm" name="name" value="{{old('name') ?? $committee->name}}">
                    </div>

                    <div class="form-group">
                        <label><b>Short Description</b></label>

                        <textarea name="short_description" cols="30" rows="4" class="form-control form-control-sm">{{old('short_description') ?? $committee->short_description}}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success">Update</button>
                    <br>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="d-inline-block">Committee Members</h5>

                <a href="{{route('back.committees.memberCreate', $committee->id)}}" class="btn btn-success btn-sm float-right">Create Member</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                      <tr>
                        <th scope="col">Position</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($committee->CommitteeMembers as $member)
                            <tr>
                                <th scope="row">{{$member->position}}</th>
                                <td><img src="{{$member->img_paths['small']}}" style="width: 30px"></td>
                                <td>{{$member->User?$member->User->full_name:''}}</td>
                                <td>{{$member->designation}}</td>
                                <td>
                                    <a href="{{route('back.committees.memberEdit', $member->id)}}"><i class="fas fa-edit"></i></a>
                                    ||
                                    <form class="d-inline-block" action="{{route('back.committees.memberDestroy', $member->id)}}" method="POST">
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
