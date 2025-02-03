@extends('back.layouts.master')
@section('title', 'All Festivals')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Member list</h5>

        <a href="{{route('back.festival.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create new</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
                  <tr>
                    <th scope="col" style="width: 70px">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Festival Date</th>
                    <th scope="col">Reg. Last Date</th>
                    <th scope="col" class="text-center">Fee</th>
                    <th scope="col" class="text-center">Guest Fee</th>
                    <th scope="col" class="text-center">Total Register</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-right">Action</th>
                  </tr>
            </thead>
            <tbody>
                @foreach ($festivals as $key=>$festival)
                    <tr>
                        <td >{{ $key+1  }}</td>
                        <td >{{$festival->title}}</td>
                        <td>{{ $festival->festival_date }}</td>
                        <td>{{ $festival->registration_last_date }}</td>
                        <td class="text-center">
                            <p class="mb-0">{{ $festival->fee_amount }}</p>
                        </td>
                        <td class="text-center">
                            <p class="mb-0">{{ $festival->guest_fee_amount }}</p>
                        </td>
                        <td class="text-center">
                            {{ $festival->festivalMembers->count() }}
                            <a class="btn btn-info btn-sm" href="{{route('back.festival.member',$festival->id)}}"><i class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            @include('switcher::switch', [
                                'table' => 'festivals',
                                'data' => $festival
                            ])
                        </td>
                        <td class="text-right">
                            <a class="btn btn-info btn-sm" href="{{route('back.festival.edit', $festival->id)}}"><i class="fas fa-edit"></i></a>
                            {{-- <form class="d-inline-block" action="{{route('back.admins.destroy', $user->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="table_btn" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash text-danger"></i></button>
                            </form> --}}
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
            order: [[0, "asc"]],
        });
    });
</script>
@endsection
