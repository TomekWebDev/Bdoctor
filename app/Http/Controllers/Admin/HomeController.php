<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Message;
use App\Models\Profile;
use App\Models\ProfileRating;
use App\Models\ProfileSponsor;
use App\Models\Rating;
use App\Models\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    public function index()
    {

        $profile = Profile::where('user_id', Auth::user()->id)->firstOrFail();
        $user = Auth::user();

        $reviews = Review::where('profile_id', Auth::user()->id)->get();
        if (count($reviews) > 0) {
            $review = count($reviews);
        } else {
            $review = 'Non hai ancora ricevuto recensioni';
        }

        $ratings = ProfileRating::where('profile_id', Auth::user()->id)->get();
        if (count($ratings) > 0) {
            $rating = count($ratings);
        } else {
            $rating = 'Non hai ancora ricevuto rating';
        }

        $messages = Message::where('profile_id', Auth::user()->id)->get();
        if (count($messages) > 0) {
            $message = count($messages);
        } else {
            $message = 'Non hai ancora ricevuto messaggi';
        }

        $expiration = ProfileSponsor::where('profile_id', Auth::user()->id)->pluck('expiration_date')->last();
        //  Converti la data di scadenza in un oggetto Carbon
        $expiration_now = Carbon::now();



        if (Carbon::parse($expiration) < $expiration_now) {
            $expirationS = 'La sponsorizzazione del tuo profilo è scaduta';
        } else if (is_null($expiration)) {
            $expirationS = 'Il tuo profilo non è sponsorizzato';
        } else {
            $expirationS = date('d M Y - g:i A', strtotime($expiration));
        }

        return view('admin.dashboard', compact('profile', 'user', 'review', 'rating', 'message', 'expiration', 'expirationS'));
    }
}
