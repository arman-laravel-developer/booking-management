<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Session;
use Mail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $booking = new Booking();
        $booking->hostel_id = $request->hostel_id;
        $booking->customer_id = Session::get('user_id');
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->room_type = $request->room_type;
        $booking->adult_count = $request->adult_count;
        $booking->child_count = $request->child_count;
        $booking->save();


        $data['hostel_name'] = $booking->hostel->hostel_name;
        $data['customer_name'] = $booking->customer->name;
        $data['customer_email'] = $booking->customer->email;
        $data['check_in_date'] = $request->check_in_date;
        $data['check_out_date'] = $request->check_out_date;
        $data['room_type'] = $request->room_type;
        $data['adult_count'] = $request->adult_count;
        $data['child_count'] = $request->child_count;
        $data['booking_status'] = 'Pending';
        $data['title'] = 'Hostel Booking Confirmation';

        Mail::send('emails.hostelBookingConfirmation', ['data' => $data], function ($message) use ($data){
            $message->to($data['customer_email'])->subject($data['title']);
        });
        flash()->success('Booking Successfull','Your booking has been successfull.');
        return redirect()->back();
    }
}
