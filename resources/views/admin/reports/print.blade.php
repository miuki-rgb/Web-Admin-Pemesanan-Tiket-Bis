<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { margin-bottom: 20px; }
        .total { margin-top: 20px; font-weight: bold; text-align: right; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h1>Revenue Report</h1>
        <p>Period: {{ $startDate }} to {{ $endDate }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Booking ID</th>
                <th>Customer</th>
                <th>Route</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                <td>#{{ $booking->id }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->schedule->route->origin }} -> {{ $booking->schedule->route->destination }}</td>
                <td>${{ $booking->total_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Revenue: ${{ number_format($totalRevenue, 2) }}
    </div>
</body>
</html>
