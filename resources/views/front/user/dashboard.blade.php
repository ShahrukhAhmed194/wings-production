@extends('front.layouts.master')
@php
$user = auth()->user();
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'Dashboard - ' . ($settings_g['title'] ?? env('APP_NAME')),
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
                                <h4 class="d-inline-block">Member Information</h4>

                                @if($user->status == 'pending')
                                <button class="btn btm-sm btn-warning float-right">Pending</button>
                                @elseif($user->status == 'canceled')
                                <button class="btn btm-sm btn-danger float-right">Canceled</button>
                                @else
                                <button class="btn btm-sm btn-success float-right">Approved</button>
                                @endif
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Full Name*</b></label>
                                            <br>
                                            <label>{{$user->full_name ?? 'N/A'}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Email*</b></label>
                                            <br>
                                            <label>{{$user->email ?? 'N/A'}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{--
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Name in Bengali</b></label>
                                            <br>
                                            <label>{{$user->bengali_name ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Nick Name</b></label>
                                            <br>
                                            <label>{{$user->nick_name ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    --}}

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>NID/Passport No</b></label>
                                            <br>
                                            <label>{{$user->nid ?? 'N/A'}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Mobile Number</b></label>
                                            <br>
                                            <label>{{$user->mobile_number ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Session</b></label>
                                            <br>
                                            <label>{{$user->academic_session ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Gender</b></label>
                                            <br>
                                            <label>{{$user->gender ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Blood Group</b></label>
                                            <br>
                                            <label>{{$user->blood_group ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Date of Birth</b></label>
                                            <br>
                                            <label>{{$user->dob ? date('d/m/Y', strtotime($user->dob)) : 'N/A'}}</label>
                                        </div>
                                    </div>
                                    {{--
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Place of Birth</b></label>
                                            <br>
                                            <label>{{$user->place_of_birth ?? 'N/A'}}</label>
                                        </div>
                                    </div>
                                    --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Facebook Link</b></label>
                                            <br>
                                            <label>{{$user->facebook_link ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Father's Name</b></label>
                                            <br>
                                            <label>{{$user->father_name ?? 'N/A'}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Mother's Name</b></label>
                                            <br>
                                            <label>{{$user->mother_name ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><b>Marital Status</b></label>
                                            <br>
                                            <label>{{$user->marital_status ?? 'N/A'}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="married_section">
                                    @if($user->marital_status != 'Unmarried')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><b>Spouse Name</b></label>
                                                <br>
                                                <label>{{$user->spouse_name ?? 'N/A'}}</label>
                                            </div>
                                        </div>
                                        {{--
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><b>Spouse Date of Birth</b></label>
                                                <br>
                                                <label>{{$user->spouse_dob ? date('d/m/Y', strtotime($user->spouse_dob)) : 'N/A'}}</label>
                                            </div>
                                        </div>
                                        --}}
                                    </div>
                                    {{--
                                    <hr>

                                    <h5 class="d-inline-block">Kids</h5>

                                    <div class="kids_inputs">
                                        @foreach (auth()->User()->UserKids as $kid)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><b>Name of Kid</b></label>
                                                        <br>
                                                        <label>{{$kid->name}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><b>Date of Birth</b></label>
                                                        <br>
                                                        <label>{{date('d/m/Y', strtotime($kid->dob))}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                     --}}
                                    @endif
                                </div>

                                <hr>
                                <h5 class="d-inline-block">Mailing Address</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label><b>Address</b></label>
                                        <br>
                                        <label>{{$user->mailing_address ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>City</b></label>
                                        <br>
                                        <label>{{$user->mailing_city ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>District</b></label>
                                        <br>
                                        <label>{{$user->mailing_district ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Post Code</b></label>
                                        <br>
                                        <label>{{$user->mailing_post_code ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Country</b></label>
                                        <br>
                                        <label>{{$user->mailing_country ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Contact No:</b></label>
                                        <br>
                                        <label>{{$user->contact_no_res ?? 'N/A'}}</label>
                                    </div>
                                </div>

                                <hr>
                                <h5 class="d-inline-block">Permanent Address</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label><b>Address</b></label>
                                        <br>
                                        <label>{{$user->permanent_address ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>City</b></label>
                                        <br>
                                        <label>{{$user->permanent_city ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>District</b></label>
                                        <br>
                                        <label>{{$user->permanent_district ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Post Code</b></label>
                                        <br>
                                        <label>{{$user->permanent_post_code ?? 'N/A'}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Country</b></label>
                                        <br>
                                        <label>{{$user->permanent_country ?? 'N/A'}}</label>
                                    </div>
                                </div>

                                <hr>
                                <h5 class="d-inline-block">Organization details</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Organization</b></label>
                                            <br>
                                            <label>{{$user->organization ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Present Status/Designation</b></label>
                                            <br>
                                            <label>{{$user->organization_designation ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Phone No</b></label>
                                            <br>
                                            <label>{{$user->organization_phone ?? 'N/A'}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>Organization Address</b></label>
                                            <br>
                                            <label>{{$user->organization_address ?? 'N/A'}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
