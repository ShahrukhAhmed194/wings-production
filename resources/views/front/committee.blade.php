@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Committee - ' . ($settings_g['title'] ?? env('APP_NAME'))
    ])
    <style>
    .our-team{ text-align: center;     margin-bottom: 15px;}
    .our-team .pic{
    border-radius: 50%;
    overflow: hidden;
    position: relative;display: block;
    }
    .our-team img{
    width: 100%;
    height: auto;
    }
    .our-team .title{
    font-size: 15px;
    font-weight: bold;
    color: #222;
    padding-bottom: 10px;
    margin: 15px 0 10px 0;
    position: relative;
    }
    .our-team .title a{color: #000}
    .our-team .title a:hover{text-decoration: none}
    .our-team .title:after{
    content: "";
    width: 30px;
    height: 2px;
    background: #222;
    margin: 0 auto;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    }
    .our-team .post{
    display: block;
    font-size: 16px;
    font-style: italic;
    color: #777;
    }
    .our-team .post a{color: #000;    font-size: 14px;}
    .our-team .post a:hover{text-decoration: none}
    .our-team .icon{
    list-style: none;
    padding: 0;
    margin: 10px 0 0 0;
    }
    .our-team .icon li{ display: inline-block; }
    .our-team .icon li a{
    display: inline-block;
    width: 30px;
    height: 30px;
    line-height: 30px;
    border-radius: 50%;
    background: #e0e0e0;
    font-size: 14px;
    color: #999;
    margin-right: 5px;
    transition: all 0.3s ease-out 0s;
    }
    .our-team .icon li a:hover{
    background: #37b0f1;
    color: #fff;
    }
    @media only screen and (max-width: 990px){
    .our-team{ margin-bottom: 30px; }
    }
 </style>
@endsection

@section('master')
@php
    $committees = App\Models\Committee::with('CommitteeMembers', 'CommitteeMembers.User')->where(['status'=>1])->get();
@endphp
<div class="page_wrap">
    <div class="container">
        @foreach($committees as $key=>$committee)
            @if($committee->CommitteeMembers->count()>0)
                <h1 class="text-center">{{$committee->name}}</h1>
                <div class="row justify-content-center mb-2">
                    <div class="col-md-12 mb-2">
                        <div class="row justify-content-center">
                            @foreach ($committee->CommitteeMembers as $member)
                                @if($key > 1)
                                    <div class="col-md-2 card">
                                        @include('front.layouts.committee_member_loop')
                                    </div>
                                @else
                                    <div class="col-md-3 card">
                                        @include('front.layouts.committee_member_loop')
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
