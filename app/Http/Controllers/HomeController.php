<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hostels = Hostel::where('status', 1)->get();
        return view('front.home.home', compact('hostels'));
    }

    public function details($id)
    {
        $hostel = Hostel::find($id);
        return view('front.hostel.details', compact('hostel'));
    }
}
