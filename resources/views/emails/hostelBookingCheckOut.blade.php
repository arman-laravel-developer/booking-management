<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }}</title>
</head>
<body>
<h2>{{ $data['title'] }}</h2>
<p>Dear {{ $data['customer_name'] }},</p>
<p>Your booking for {{ $data['hostel_name'] }} has been confirmed.</p>
<p>Booking Details:</p>
<ul>
    <li>Check-in Date: {{ $data['check_in_date'] }}</li>
    <li>Check-out Date: {{ $data['check_out_date'] }}</li>
    <li>Room Type: {{ $data['room_type'] }}</li>
    <li>Adults: {{ $data['adult_count'] }}</li>
    <li>Children: {{ $data['child_count'] }}</li>
    <li>Status: {{ $data['booking_status'] }}</li>
</ul>
<p>Thank you for choosing us!</p>
</body>
</html>
