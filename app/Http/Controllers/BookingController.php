<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Session;

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


        $data['url'] = $url;
        $data['name'] = $request->first_name.' '.$request->middle_name.' '.$request->last_name;
        $data['email'] = $request->email;
        $data['title'] = 'Email Verification';
        
        Mail::send('emails.emailVerification', ['data' => $data], function ($message) use ($data){
            $message->to($data['email'])->subject($data['title']);
        });
        flash()->error('Booking Successfull','Your booking has been successfull');
        return redirect()->back();
    }
}
