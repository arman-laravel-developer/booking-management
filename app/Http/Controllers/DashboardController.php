<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.home.index');
    }

    public function booking()
    {
        $bookings = Booking::orderBy('id', 'desc')->get();
        return view('admin.booking.manage', [
            'bookings' => $bookings
        ]);
    }

    public function show($id)
    {
        return view('admin.booking.show');
    }
}
