@extends('back.layouts.master')
@section('title', 'Photo Gallery')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="row">
    <div class="col-md-8">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="d-inline-block">Gallery List</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr>
                                <th scope="row">{{$gallery->id}}</th>
                                <td>{{$gallery->name}}</td>
                                <td>{{$gallery->position}}</td>
                                <td>{{$gallery->Category->title ?? 'N/A'}}</td>
                                <td>
                                    <a href="{{route('back.galleries.edit', $gallery->id)}}"><i class="fas fa-edit"></i></a>
                                    ||
                                    <form class="d-inline-block" action="{{route('back.galleries.destroy', $gallery->id)}}" method="POST">
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
            <form action="{{route('back.galleries.store')}}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label><b>Gallery Name*</b></label>

                        <input type="text" class="form-control form-control-sm" name="name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label><b>Position*</b></label>

                        <input type="number" class="form-control form-control-sm" name="position" value="{{old('position')}}">
                    </div>

                    <div class="form-group">
                        <label><b>Category</b></label>

                        <select name="category" class="form-control form-control-sm">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
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
            order: [[0, "desc"]],
        });
    });
</script>
@endsection
