<?php

namespace App\Http\Controllers\store;

use Illuminate\Http\Request;
use App\Models\store\Wishlist;
use App\Http\Controllers\Controller;
use App\Http\Requests\store\WishlistRequest;

class WishlistController extends Controller
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
    public function store(WishlistRequest $request)
    {
        $addbook = Wishlist::create($request->validated());

        return response()->json([
            'message'=>'Book added to wishlist successfully!',
            'wishlist'=>$addbook
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
