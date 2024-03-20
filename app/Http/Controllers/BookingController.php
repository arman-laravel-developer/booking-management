<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hostel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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

    public function checkIn($id)
    {
        $booking = Booking::find($id);
        $booking->booking_status = 'Approved';
        $booking->save();

        $hostel = Hostel::find($booking->hostel_id);

        switch ($booking->room_type) {
            case 'single':
                $hostel->single_room--;
                break;
            case 'double':
                $hostel->double_room--;
                break;
        }


        $hostel->room_availability--;
        $hostel->save();

        $data['hostel_name'] = $booking->hostel->hostel_name;
        $data['customer_name'] = $booking->customer->name;
        $data['customer_email'] = $booking->customer->email;
        $data['check_in_date'] = $booking->check_in_date;
        $data['check_out_date'] = $booking->check_out_date;
        $data['room_type'] = $booking->room_type;
        $data['adult_count'] = $booking->adult_count;
        $data['child_count'] = $booking->child_count;
        $data['booking_status'] = 'CheckIN Approved';
        $data['title'] = 'Hostel Booking CheckIn Confirmation';

        Mail::send('emails.hostelBookingCheckIn', ['data' => $data], function ($message) use ($data){
            $message->to($data['customer_email'])->subject($data['title']);
        });
        Alert::success('Booking Check-in Successfully', '');
        return redirect()->back();
    }


    public function cancel($id)
    {
        $booking = Booking::find($id);
        $booking->booking_status = 'Cancel';
        $booking->save();

        Alert::success('Booking Cancel Successfully', '');
        return redirect()->back();
    }

    public function delete($id)
    {
        $booking = Booking::find($id);
        $booking->delete();

        Alert::success('Booking Delete Successfully', '');
        return redirect()->back();
    }

    public function checkOut($id)
    {
        $booking = Booking::find($id);
        $booking->booking_status = 'CheckOut';
        $booking->save();

        $hostel = Hostel::find($booking->hostel_id);

        switch ($booking->room_type) {
            case 'single':
                $hostel->single_room++;
                break;
            case 'double':
                $hostel->double_room++;
                break;
        }


        $hostel->room_availability++;
        $hostel->save();
        
        $data['hostel_name'] = $booking->hostel->hostel_name;
        $data['customer_name'] = $booking->customer->name;
        $data['customer_email'] = $booking->customer->email;
        $data['check_in_date'] = $booking->check_in_date;
        $data['check_out_date'] = $booking->check_out_date;
        $data['room_type'] = $booking->room_type;
        $data['adult_count'] = $booking->adult_count;
        $data['child_count'] = $booking->child_count;
        $data['booking_status'] = 'CheckOut Approved';
        $data['title'] = 'Hostel Booking CheckOut Confirmation';

        Mail::send('emails.hostelBookingCheckOut', ['data' => $data], function ($message) use ($data){
            $message->to($data['customer_email'])->subject($data['title']);
        });
        Alert::success('Booking CheckOut Successfully', '');
        return redirect()->back();
    }


}
