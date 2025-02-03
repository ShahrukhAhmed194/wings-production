<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Reports</title>
</head>

<body style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';" data-saferedirecturl="https://www.google.com/url?q=http://localhost&amp;source=gmail&amp;ust=1607844883689000&amp;usg=AFQjCNE16dMwx_olZ4z84pumj26bbtpg_g">
    <table style="width: 100%">
        <thead>
            <tr>
                <th style="width: 100%;overflow:hidden">
                    <img style="width: 100px; display:inline-block;float:left" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQp0vqAhuT3qyL72y_sdyJHNBxOHrWpENh_GA&usqp=CAU" alt="">
                    <h1 style="float: left;text-transform: uppercase;margin-top: 50px;margin-left: 15px;">{{$settings_g['title'] ?? env('APP_NAME')}}</h1>
                </th>
            </tr>
        </thead>
    </table>

    <table style="border-collapse: collapse;">
        <thead>
            <tr>
                <th scope="col" style="border: 1px solid black">#</th>
               <th class="" style="border: 1px solid black">Membership ID</th>
               <th class="" style="border: 1px solid black">Name</th>
               <th class="" style="border: 1px solid black">Email</th>
               <th class="" style="border: 1px solid black">Phone Number</th>
               <th class="" style="border: 1px solid black">Transaction ID</th>
               <th class="" style="border: 1px solid black">Amount</th>
               <th class="" style="border: 1px solid black">Status</th>
               <th class="" style="border: 1px solid black">Date</th>
            </tr>
        </thead>
        <tbody>
             @foreach($payments as $key=>$payment)
                 <tr>
                     <td  style="border: 1px solid black"> {{ $key+1 }} </td>
                     <td  style="border: 1px solid black"> {{ $payment->user->member_id_string }} </td>
                     <td  style="border: 1px solid black"> {{ $payment->user->full_name }}</td>
                     <td  style="border: 1px solid black"> {{ $payment->user->email }}</td>
                     <td  style="border: 1px solid black"> {{ $payment->user->mobile_number }}</td>
                     <td  style="border: 1px solid black"> {{ $payment->trx_id }}</td>
                     <td  style="border: 1px solid black"> {{ $payment->amount }}</td>
                     <td  style="border: 1px solid black"> {{ $payment->status }}</td>
                     <td  style="border: 1px solid black"> {{ $payment->created_at }}</td>
                 </tr>
             @endforeach
             <tr>
                 <td  style="border: 1px solid black; text-align: center" colspan="6"> Total</td>
                 <td  style="border: 1px solid black" colspan="3"> {{ $payments->sum('amount') }}</td>
             </tr>
        </tbody>
    </table>
</body>
</html>
