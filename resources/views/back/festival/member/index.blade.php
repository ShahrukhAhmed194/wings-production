@extends('back.layouts.master')
@section('title', 'Festival Members')
@php
    $status = request('status') ?? '';
    $payment_type = request('payment_type') ?? '';
    $session = request('session') ?? '';
@endphp
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
        <h5 class="d-inline-block">Festival Members</h5>

        <a href="{{route('back.festival.register',$festival->id)}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create new</a>
    </div>
    <div class="card-header">
        <form action="{{route('back.festival.member',$festival->id)}}" method="GET">
            <input type="hidden" name="festival_id" value="{{ $festival->id }}" />
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control form-control-sm">
                            <option value="" {{ $status=='' ? 'selected':'' }}>All</option>
                            <option value="1" {{ $status== 1 ?'selected':'' }}>Paid</option>
                            <option value="2" {{ $status== 2 ?'selected':'' }}>Unpaid</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select name="payment_type" id="payment_type" class="form-control form-control-sm">
                            <option value="" {{ $payment_type=='' ? 'selected':'' }}>All</option>
                            <option value="bKash" {{ $payment_type=='bKash' ? 'selected':'' }}>bKash</option>
                            <option value="Nagad" {{ $payment_type=='Nagad' ? 'selected':'' }}>Nagad</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Session</label>
                        <select name="session" id="session" class="form-control form-control-sm">
                            <option value="" {{ $session=='' ? 'selected':'' }}>All</option>
                            @foreach($sessions as $ss)
                                <option value="{{$ss}}" {{ $session==$ss ? 'selected':'' }}>{{$ss}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Action</label>
                    <br>
                    <button name="action" value="view" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</button>
                    <button name="format" value="pdf" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i> PDF</button>
<!--                    <button name="format" value="excel" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> Excel</button>
                    <button name="format" value="csv" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> CSV</button>
                -->
                </div>
            </div>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">SL</th>
<!--                      <th scope="col">Img Name</th>-->
                      <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Father Name</th>
                    <th scope="col">Mother Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                      <th scope="col" class="text-center">Payment Type</th>
                      <th scope="col">Status</th>
                      <th scope="col" class="text-center">Amount</th>
                      <th scope="col">Session</th>
                      <th scope="col">Gender</th>
                      <th scope="col">Person</th>
                      <th scope="col">Guest</th>
                      <th scope="col" class="text-center">Transaction No</th>
                    <th scope="col" class="text-right">Action</th>
                    <th scope="col" class="text-right">Blood Group</th>
                    <th scope="col" class="text-right">Address</th>
                    <th scope="col" class="text-right">T-Shirt Size</th>
                    <th scope="col" class="text-right">Organization Name</th>
                    <th scope="col" class="text-right">Designation</th>
                    <th scope="col" class="text-right">Organization Phone</th>
                    <th scope="col" class="text-right">Organization Address	</th>
                  </tr>
            </thead>
            <tbody>

            </tbody>
            <tbody>
                <tr>
                    <td ></td>
                    <td colspan="8" class="text-center">Total {{ $status == 2?'Unpaid':'Paid' }}</td>
                    <td class="text-center">
                        <p class="mb-0">{{ $total }}</p>
                    </td>
                    <td colspan="14"></td>
                </tr>
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
        $(document).ready(function(){
            //let tbl_festival_members = $('#dataTable').DataTable({
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
                    "url": "{{route('back.festival.member.table',$festival->id)}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}", status: "{{$status}}", payment_type: "{{$payment_type}}",ac_session: "{{ $session }}"}
                },
                "columns": [
                    {"data": "blank"},
                    {"data": "sl_desc"},
                    /*{"data": "image_name"},*/
                    {"data": "image"},
                    {"data": "name"},
                    {"data": "father_name"},
                    {"data": "mother_name"},
                    {"data": "email"},
                    {"data": "phone_number"},
                    {"data": "payment_type"},
                    {"data": "is_paid"},
                    {"data": "payable_amount"},
                    {"data": "session"},
                    {"data": "gender"},
                    {"data": "number_of_person"},
                    {"data": "number_of_guest"},
                    {"data": "transaction_no"},
                    {"data": "action"},
                    {"data": "blood_group"},
                    {"data": "address"},
                    {"data": "t_shirt"},
                    {"data": "organization_name"},
                    {"data": "designation"},
                    {"data": "organization_phone"},
                    {"data": "organization_address"},
                ],
                "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
                order: [[1, 'desc']],
                "columnDefs": [
                    {orderable: false, className: 'select-checkbox', targets: 0,},
                    {orderable: true, className: 'reorder', targets: [1]},
                    {orderable: false, targets: '_all'}
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
            });
           /* $('#status').change(function () {
                tbl_festival_members.ajax.reload();
            })
            $('#payment_type').change(function () {
                tbl_festival_members.ajax.reload();
            })
            $('#session').change(function () {
                tbl_festival_members.ajax.reload();
            })*/
        });
    </script>
@endsection
