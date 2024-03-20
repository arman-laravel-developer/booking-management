@extends('front.master')

@section('body')
    <!-- Hotel Detail -->
    <section class="hotel-detail mb-5 mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset($hostel->image)}}" style="height: 400px" class="img-fluid" alt="Hotel Image">
                    <hr>
                    <p><b>Description:</b> {{$hostel->description}}</p>
                </div>
                <div class="col-md-6">
                    <h2>{{$hostel->hostel_name}}</h2>
                    <hr>
                    <p><b>Single Room Available : </b>{{$hostel->single_room}} room</p>
                    <p><b>Double Room Available : </b>{{$hostel->double_room}} room</p>
                    <h3>Book Your Stay</h3>
                    <form action="{{route('booking.hostel')}}" id="bookingForm" method="POST" enctype="multipart/form-data" onsubmit="return validateSession()">
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
                            <label>Number of Adult:</label>
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
                        <button type="button" id="submitButton" class="btn btn-primary">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('submitButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Check if user is logged in
            var userId = '{{ Session::get('user_id') }}';
            if (!userId) {
                alert('Please login or register first.');
                return;
            }

            // If user is logged in, submit the form
            document.getElementById('bookingForm').submit();
        });
    </script>

@endsection
