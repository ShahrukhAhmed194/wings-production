@php
    $notice = \App\Models\Notice::active()->latest('id')->first();
@endphp

@if($notice)
<div class="card shadow mb-4">
    <div class="card-header primary_header">
        <h5 class="d-inline-block mb-0">Notice</h5>
    </div>

    <div class="card-body">
        <h5 class="mb-0"><b>{{$notice->title}}</b></h5>
        <small class="mb-2 d-block">Published: {{date('d/m/Y', strtotime($notice->created_at))}}</small>

        <div class="text-justify">
            {!! $notice->description !!}
        </div>
    </div>
</div>
@endif
