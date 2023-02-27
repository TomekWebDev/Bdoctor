<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Profile;
use App\Models\ProfileRating;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $profile = Profile::where('user_id', Auth::user()->id)->with('messages', 'reviews')->firstOrFail();
        $user = Auth::user();

        $user_id = Auth::user()->id;
                
        $results = Message::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, count(*) as total'))
                ->where('profile_id', $user_id)
                ->groupBy('year', 'month')
                ->get();
        
        $reviews = Review::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, count(*) as total'))
                ->where('profile_id', $user_id)
                ->groupBy('year', 'month')
                ->get();
        
        $votes = ProfileRating::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, rating_id, COUNT(*) as total'))
                ->where('profile_id', $user_id)
                ->groupBy('year', 'month', 'rating_id')
                ->get();
        
        // $month = 2; // Numero del mese di cui si vuole recuperare la somma dei voti (2 = febbraio)

        // $votes = Profile::where('user_id', $user_id)
        //     ->whereMonth('created_at', $month)
        //     ->withCount([
        //         'ratings as ratings_sum' => function ($query) {
        //             $query->selectRaw('coalesce(sum(vote), 0)');
        //         }
        //     ])
        //     ->first();

        $data = [
            'profile' => $profile,
            'user' => $user,
            'results' => $results,
            'reviews' => $reviews,
            'votes' => $votes,
        ];


        return view('admin.statistics.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
