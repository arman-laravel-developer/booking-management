<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class HostelController extends Controller
{
    public function getImageUrl($request)
    {
        $name = Str::slug($request->hostel_name);
        $image = $request->file('image');
        $imageName = $name.'-'.'image'.'-'.time().'.'.$image->getClientOriginalExtension();
        $directory = 'Hostel/images/';
        $image->move($directory,$imageName);
        $imageUrl = $directory.$imageName;
        return $imageUrl;
    }

    public function index()
    {
        return view('admin.hostel.index');
    }
    public function create(Request $request)
    {
        $hostel = new Hostel();
        $hostel->hostel_name = $request->hostel_name;
        $hostel->location = $request->location;
        $hostel->price = $request->price;
        $hostel->description = $request->description;
        $hostel->room_availability = $request->single_room + $request->double_room;
        $hostel->single_room = $request->single_room;
        $hostel->double_room = $request->double_room;
        if ($request->file('image'))
        {
            $hostel->image = $this->getImageUrl($request);
        }
        if ($request->status == 1)
        {
            $hostel->status = $request->status;
        }
        else
        {
            $hostel->status = 2;
        }
        $hostel->save();
        Alert::success('Hostel Added Successfully', '');
        return redirect()->back();
    }

    public function manage()
    {
        $hostels = Hostel::orderBy('id', 'asc')->get();
        return view('admin.hostel.manage', compact('hostels'));
    }

    public function edit($id)
    {
        $hostel = Hostel::find($id);
        return view('admin.hostel.edit', compact('hostel'));
    }

    public function update(Request $request, $id)
    {
        $hostel = Hostel::find($id);
        $hostel->hostel_name = $request->hostel_name;
        $hostel->location = $request->location;
        $hostel->price = $request->price;
        $hostel->description = $request->description;
        $hostel->room_availability = $request->single_room + $request->double_room;
        $hostel->single_room = $request->single_room;
        $hostel->double_room = $request->double_room;
        if ($request->file('image'))
        {
            if (file_exists($hostel->image))
            {
                unlink($hostel->image);
            }
            $imageUrl = $this->getImageUrl($request);
        }
        else
        {
            $imageUrl = $hostel->image;
        }
        $hostel->image = $imageUrl;
        if ($request->status == 1)
        {
            $hostel->status = $request->status;
        }
        else
        {
            $hostel->status = 2;
        }
        $hostel->save();
        Alert::success('Hostel Update Successfully', '');
        return redirect()->route('hostel.manage');
    }

    public function delete($id)
    {
        $hostel = Hostel::find($id);
        if (file_exists($hostel->image))
        {
            unlink($hostel->image);
        }
        $hostel->delete();
        Alert::success('Hostel delete Successfully', '');
        return redirect()->back();
    }
}
