@extends('back.layouts.master')
@section('title', 'Member Payment Report')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <form action="{{route('back.members.payment.report')}}" method="GET">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Order ID</label>

                        <input type="text" value="{{request('trx_id')}}" name="trx_id" class="form-control form-control-sm" placeholder="order id">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tnx ID</label>

                        <input type="text" value="{{request('nagad_tnx_id')}}" name="nagad_tnx_id" class="form-control form-control-sm" placeholder="trx id">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Status</label>

                        <select name="status" class="form-control form-control-sm">
                            <option value="">All</option>
                            <option value="success" {{request('status') == 'success' ? 'selected' : ''}}>Success</option>
                            <option value="pending" {{request('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                            <option value="fail" {{request('status') == 'fail' ? 'selected' : ''}}>Fail</option>
                        </select>
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
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Order ID</th>
                <th scope="col">Tnx No</th>
                <th scope="col">Amount</th>
                <th scope="col" class="text-right">Status</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($payments as $key=>$payment)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <th scope="row">{{$payment->user?$payment->user->full_name:''}}</th>
                        <td>
                            <p class="mb-0">{{$payment->user?$payment->user->email:''}}</p>
                        </td>
                        <td>
                            <p class="mb-0">{{$payment->user?$payment->user->mobile_number:''}}</p>
                        </td>
                        <td>{{$payment->trx_id}}</td>
                        <td>{{$payment->nagad_tnx_id}}</td>
                        <td>{{$payment->amount}}</td>
                        <td>{{$payment->status}}</td>
                        <td>{{$payment->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tbody>
            <tr>
                <td ></td>
                <td colspan="5" class="text-center">Total Paid</td>
                <td class="text-center">
                    <p class="mb-0">{{ $payments->where('status','success')->sum('amount') }}</p>
                </td>
                <td colspan="2"></td>
            </tr>
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
