@extends('auth.layouts')

@section('content')
<!-- Your checkout.blade.php -->

<!-- Display items and total amount -->
@foreach($cartItems as $item)
    <!-- Display item details -->
@endforeach

<!-- Display total -->
<p>Total: {{ $total }}</p>

<!-- Form to make an order -->
<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <input type="hidden" name="items" value="{{ $cartItems }}">
    <input type="hidden" name="total" value="{{ $total }}">
    <button type="submit" class="btn btn-success">Make Order</button>
</form>

@endsection