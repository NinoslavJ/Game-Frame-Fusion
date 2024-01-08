@extends('auth.layouts')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Cart</h2>
            @if($cartItems->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Action</th> <!-- New column for delete action -->
                            <!-- Add other columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <form action="{{ route('removeItem', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                                <!-- Display other item details -->
                            </tr>
                            @php $total += $item->price; @endphp
                        @endforeach
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>{{ $total }}</strong></td>
                            <td></td> <!-- Empty column for alignment -->
                            <!-- Display total -->
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
            @else
                <p>Your cart is empty.</p>
            @endif
        </div>
    </div>
</div>
@endsection
