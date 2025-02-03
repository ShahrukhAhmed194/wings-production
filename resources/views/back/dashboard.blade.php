@extends('back.layouts.master')
@section('title', 'Dashboard')

@section('master')
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-dark mb-3 custom_dashboard_card overflow-hidden">
                <div class="card-body">
                  <div class="row">
                      <div class="col-9">
                        <h1 class="card-title">{{$pending_members}}</h1>
                        <p class="card-text">Pending Members</p>
                      </div>

                      <div class="col-3 text-right">
                          <i class="fas fa-list cdc_icon"></i>
                      </div>
                  </div>
                </div>
                <div class="card-footer text-center"><a href="{{route('back.members.index')}}?status=pending" class="d-block text-light">More Info <i class="fas fa-arrow-right"></i></a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success mb-3 custom_dashboard_card overflow-hidden">
                <div class="card-body">
                  <div class="row">
                      <div class="col-9">
                        <h1 class="card-title">{{$active_members}}</h1>
                        <p class="card-text">Active Members</p>
                      </div>

                      <div class="col-3 text-right">
                          <i class="fas fa-check cdc_icon"></i>
                      </div>
                  </div>
                </div>
                <div class="card-footer text-center"><a href="{{route('back.members.index')}}?status=approved" class="d-block text-light">More Info <i class="fas fa-arrow-right"></i></a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning mb-3 custom_dashboard_card overflow-hidden">
                <div class="card-body">
                  <div class="row">
                      <div class="col-9">
                        <h1 class="card-title">{{$canceled_members}}</h1>
                        <p class="card-text">Canceled Members</p>
                      </div>

                      <div class="col-3 text-right">
                          <i class="fas fa-times cdc_icon"></i>
                      </div>
                  </div>
                </div>
                <div class="card-footer text-center"><a href="{{route('back.members.index')}}?status=canceled" class="d-block text-light">More Info <i class="fas fa-arrow-right"></i></a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-secondary mb-3 custom_dashboard_card overflow-hidden">
                <div class="card-body">
                  <div class="row">
                      <div class="col-9">
                        <h1 class="card-title">{{$all_members}}</h1>
                        <p class="card-text">All Members</p>
                      </div>

                      <div class="col-3 text-right">
                          <i class="fas fa-users cdc_icon"></i>
                      </div>
                  </div>
                </div>
                <div class="card-footer text-center"><a href="{{route('back.members.index')}}?status=All" class="d-block text-light">More Info <i class="fas fa-arrow-right"></i></a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning mb-3 custom_dashboard_card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h1 class="card-title">{{$unpaid_members}}</h1>
                            <p class="card-text">Unpaid Members</p>
                        </div>

                        <div class="col-3 text-right">
                            <i class="fas fa-times cdc_icon"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center"><a href="{{route('back.members.index')}}?payment_status=unpaid}}" class="d-block text-light">More Info <i class="fas fa-arrow-right"></i></a></div>
            </div>
        </div>
    </div>
@endsection
