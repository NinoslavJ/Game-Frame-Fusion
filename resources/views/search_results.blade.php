@extends('auth.layouts')

@section('content')
    <div class="container">
        <h2>Search Results for "{{ $query }}"</h2>

        @if ($searchResults->isEmpty())
            <p>No results found</p>
        @else
            <div class="row">
                @foreach ($searchResults as $result)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <!-- Item image -->
                            <img src="{{ $result->picture }}" class="card-img-top" alt="{{ $result->name }}">

                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Item name -->
                                <h5 class="card-title">{{ $result->name }}</h5>
                                
                                <!-- Item price -->
                                <p class="card-text">Price: ${{ $result->price }}</p>
                                
                                <!-- Button to add item to cart -->
                                <form action="{{ route('addToCart', ['id' => $result->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
