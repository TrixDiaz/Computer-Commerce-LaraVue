<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Process the e-wallet payment using PayMongo.
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'totalPrice' => 'required|numeric|min:0',
        ]);

        $items = $request->items;
        $total = $request->totalPrice;

        $lineItems = array_map(function ($item) {
            return [
                'currency' => 'PHP',
                'amount' => $item['price'] * 100,
                'description' => $item['name'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
            ];
        }, $items);

        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => $lineItems,
                    'payment_method_types' => ['gcash'],
                    'success_url' => route('catalog.index'),
                    'cancel_url' => route('welcome'),
                    'description' => 'Payment for Cart Items',
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode('sk_test_YKYL2xZeeQD6cgWXZBXgWGUN:'),
            'Content-Type' => 'application/json',
        ])->post('https://api.paymongo.com/v1/checkout_sessions', $data);

        if ($response->successful()) {
            $checkoutSession = $response->json()['data'];
            return response()->json([
                'success' => true,
                'message' => 'E-wallet payment session created successfully',
                'checkout_url' => $checkoutSession['attributes']['checkout_url'],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create e-wallet payment session',
                'error' => $response->json()['errors'] ?? 'Unknown error',
            ], 400);
        }
    }
}
