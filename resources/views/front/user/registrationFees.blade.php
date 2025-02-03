@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Registration Fees - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])
@endsection

@section('master')
<div class="page_wrap">
    <div class="container">
        <div class="up_wrap">
            <div class="row">
                @include('front.layouts.auth-sidebar')

                <div class="col-md-6 col-lg-9">
                    <div class="up_content_wrap">
                        <div class="card shadow mb-4">
                            <div class="card-header primary_header">
                                <h4 class="d-inline-block">Registration Fees</h4>
                            </div>

                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Date</th>
                                            <th>TRX ID</th>
                                            <th>Amount</th>
                                            <th class="text-right">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payment_history as $key => $history)
                                            <tr style="{{$history->status != 'Success' ? 'background-color:#d21b1b1c;' : ''}}">
                                                <td>{{$key + 1}}</td>
                                                <td>{{ date('d/m/Y', strtotime($history->created_at)) }}</td>
                                                <td>{{$history->trx_id}}</td>
                                                <td>{{$history->amount}}</td>
                                                @if($history->status == 'Success')
                                                    <td class="text-right"><i class="fas fa-check text-success" ></i></td>
                                                @else
                                                    <td class="text-right" class="c_tooltip" data-toggle="tooltip" data-placement="top" title="Please contact admin to approve your account!">
                                                        <i class="fas fa-flag text-danger" ></i>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

