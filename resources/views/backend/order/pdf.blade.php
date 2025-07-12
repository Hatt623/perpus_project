<h3 style="text-align: center;">Order Report</h3>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Order code</th>
            <th>User</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$order->order_code}}</td>
            <td>{{ optional($order->user)->name }}</td>
            <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>{{ $order->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>