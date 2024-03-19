@extends('front.master')

@section('body')
    <!-- Hotel Detail -->
    <section class="hotel-detail mb-5 mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="https://cdn.britannica.com/96/115096-050-5AFDAF5D/Bellagio-Hotel-Casino-Las-Vegas.jpg" class="img-fluid" alt="Hotel Image">
                    <hr>
                    <p><b>Description:</b> {{$hostel->description}}</p>
                </div>
                <div class="col-md-6">
                    <h2>{{$hostel->hostel_name}}</h2>
                    <hr>
                    <h3>Book Your Stay</h3>
                    <form action="{{route('booking.hostel')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="hostel_id" value="{{$hostel->id}}"/>
                        <div class="form-group">
                            <label for="checkInDate">Check-In Date:</label>
                            <input type="date" class="form-control" name="check_in_date" id="checkInDate" required>
                        </div>
                        <div class="form-group">
                            <label for="checkOutDate">Check-Out Date:</label>
                            <input type="date" class="form-control" name="check_out_date" id="checkOutDate" required>
                        </div>
                        <div class="form-group">
                            <label for="roomType">Room Type:</label>
                            <select class="form-control" name="room_type" id="roomType" required>
                                <option value="">Select Room Type</option>
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Number of Occupants:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="adultMinusBtn">-</button>
                                </div>
                                <input type="number" class="form-control" name="adult_count" id="adultCount" value="1" min="1" max="10" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="adultPlusBtn">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Number of Children:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="childMinusBtn">-</button>
                                </div>
                                <input type="number" class="form-control" name="child_count" id="childCount" value="0" min="0" max="10" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="childPlusBtn">+</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
