@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Orders</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Payment ID</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>₹{{ $order->total_amount }}</td>
                    <td>{{ $order->razorpay_payment_id }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
