<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $profile = Profile::where('user_id', Auth::user()->id)->firstOrFail();
        $user = Auth::user();

        return view('admin.dashboard', compact('profile', 'user'));
    }
}
