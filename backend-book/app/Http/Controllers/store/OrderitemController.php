<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Http\Requests\store\OrderitemRequest;
use App\Http\Requests\store\OrderRequest;
use App\Models\store\Orderitem;
use Illuminate\Http\Request;

class OrderitemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(OrderitemRequest $request)
    {
        $orderItems=Orderitem::create($request->validated());

        return response()->json([
            'message'=>"Order item added succesufully",
            'order_item'=>$orderItems
        ],201);
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
}
