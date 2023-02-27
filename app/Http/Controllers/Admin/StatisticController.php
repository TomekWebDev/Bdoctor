<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Profile;
use App\Models\ProfileRating;
use App\Models\Rating;
use App\Models\Review;
use Carbon\Carbon;
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



        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $voti = DB::table('profiles')
            ->join('profile_rating', 'profiles.id', '=', 'profile_rating.profile_id')
            ->join('ratings', 'profile_rating.rating_id', '=', 'ratings.id')
            ->selectRaw('profiles.id, YEAR(profile_rating.created_at) as year, MONTH(profile_rating.created_at) as month, ratings.vote, COUNT(*) as count')
            ->where('profiles.user_id', '=', auth()->user()->id)
            ->whereYear('profile_rating.created_at', '=', $year)
            ->whereMonth('profile_rating.created_at', '=', $month)
            ->groupBy('profiles.id', 'year', 'month', 'ratings.vote')
            ->get();



        $data = [
            'profile' => $profile,
            'user' => $user,
            'results' => $results,
            'reviews' => $reviews,
            // 'votes' => $votes,
            'voti' => $voti
        ];


        return view('admin.statistics.index', $data);
    }


    public function setMonth($selectedMonth)
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

        $month = $selectedMonth;
        $year = 2023;


        $voti = DB::table('profiles')
            ->join('profile_rating', 'profiles.id', '=', 'profile_rating.profile_id')
            ->join('ratings', 'profile_rating.rating_id', '=', 'ratings.id')
            ->selectRaw('profiles.id, YEAR(profile_rating.created_at) as year, MONTH(profile_rating.created_at) as month, ratings.vote, COUNT(*) as count')
            ->where('profiles.user_id', '=', auth()->user()->id)
            ->whereYear('profile_rating.created_at', '=', $year)
            ->whereMonth('profile_rating.created_at', '=', $month)
            ->groupBy('profiles.id', 'year', 'month', 'ratings.vote')
            ->get();

        $data = [
            'profile' => $profile,
            'user' => $user,
            'results' => $results,
            'reviews' => $reviews,
            'voti' => $voti
        ];

        return view('admin.statistics.index', $data);
    }
}
