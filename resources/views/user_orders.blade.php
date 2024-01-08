@extends('auth.layouts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Your Orders</h1>
            @foreach ($orders as $order)
                <h5>Order ID: {{ $order['order_id'] }}</h5>

                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($order['items'] as $item)
                        <div class="col">
                            <div class="card">
                                <img src="{{ $item['picture'] }}" class="card-img-top" alt="{{ $item['name'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item['name'] }}</h5>
                                    <p class="card-text">Price: ${{ $item['price'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
