<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Promotion;
use Illuminate\Support\Facades\Log;




class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = \App\Models\Promotion::all();
        return view('business.promotions.index', ['promotions' => $promotions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('business.promotions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_service_name' => 'required|string|max:255',
            'target_audience' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $promotion = new Promotion;
        $promotion->user_id = Auth::id();
        $promotion->product_service_name = $request->product_service_name;
        $promotion->target_audience = $request->target_audience;
        $promotion->description = $request->description;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->discount_amount = $request->discount_amount;
        $promotion->save();

        return redirect()->route('business.dashboard')->with('success', 'Promotion created successfully!');
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
        $promotion = Promotion::where('promotion_id', $id)->firstOrFail();
        return view('business.promotions.edit', ['promotion' => $promotion]);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $promotion_id)
    {

        $request->validate([
            'product_service_name' => 'required|string|max:255',
            'target_audience' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'discount_amount' => 'required|numeric' // corrected from 'discount' to 'discount_amount'
        ]);

        // Fetch the promotion from the database
        $promotion = Promotion::where('promotion_id', $promotion_id)->firstOrFail();


        if ($promotion) {
            DB::table('promotions')
                ->where('promotion_id', $promotion_id)
                ->update([
                    'product_service_name' => $request->input('product_service_name'),
                    'target_audience' => $request->input('target_audience'),
                    'description' => $request->input('description'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'discount_amount' => $request->input('discount_amount')
                ]);
        }



        return redirect()->back()->with('success', 'Promotion updated successfully.'); // Redirect back with a success message 
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($promotion_id)
    {

        $promotion = Promotion::where('promotion_id', $promotion_id)->firstOrFail();

        // Logging the attempt
        Log::info('Fetched promotion details: ' . json_encode($promotion));

        // Ensure that the promotion belongs to the authenticated user
        if ($promotion->user_id == Auth::id()) {

            // Had to access the table directly because deleting the model was not deleting it from the database
            DB::table('promotions')
                ->where('promotion_id', $promotion_id)
                ->delete();


            return response()->json(['success' => true, 'message' => 'Promotion Deleted']);
        } else {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.']);
        }
    }




}