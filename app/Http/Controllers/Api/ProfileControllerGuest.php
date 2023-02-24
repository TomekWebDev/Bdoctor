<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Spec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileControllerGuest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Step 1
        // Questa funzione di index ci serve per mandare il json delle specs
        // alla homepage per averle nella select
        // vai a homepage vue per step 2
        $specs = Spec::all();
        return response()->json($specs);
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function indexAll()
    // {
    //     // Step 1
    //     // Questa funzione di index ci serve per mandare il json delle specs
    //     // alla homepage per averle nella select
    //     // vai a homepage vue per step 2
    //     $profiles = Profile::with('specs', 'user', 'ratings', 'reviews');
    //     return response()->json($profiles);
    // }

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

        // Step 6
        // Salviamo in una var il dato


        $specId = $request->input('spec');
        $reviewFilter = $request->input('reviewFilter');
        $ratingFilter = $request->input('ratingFilter');

        //Step 6
        // Interrogazione database dei profili con associate le spec e lo user
        // ->whereHas dove ha una relazione specs (valore tra apici) dentro questa relazione "cerchiamo"
        // con una funzione che come parametro ha $query (builder instance di Eloquent) che permette di aggiungere vincoli
        // alla ricerca nel db.
        // use ($specId) permette alla $query di usare la variabile appena passata dal metodo post.
        // In questo modo possiamo usare un metodo where su $query  che va a pescare tabella specs e colonna id (specs.id) e la associa
        // alla variabile $specId appena passata.
        // A questo punto il return della funzione passa il secondo parametro dicendo esattamente qual'è l'id della spec che stiamo cercando.
        // In questo modo cerchiamo i profili che abbiano una relazione a spec e che abbiano una spec con l'id che abbiamo cercato.







        $profiles = Profile::with(['specs', 'user', 'ratings', 'reviews', 'sponsors'])
            ->whereHas('specs', function ($query) use ($specId) {
                $query->where('specs.id', $specId);
            })
            ->whereHas('reviews', function ($query) use ($reviewFilter) {
                $query->select('profile_id')
                    ->groupBy('profile_id')
                    ->havingRaw('COUNT(*) > ?', [$reviewFilter]);
            })
            // ->select('profiles.*', DB::raw('AVG(ratings.vote) as avg_rating'))
            // ->join('profile_rating', 'profiles.id', '=', 'profile_rating.profile_id')
            // ->join('ratings', 'profile_rating.rating_id', '=', 'ratings.id')
            // ->groupBy('profiles.id')
            // ->havingRaw('AVG(ratings.vote) >= ?', [$ratingFilter])
            ->get();


        // metodo non server

        // $profiles = array_filter($profiless, function ($profile) use ($ratingFilter) {
        //     $totalRating = 0;
        //     $ratingCount = count($profile->ratings);
        //     foreach ($profile->ratings as $rating) {
        //         $totalRating += $rating->vote;
        //     }
        //     $averageRating = $totalRating / $ratingCount;
        //     if ($averageRating >= $ratingFilter) {
        //         return true;
        //     }
        // });





        $specs = Spec::all();

        $data = [
            'profiles' => $profiles,
            'specs' => $specs,

        ];

        // Step 7
        // A questo punto senza dover fare un'altra chiamata get dal nostro componente vue, approfittiamo della response
        // della chiamata post per passare il json dei profili che abbiamo cercato con quei vincoli.

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this_profile = Profile::with('specs', 'user')->find($id);
        if (!$this_profile) return response('profilo non trovato', 404);

        return response()->json($this_profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexSponsored(Request $request)
    {
        $profiles = Profile::with('specs', 'user', 'ratings', 'reviews', 'sponsors')->get();
        return response()->json($profiles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filters(Request $request, $id)
    {
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
