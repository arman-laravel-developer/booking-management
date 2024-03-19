@extends('front.master')

@section('body')
    <!-- Hostel Cards Section -->
    <section class="hostel-cards">
        <div class="container">
            <div class="row">
                @foreach($hostels as $hostel)
                <div class="col-md-3 mb-4 mt-4">
                    <div class="card h-100">
                        <a href="{{route('hostel.details', ['id' => $hostel->id])}}"><img src="{{asset($hostel->image)}}" class="card-img-top" style="height: 250px;" alt="Hostel 1"></a>
                        <div class="card-body">
                            <a href="{{route('hostel.details', ['id' => $hostel->id])}}" style="text-decoration: none"><h5 class="card-title">{{$hostel->hostel_name}}</h5></a>
                            <p class="card-text">Fare: ${{$hostel->price}}/night</p>
                            <p class="card-text">Location: {{$hostel->location}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
