<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:customers',
            'phone' => 'required',
            'email' => 'nullable|email|unique:customers',
            'password' => 'required|min:6',
        ]);

        $customer = Customer::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate a token for the newly registered customer
        $tokenResult = $customer->createToken('auth_token');

        // Extract the token from the token result
        $token = $tokenResult->plainTextToken;

        // Return the response with the token
        return response()->json([
            'message' => 'Customer registered successfully',
            'customer' => $customer,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            $user = Auth::guard('customer')->user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user]);
        }

        // If authentication fails due to incorrect credentials
        $customerExists = Customer::where('phone', $request->phone)->exists();
        $errorMessage = $customerExists ? 'Incorrect password' : 'Phone number not found';

        return response()->json(['message' => $errorMessage], 401);
    }





}
