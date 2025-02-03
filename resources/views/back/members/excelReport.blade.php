<table>
	<thead>
		<tr>
			<th>Sl NO.</th>
			<th>Membership ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Session</th>
<!--			<th>Name in Bangla</th>
			<th>Nick Name</th>-->
			<th>Gender</th>
			<th>Dath of Birth</th>
<!--			<th>Place of Birth</th>-->
			<th>Blood Group</th>
<!--			<th>Department</th>
			<th>Hall</th>-->
			<th>Father Name</th>
			<th>Mother Name</th>
			<th>Marital Status</th>
			<th>Name of Spouse</th>
<!--			<th>Spouse Date of Birth</th>
			<th>Children</th>-->
			<th>Mailing Address</th>
			<th>Permanent Address</th>
			<th>Organization</th>
			<th>Present Status With Designation</th>
			<th>Organization Address</th>
			<th>Contact No</th>
			<th>Email</th>
			<th>Photo</th>
			<th>Membership Payment By</th>
			<th>Payment Details</th>
		</tr>
	</thead>
	<tbody>
        @foreach($users as $key => $user)
            <tr>
                <td> {{$key + 1}} </td>
                <td> {{ $user->member_id_string }} </td>
                <td> {{ $user->full_name }} </td>
                <td> {{ $user->email }} </td>
                <td> {{ $user->mobile_number }} </td>
                <td> {{ $user->academic_session }} </td>
{{--                <td> {{ $user->bangeli_name }} </td>
                <td> {{ $user->nick_name}} </td>--}}
                <td> {{ $user->gender }}</td>
                <td> {{ date('Y-m-d', strtotime($user->dob)) }}</td>
                {{--
                <td> {{ $user->place_of_birth }}</td> ---}}
                <td> {{ $user->blood_group }}</td>
                {{--
                <td> {{ $user->department }}</td>
                <th> {{ $user->hall }}</th>
                --}}
                <td> {{ $user->father_name }}</td>
                <td> {{ $user->mother_name }}</td>
                <td> {{ $user->marital_status }}</td>
                <td> {{ $user->marital_status != 'Unmarried' ? $user->spouse_name : '' }}</td>
                {{--
                <td> {{ $user->marital_status != 'Unmarried' ? date('Y-m-d', strtotime($user->spouse_dob)) : '' }}</td>
                <td>
                    @if($user->marital_status != 'Unmarried')
                        @foreach ($user->UserKids as $hid)
                            {{$hid['name'] . ', '}}
                        @endforeach
                    @endif
                </td>
                ---}}
                <td> {{ $user->mailing_address }}</td>
                <td> {{ $user->permanent_address }}</td>
                <td> {{ $user->organization }}</td>
                <td> {{ $user->organization_designation }}</td>
                <td> {{ $user->organization_address }}</td>
                <td> {{ $user->organization_phone }}</td>
                <td> {{ $user->profile_path }}</td>
                <td> {{ $user->payment_method }}</td>
                <td> {{ $user->payment_trx_number }}</td>
                </tr>
        @endforeach
</tbody>
</table>
