<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileSponsor;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bronze = Sponsor::whereId(1)->first();
        $silver = Sponsor::whereId(2)->first();
        $gold = Sponsor::whereId(3)->first();
        $profile = Auth::user();

        $test = Carbon::now();
        $test2 = ProfileSponsor::where('profile_id', Auth::user()->id)->pluck('expiration_date')->last();

        return view('admin.sponsors.index', compact('bronze', 'silver', 'gold', 'profile', 'test', 'test2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function token($type)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();
        $subscription = Sponsor::where('name', $type)->first();
        return view('admin.sponsors.braintree', ['token' => $token, 'type' => $subscription]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request, $price)
    {
        $profile_id = Auth::user()->id;

        $last_expiration_date = date(ProfileSponsor::where('profile_id', Auth::user()->id)->pluck('expiration_date')->last());

        $sponsor = Sponsor::where('price', $price)->first();
        $sponsor_id = $sponsor->id;

        if ($price == 2.99) {
            if ($last_expiration_date > Carbon::now()) {
                $expiration_date = Carbon::parse($last_expiration_date)->addDays(1);
            } else {
                $expiration_date = Carbon::now()->addDays(1);
            }
        } elseif ($price == 5.99) {
            if ($last_expiration_date > Carbon::now()) {
                $expiration_date = Carbon::parse($last_expiration_date)->addDays(2);
            } else {
                $expiration_date = Carbon::now()->addDays(2);
            }
        } else {
            if ($last_expiration_date > Carbon::now()) {
                $expiration_date = Carbon::parse($last_expiration_date)->addDays(3);
            } else {
                $expiration_date = Carbon::now()->addDays(3);
            }
        }
        $pivot = new ProfileSponsor;
        $pivot->sponsor_id = $sponsor_id;
        $pivot->profile_id = $profile_id;
        $pivot->timestamps = false;
        $pivot->expiration_date = $expiration_date;
        $pivot->save();

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = $price;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return back()->with('success', 'Ordine confermato');
        } else {
            return back()->with('error', 'Ordine rifiutato ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
