<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member Report</title>
</head>

<body style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';" data-saferedirecturl="https://www.google.com/url?q=http://localhost&amp;source=gmail&amp;ust=1607844883689000&amp;usg=AFQjCNE16dMwx_olZ4z84pumj26bbtpg_g">
    <table style="width: 100%">
        <thead>
            <tr>
                <th style="width: 100%;overflow:hidden">
                    <img style="width: 100px; display:inline-block;float:left" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQp0vqAhuT3qyL72y_sdyJHNBxOHrWpENh_GA&usqp=CAU">
                    <h1 style="float: left;text-transform: uppercase;margin-top: 50px;margin-left: 15px;">{{$settings_g['title'] ?? env('APP_NAME')}}</h1>
                </th>
            </tr>
        </thead>
    </table>

    <table style="border-collapse: collapse;">
        <thead>
            <tr>
               <th class="" style="border: 1px solid black">Membership ID</th>
               <th class="" style="border: 1px solid black">Name</th>
               <th class="" style="border: 1px solid black">Email</th>
               <th class="" style="border: 1px solid black">Phone Number</th>
               <th class="" style="border: 1px solid black">Session</th>
                {{--
               <th  style="border: 1px solid black">Nick Name</th>
               --}}
               <th  style="border: 1px solid black">Date of Birth</th>
               <th  style="border: 1px solid black">Gender</th>
               <th  style="border: 1px solid black">Blood Group</th>

<!--               <th  style="border: 1px solid black">Department</th>-->
               <th  style="border: 1px solid black">Father Name</th>
               <th  style="border: 1px solid black">Mother Name</th>
               <th  style="border: 1px solid black">Marital Status</th>
               <th  style="border: 1px solid black">Spouse Name</th>
            </tr>
        </thead>
        <tbody>
             @foreach($users as $user)
                 <tr>
                     <td  style="border: 1px solid black"> {{ $user->member_id_string }} </td>
                     <td  style="border: 1px solid black"> {{ $user->full_name }}</td>
                     <td  style="border: 1px solid black"> {{ $user->email }}</td>
                     <td  style="border: 1px solid black"> {{ $user->mobile_number }}</td>
                     <td  style="border: 1px solid black"> {{ $user->academic_session }}</td>
                     {{--
                     <td  style="border: 1px solid black"> {{ $user->nick_name}} </td>
                     --}}
                     <td  style="border: 1px solid black"> {{ date('Y-m-d', strtotime($user->dob)) }} </td>
                     <td  style="border: 1px solid black"> {{ $user->gender}} </td>
                     <td  style="border: 1px solid black"> {{ $user->blood_group }}</td>
                     {{--
                     <td  style="border: 1px solid black"> {{ $user->department }}</td>
                     --}}
                     <td  style="border: 1px solid black"> {{ $user->father_name }}</td>
                     <td  style="border: 1px solid black"> {{ $user->mother_name }}</td>
                     <td  style="border: 1px solid black"> {{ $user->marital_status }}</td>
                     <td  style="border: 1px solid black"> {{ $user->spouse_name }}</td>
                 </tr>
             @endforeach
        </tbody>
    </table>
</body>
</html>
