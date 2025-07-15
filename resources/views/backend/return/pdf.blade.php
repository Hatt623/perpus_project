<h3 style="text-align: center;">Lending Report</h3>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Lending Code</th>
            <th>book title</th>
            <th>Fines</th>
            <th>Status</th>
            <th>lending status</th>
            <th>lending Date</th>
            <th>Will be returned at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($returns as $return)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ optional($return->user)->name }}</td>
            <td>{{$return->lend_code}}</td>
            <td>{{optional($return->book)->title}}</td>
            <td>Rp{{ number_format($return->calculatefines(), 0, ',', '.') }}</td>
            <td>{{ ucfirst($return->status) }}</td>
            <td>
                @if ($return->lending_status == 'borrowed')
                    <span class="badge bg-warning text-dark">Borrowed</span>
                @elseif($return->lending_status == 'returned')
                    <span class="badge bg-success">Returned</span>
                @else
                    <span class="badge bg-danger">Not yet approved</span>
                @endif
            </td>
            <td>{{ $return->created_at->format('d M Y, H:i') }}</td>
            <td>{{  $return->returned_at->format('d M Y, H:i')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>