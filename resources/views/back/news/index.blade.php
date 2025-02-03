@extends('back.layouts.master')
@section('title', 'News')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">News list</h5>

        <a href="{{route('back.news.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create new</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($news as $new)
                    <tr>
                        <th scope="row">{{$new->id}}</th>
                        <td><img src="{{$new->img_paths['small']}}" style="width: 30px"></td>
                        <td>{{$new->title}}</td>
                        <td>{{date('d/m/Y', strtotime($new->created_at))}}</td>
                        <td>
                            <a href="{{route('back.news.edit', $new->id)}}"><i class="fas fa-edit"></i></a>
                            ||
                            <form class="d-inline-block" action="{{route('back.news.destroy', $new->id)}}" method="POST">
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
