<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Product');
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
    public function show(Product $product)
    {
        return Inertia::render('Product', [
            'product' => ProductResource::make($product->load(['category', 'brand'])),
        ]);
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

    public function processGcashPayment(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($request->product_id);
        $total = $request->amount;

        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' => $total * 100,
                            'description' => $product->description,
                            'name' => $product->name,
                            'quantity' => 1,
                        ],
                    ],
                    'payment_method_types' => ['gcash'],
                    'success_url' => route('catalog.index'),
                    'cancel_url' => route('welcome'),
                    'description' => 'Payment for ' . $product->name,
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
                'message' => 'GCash payment session created successfully',
                'checkout_url' => $checkoutSession['attributes']['checkout_url'],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create GCash payment session',
                'error' => $response->json()['errors'] ?? 'Unknown error',
            ], 400);
        }
    }
}
