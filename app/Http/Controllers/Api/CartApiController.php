<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartApiController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);
    
        $userId = 1; 
    
        $cart = Cart::firstOrCreate(['user_id' => $userId]);
    
        $item = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );

        return response()->json(['message' => 'Added to cart', 'item' => $item]);
    }

    public function updateCartItem(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $item = CartItem::findOrFail($id);
        $item->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart item updated']);
    }

    public function removeCartItem($id)
    {
        CartItem::findOrFail($id)->delete();
        return response()->json(['message' => 'Item removed']);
    }

    public function viewCart()
    {
        $userId = 1;
        $cart = \App\Models\Cart::with('items.product')->where('user_id', $userId)->first();
    
        $total = 0;
        if ($cart) {
            foreach ($cart->items as $item) {
                $total += $item->quantity * $item->product->price;
            }
        }
    
        return response()->json([
            'cartItems' => $cart ? $cart->items : [],
            'total' => $total,
        ]);
    }
    public function createOrder(Request $request)
    {
        $userId = 1; 

        $cart = Cart::with('items.product')->where('user_id', $userId)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }
    
        $totalAmountRupees = 0;
        foreach ($cart->items as $item) {
            $totalAmountRupees += $item->quantity * $item->product->price;
        }
        $orderAmountPaise = intval($totalAmountRupees * 100);
    
        try {
            $api = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));
    
            $razorpayOrder = $api->order->create([
                'receipt' => 'order_rcptid_' . $cart->id,
                'amount' => $orderAmountPaise,
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Could not create Razorpay order',
                'error' => $e->getMessage(),
            ], 500);
        }
    
        return response()->json([
            'orderId' => $razorpayOrder['id'],
            'amount' => $totalAmountRupees,
            'currency' => 'INR',
            'key' => config('services.razorpay.key_id'),
        ]);
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
            'order_id' => 'required|string',
            'signature' => 'required|string',
        ]);

        $userId = 1; 

        $api = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));

        $attributes = [
            'razorpay_order_id' => $request->order_id,
            'razorpay_payment_id' => $request->payment_id,
            'razorpay_signature' => $request->signature,
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);

            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart) {
                return response()->json(['message' => 'Cart not found'], 404);
            }

            $cart->razorpay_payment_id = $request->payment_id;
            $cart->save();

        
            $cart->items()->delete();

            return response()->json(['message' => 'Payment recorded successfully']);

        } catch (Exception $e) {
            return response()->json(['message' => 'Payment verification failed', 'error' => $e->getMessage()], 400);
        }
    }

    public function verifyPayment(Request $request)
    {
        $user = 1;
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $api = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));

        $attributes = [
            'razorpay_order_id' => $request->order_id,
            'razorpay_payment_id' => $request->payment_id,
            'razorpay_signature' => $request->signature,
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);

            $totalAmount = $request->total_amount; 

            $order = Order::create([
                'user_id' => 1,
                'total_amount' => $totalAmount,
                'razorpay_payment_id' => $request->payment_id,
                'status' => 'paid',
            ]);

            
            $cartItems = $request->cart_items; 
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            return response()->json(['message' => 'Payment verified and order saved successfully']);

        } catch (Exception $e) {
            return response()->json(['message' => 'Payment verification failed: ' . $e->getMessage()], 400);
        }
    }
}
