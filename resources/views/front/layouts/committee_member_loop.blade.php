<div class="our-team">
    <a href="{{route('committeeMember', $member->id)}}" class="pic block"><img src="{{$member->img_paths['small']}}" alt="{{$member->User->full_name}}"></a>
    <h3 class="title"><a href="{{route('committeeMember', $member->id)}}">{{$member->User->full_name}}</a></h3>
    <span class="post"><a href="{{route('committeeMember', $member->id)}}">{{$member->designation}}</a></span>
</div>
