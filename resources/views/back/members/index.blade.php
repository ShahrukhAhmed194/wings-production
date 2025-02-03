@extends('back.layouts.master')
@php
    $status = request('status') ?? 'All';
    $ac_session = request('session') ?? '';
    $payment_status = request('payment_status') ?? '';
    $member_type = request('member_type') ?? '';
@endphp
@section('title', $status.' Members')
@section('head')
    <link rel="stylesheet" href="{{ asset('datatable/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('datatable/datatables-select/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Member list</h5>

        <a href="{{route('back.members.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create new</a>
    </div>
    <div class="card-header">
        <form action="{{route('back.members.index')}}" method="GET">
            <input type="hidden" name="status" value="{{ $status }}">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Member Type</label>
                        <select name="member_type" id="member_type" class="form-control form-control-sm">
                            <option value="" {{ $member_type=='' ? 'selected':'' }}>All</option>
                            @foreach($member_types as $type)
                                <option value="{{$type->id}}" {{ $member_type==$type->id ? 'selected':'' }}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select name="payment_status" id="payment_status" class="form-control form-control-sm">
                            <option value="" {{ $payment_status=='' ? 'selected':'' }}>All</option>
                            <option value="paid" {{ $payment_status== 'paid' ?'selected':'' }}>Paid</option>
                            <option value="unpaid" {{ $payment_status== 'unpaid' ?'selected':'' }}>Unpaid</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Session</label>
                        <select name="session" id="session" class="form-control form-control-sm">
                            <option value="" {{ $ac_session=='' ? 'selected':'' }}>All</option>
                            @foreach($academic_sessions as $ss)
                                <option value="{{$ss}}" {{ $ac_session==$ss ? 'selected':'' }}>{{$ss}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Action</label>
                    <br>
                    <button name="action" value="view" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 70px">ID</th>
                  <th scope="col">Date</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Type</th>
                  <th scope="col">Session</th>
                  <th scope="col">Status</th>
                  <th scope="col">Is Paid</th>
                  <th scope="col" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{ asset('datatable/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatable/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('datatable/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatable/datatables-select/js/dataTables.select.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script src="{{ asset('datatable/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('datatable/select2/js/select2.full.min.js') }}"></script>
    <!-- Select2 -->
<script>
    $(document).ready( function () {
        $('#dataTable').DataTable({
            responsive: true,
            //stateSave: true,
            "processing": true,
            "serverSide": true,
            dom: 'Bfrtip',
            dom: '<"pull-left"B><"pull-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
            buttons: [
                'colvis',
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        //stripHtml: false,
                        rows: function (idx, data, node) {
                            var dt = new $.fn.dataTable.Api('#example');
                            var selected = dt.rows({selected: true}).indexes().toArray();
                            if (selected.length === 0 || $.inArray(idx, selected) !== -1)
                                return true;
                            return false;
                        },
                        columns: ':visible'
                    },
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    text: 'PDF',

                    exportOptions: {
                        //stripHtml: false,
                        rows: function (idx, data, node) {
                            var dt = new $.fn.dataTable.Api('#example');
                            var selected = dt.rows({selected: true}).indexes().toArray();
                            if (selected.length === 0 || $.inArray(idx, selected) !== -1)
                                return true;
                            return false;
                        },
                        columns: ':visible',
                        /*columnDefs: [
                            {
                                "targets": 2,
                                "render": function ( data, type, row ) {
                                    return data;
                                },
                            }
                        ],*/
                    }
                },
                {
                    extend: 'print',
                    autoPrint: true,
                    text: 'Print',
                    exportOptions: {
                        stripHtml: false,
                        rows: function (idx, data, node) {
                            var dt = new $.fn.dataTable.Api('#example');
                            var selected = dt.rows({selected: true}).indexes().toArray();

                            if (selected.length === 0 || $.inArray(idx, selected) !== -1)
                                return true;
                            return false;
                        },
                        columns: ':visible',
                    },
                }
            ],
            "ajax": {
                "url": "{{route('back.member.table')}}",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}", status: "{{$status}}", ac_session: "{{$ac_session}}",payment_status:"{{$payment_status}}",member_type:"{{$member_type}}"}
            },
            "columns": [
                {"data": "blank"},
                {"data": "member_id_string"},
                {"data": "date"},
                {"data": "name"},
                {"data": "email"},
                {"data": "phone_number"},
                {"data": "type"},
                {"data": "academic_session"},
                {"data": "approval_status"},
                {"data": "payment_status"},
                {"data": "action"},
            ],
            "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
            order: [[0, "asc"]],
            "columnDefs": [
                {orderable: false, className: 'select-checkbox', targets: 0,},
                { orderable: true, className: 'reorder', targets: [1] },
                { orderable: false, targets: '_all' }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
        });
    });
</script>
@endsection
