<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            // Check if the customer is authenticated
            $customer = Auth::guard('sanctum')->user();

            if (!$customer) {
                throw new AuthorizationException('Unauthenticated');
            }

            $cartItem = $customer->cart()->create([
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity'),
                'amount' => $request->input('amount'),
            ]);

            return response()->json(['message' => 'Item added to cart', 'cart_item' => $cartItem]);
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cartItem = $user->cart()->findOrFail($id);
        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return response()->json(['message' => 'Cart item updated', 'cart_item' => $cartItem]);
    }

    public function removeFromCart($id)
    {
        $user = Auth::user();
        $cartItem = $user->cart()->findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Cart item removed']);
    }


    public function index($customer_id)
    {
        try {
            // Retrieve the customer along with their cart items and associated products
            $customer = Customer::with('cart.product')->findOrFail($customer_id);

            return response()->json(['customer' => $customer]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

}
