<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
        ]);

        // Extract customer details from the request
        $customerName = $request->input('customer_name');
        $customerId = $request->input('customer_id');
        $customerPhone = $request->input('customer_phone');
        $customerDistrict = $request->input('customer_district');
        $customerThana = $request->input('customer_thana');
        $customerAddress = $request->input('address');
        $totalAmount = $request->input('total_amount');

        // Create the order
        $order = Order::create([
            'customer_name' => $customerName,
            'customer_id' => $customerId,
            'customer_phone' => $customerPhone,
            'customer_district' => $customerDistrict,
            'customer_thana' => $customerThana,
            'total_amount' => $totalAmount,
            'address' => $customerAddress,
        ]);

        foreach ($request->input('order_items') as $itemData) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $itemData['product_name'],
                'image' => $itemData['image'],
                'quantity' => $itemData['quantity'],
                'amount' => $itemData['amount'],
            ]);
        }

        return response()->json(['message' => 'Order created successfully', 'order' => $order]);
    }



    // public function getOrder($customer_id)
    // {
    //     try {
    //         // Retrieve the order along with its items and associated customer
    //         $order = Order::with('orderItems', 'customer')->findOrFail($customer_id);

    //         return response()->json(['order' => $order]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Order not found'], 404);
    //     }

    // }
    public function getOrdersByCustomer($customer_id)
    {
        $orders = Order::where('customer_id', $customer_id)->get();
        $formattedOrders = [];
        foreach ($orders as $order) {
            $orderData = [
                'order' => $order,
                'order_items' => OrderItem::where('order_id', $order->id)->get(),
            ];
            array_push($formattedOrders, $orderData);
        }
        return response()->json(['orders' => $formattedOrders]);
    }



}
