@extends('back.layouts.master')
@section('title', 'Gallery Categories')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="row">
    <div class="col-md-8">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="d-inline-block">Category List</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{$category->id}}</th>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm category_title" value="{{$category->title}}">
                                        <div class="input-group-append">
                                            <button type="button" data-id="{{$category->id}}" class="btn btn-info btn-sm update_category"><i class="fas fa-upload"></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @include('switcher::switch', [
                                        'table' => 'categories',
                                        'data' => $category
                                    ])
                                </td>
                                <td>
                                    {{-- <a class="btn btn-primary btn-sm" href="{{route('back.categories.edit', $category->id)}}"><i class="fas fa-edit"></i></a> --}}
                                    <form class="d-inline-block" action="{{route('back.categories.destroy', $category->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf


                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i></button>
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
                <h5>Create Category</h5>
            </div>

            <form action="{{route('back.categories.store')}}" method="POST">
                @csrf
                <input type="hidden" name="for" value="gallery">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Title*</b></label>
                                <input type="text" class="form-control form-control-sm" name="title" value="{{old('title')}}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success">Create</button>
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

    $(document).on('click', '.update_category', function(){
        let id = $(this).data('id');
        let title = $(this).closest('tr').find('.category_title').val();

        cLoader();

        $.ajax({
            url: "{{route('back.categories.updateAjax')}}",
            method: 'POST',
            data: {title, id, _token: '{{csrf_token()}}'},
            success: function(){
                cLoader('h');
                cAlert('success', 'Category updated successfully.');
            },
            error: function(){
                cLoader('h');
                cAlert();
            }
        });
    });
</script>
@endsection
