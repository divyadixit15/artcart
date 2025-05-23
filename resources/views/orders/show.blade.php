@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }}</h1>
    <p><strong>User:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>Total:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
    <p><strong>Payment ID:</strong> {{ $order->razorpay_payment_id }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

    <h3>Items:</h3>
    @if ($order->items->count() > 0)
        <ul>
            @foreach ($order->items as $item)
                <li>
                    {{ $item->product->name ?? 'Product not found' }} - 
                    Quantity: {{ $item->quantity }} - 
                    ₹{{ number_format($item->price, 2) }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No items found in this order.</p>
    @endif
</div>
@endsection
