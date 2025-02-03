<div class="col-md-6 col-lg-3">
    @php
        $user = auth()->user();
    @endphp
    <div class="card shadow mb-4">
        <div class="card-header text-center">
            <h5 class="mb-0">Membership ID: {{$user->member_id_string ?? 'N/A'}}</h5>
            @if($user->memberType)
                <h5 class="mb-0">Type: {{$user->memberType ?$user->memberType->name: 'N/A'}}</h5>
            @endif
        </div>
        <div class="card-body">
            <div class="user_profile text-center">
                <div class="user_img">
                    <img src="{{$user->profile_path}}" alt="{{$user->full_name}}">
                </div>

                <div class="user_info">
                    <p class="mb-0"><b>{{$user->full_name}}</b></p>
                    <p class="mb-0">{{$user->email}}</p>
                </div>
            </div>

            <div class="user_menu mt-4">
                <ul class="list-group up_nav">
                    <li class="list-group-item {{Route::is('userDashboard') ? 'active' : ''}}"><a href="{{route('userDashboard')}}"><i class="fa fa-user"></i> My Profile</a></li>
                    <li class="list-group-item {{(Route::is('user.profileEdit')) ? 'active' : ''}}"><a href="{{route('user.profileEdit')}}"><i class="fa fa-user-edit"></i> Edit Profile</a></li>
                    <li class="list-group-item {{(Route::is('user.registrationFees')) ? 'active' : ''}}"><a href="{{route('user.registrationFees')}}"><i class="fa fa-file-invoice"></i> Registration Fees</a></li>
                    <li class="list-group-item {{(Route::is('user.changePassword')) ? 'active' : ''}}"><a href="{{route('user.changePassword')}}"><i class="fa fa-key"></i> Change Password</a></li>
                    <li class="list-group-item"><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
