@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Member Details - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])
@endsection

@section('master')
    <div class="page_wrap">
        <div class="container">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 ">
                            <h5 class="mb-2"><b>{{$user->full_name}}</b></h5>
                            <p class="mb-1">{{$user->mobile_number ?? 'N/A'}}</p>
                            <p class="mb-1">{{$user->email ?? 'N/A'}}</p>
                            <p class="mb-1">{{$user->facebook_link ?? 'N/A'}}</p>
                        </div>
                        <div class="col-6 text-right">
                            <img src="{{$user->profile_path}}" alt="{{$user->full_name}}" class="img-thumbnail member_image">
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Session</b></label>
                                <br>
                                <label>{{$user->academic_session ?? 'N/A'}}</label>
                            </div>
                        </div>
                        {{--
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label><b>Nick Name</b></label>
                                  <br>
                                  <label>{{$user->nick_name ?? 'N/A'}}</label>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label><b>Hall</b></label>
                                  <br>
                                  <label>{{$user->hall ?? 'N/A'}}</label>
                              </div>
                          </div>
                          --}}
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Gender</b></label>
                                <br>
                                <label>{{$user->gender ?? 'N/A'}}</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Blood Group</b></label>
                                <br>
                                <label>{{$user->blood_group ?? 'N/A'}}</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Date of Birth</b></label>
                                <br>
                                <label>{{$user->dob ? date('d/m/Y', strtotime($user->dob)) : 'N/A'}}</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Place of Birth</b></label>
                                <br>
                                <label>{{$user->place_of_birth ?? 'N/A'}}</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Father's Name</b></label>
                                <br>
                                <label>{{$user->father_name ?? 'N/A'}}</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
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
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label><b>Spouse Name</b></label>
                                    <br>
                                    <label>{{$user->spouse_name ?? 'N/A'}}</label>
                                </div>
                            </div>
                            {{--
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Spouse Date of Birth</b></label>
                                    <br>
                                    <label>{{$user->spouse_dob ? date('d/m/Y', strtotime($user->spouse_dob)) : 'N/A'}}</label>
                                </div>
                            </div>
                            --}}
                        </div>
                        {{--
                        @if(count($user->UserKids))
                        <hr>
                        <h5 class="d-inline-block">Kids</h5>
                        <div class="kids_inputs">
                            @foreach ($user->UserKids as $kid)
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
                                            <label>{{$kid->dob ? date('d/m/Y', strtotime($kid->dob)) : 'N/A'}}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif
                           --}}
                        @endif
                    </div>

                    <hr>
                    <h5 class="d-inline-block">Mailing Address</h5>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <label><b>Address</b></label>
                            <br>
                            <label>{{$user->mailing_address ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>City</b></label>
                            <br>
                            <label>{{$user->mailing_city ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>District</b></label>
                            <br>
                            <label>{{$user->mailing_district ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>Post Code</b></label>
                            <br>
                            <label>{{$user->mailing_post_code ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>Country</b></label>
                            <br>
                            <label>{{$user->mailing_country ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>Contact No:</b></label>
                            <br>
                            <label>{{$user->contact_no_res ?? 'N/A'}}</label>
                        </div>
                    </div>

                    <hr>
                    <h5 class="d-inline-block">Permanent Address</h5>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <label><b>Address</b></label>
                            <br>
                            <label>{{$user->permanent_address ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>City</b></label>
                            <br>
                            <label>{{$user->permanent_city ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>District</b></label>
                            <br>
                            <label>{{$user->permanent_district ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>Post Code</b></label>
                            <br>
                            <label>{{$user->permanent_post_code ?? 'N/A'}}</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label><b>Country</b></label>
                            <br>
                            <label>{{$user->permanent_country ?? 'N/A'}}</label>
                        </div>
                    </div>

                    <hr>
                    <h5 class="d-inline-block">Organization details</h5>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Organization</b></label>
                                <br>
                                <label>{{$user->organization ?? 'N/A'}}</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Present Status/Designation</b></label>
                                <br>
                                <label>{{$user->organization_designation ?? 'N/A'}}</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label><b>Phone No</b></label>
                                <br>
                                <label>{{$user->organization_phone ?? 'N/A'}}</label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6">
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
@endsection
