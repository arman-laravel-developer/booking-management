@extends('admin.master')
@section('title')
    Booking Details | Hotel Management System
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="mdi mdi-calendar-range font-13"></i>
                            </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Booking Details</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Booking Information</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive table-hover">
                        <tr>
                            <th style="width: 33%">Hostel Name:</th>
                            <td>{{$booking->hostel->hostel_name}}</td>
                        </tr>
                        <tr>
                            <th style="width: 33%">Room Type :</th>
                            <td>{{\Illuminate\Support\Str::ucfirst($booking->room_type)}}</td>
                        </tr>
                        <tr>
                            <th style="width: 33%">Number of Adult :</th>
                            <td>{{$booking->adult_count}}</td>
                        </tr>
                        <tr>
                            <th style="width: 33%">Number of Child :</th>
                            <td>{{$booking->child_count}}</td>
                        </tr>
                        <tr>
                            <th style="width: 33%">booking Status :</th>
                            <td>{{\Illuminate\Support\Str::ucfirst($booking->booking_status)}}</td>
                        </tr>
                    </table>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Guest Information</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive table-hover">
                        <tr>
                            <th style="width: 30%">Guest Name:</th>
                            <td>{{$booking->customer->name}}</td>
                        </tr>
                        <tr>
                            <th style="width: 30%">Guest Email :</th>
                            <td>{{$booking->customer->email}}</td>
                        </tr>
                        <tr>
                            <th style="width: 30%">User Name :</th>
                            <td>{{$booking->customer->username}}</td>
                        </tr>
                    </table>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
            <div class="card">
                <div class="card-body">
                    <p><b>Room Available: {{$booking->hostel->room_availability}}</b></p>
                </div>
                <div class="card-footer" style="margin-top: -18px">
                    @if($booking->booking_status == 'Pending')
                        <a href="{{route('booking.checkId-approved', ['id' => $booking->id])}}" class="btn btn-success">Check In Approved</a>
                        <a href="{{route('booking.cancel', ['id' => $booking->id])}}" class="btn btn-danger">Cancel</a>
                    @elseif($booking->booking_status == 'Approved')
                        <a href="{{route('booking.checkOut-approved', ['id' => $booking->id])}}" class="btn btn-primary">Check Out Approved</a>
                        <br>
                        <small class="text-danger mt-1">Note: Please CheckOut Approved For Guest CheckOut From Hostel</small>
                    @else
                        <a href="{{route('booking.delete', ['id' => $booking->id])}}" class="btn btn-danger">Delete</a>
                    @endif
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>




@endsection



