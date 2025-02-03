<table>
	<thead>
		<tr>
			<th>SL.</th>
			<th>Membership ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone Number</th>
            <th >Transaction ID</th>
            <th >Amount</th>
            <th >Status</th>
            <th>Date</th>
		</tr>
	</thead>
	<tbody>
        @foreach($payments as $key => $payment)
            <tr>
                <td  > {{ $key+1 }} </td>
                <td > {{ $payment->user->member_id_string }} </td>
                <td> {{ $payment->user->full_name }}</td>
                <td> {{ $payment->user->email }}</td>
                <td > {{ $payment->user->mobile_number }}</td>
                <td> {{ $payment->trx_id }}</td>
                <td > {{ $payment->amount }}</td>
                <td> {{ $payment->status }}</td>
                <td> {{ $payment->created_at }}</td>
            </tr>
        @endforeach
</tbody>
</table>
