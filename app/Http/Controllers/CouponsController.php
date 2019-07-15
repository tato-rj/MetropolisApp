<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();

        return view('admin.pages.coupons.index', compact(['coupons']));
    }

    public function check(Request $request)
    {
        $coupon = Coupon::match($request->name);

        if ($coupon->exists())
            return $coupon->first()->status();

        return response()->json(['message' => 'Este coupon não existe.', 'status' => 'invalid']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expires_at = str_replace('/', '-', $request->expires_at);

        Coupon::create([
            'name' => strtoupper($request->name),
            'discount' => $request->discount,
            'limit' => $request->limit,
            'expires_at' => $expires_at ? carbon($expires_at)->setTime(23,59,59) : null
        ]);

        return redirect()->back()->with(['status', 'O coupon foi criado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->back()->with(['status' => 'O coupon foi removido com sucesso']);
    }
}
