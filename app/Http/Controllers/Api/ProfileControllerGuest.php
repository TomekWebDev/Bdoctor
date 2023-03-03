<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Spec;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileControllerGuest extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     // Step 1
    //     // Questa funzione di index ci serve per mandare il json delle specs
    //     // alla homepage per averle nella select
    //     // vai a homepage vue per step 2
    //     $specs = Spec::all();

    //     $sponsoredProfiles = Profile::with(['specs', 'user', 'ratings', 'reviews', 'sponsors'])
    //         ->whereHas('sponsors', function ($query) {
    //             $query->where('expiration_date', '>', now());
    //         })
    //         ->get();

    //     $data = [
    //         'specs' => $specs,
    //         'sponsoredProfiles' => $sponsoredProfiles
    //     ];


    //     return response()->json($data);
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchProfilesBySpec(Request $request)
    {


        $profiles = Profile::with(['specs', 'user', 'ratings', 'reviews', 'sponsors']);

        if ($request->has('selectedSpecId')) {
            $selectedSpecId = $request->input('selectedSpecId');
            $profiles = $profiles->whereHas('specs', function ($query) use ($selectedSpecId) {
                $query->where('spec_id', $selectedSpecId);
            });
        }
        if ($request->has('reviewFilter')) {

            $reviewFilter = $request->input('reviewFilter');

            $profiles = $profiles->whereHas('reviews', function ($query) use ($reviewFilter) {
                $query->select('profile_id')->groupBy('profile_id')
                    ->havingRaw('COUNT(reviews.id) >= ?', [$reviewFilter]);
            });
        }
        if ($request->has('ratingFilter')) {
            $ratingFilter = $request->input('ratingFilter');
            $profiles = $profiles->select('profiles.*', DB::raw('AVG(ratings.vote) as avg_rating'))
                ->join('profile_rating', 'profiles.id', '=', 'profile_rating.profile_id')
                ->join('ratings', 'profile_rating.rating_id', '=', 'ratings.id')
                ->groupBy('profiles.id')
                ->havingRaw('AVG(ratings.vote) >= ?', [$ratingFilter]);
        }

        $profiles = $profiles->whereDoesntHave('sponsors', function ($query) {
            $query->where('expiration_date', '>', now());
        });

        $profiles = $profiles->get();

            // $selectedSpecId = "";
            // $reviewFilter = "";
            // $ratingFilter = '';
        ;
        return response()->json($profiles);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this_profile = Profile::with('specs', 'user', 'reviews', 'ratings')->find($id);
        if (!$this_profile) {
            return response('profilo non trovato', 404);
        }

        if ($this_profile->image) {
            $this_profile->image = url("storage/" . $this_profile->image);
        }

        if ($this_profile->resume) {
            $this_profile->resume = url("storage/" . $this_profile->resume);
        }

        $this_profile->name = $this_profile->user->name;
        $this_profile->surname = $this_profile->user->surname;

        return response()->json($this_profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSpecs(Request $request)
    {
        $specs = Spec::all();
        return response()->json($specs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllSponsored(Request $request)
    {
        $sponsoredProfiles = Profile::with(['specs', 'user', 'ratings', 'reviews', 'sponsors'])
            ->whereHas('sponsors', function ($query) {
                $query->where('expiration_date', '>', now());
            })
            ->get();
        return response()->json($sponsoredProfiles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSponsoredWithSpecs(Request $request)
    {
        $specId = $request->input('spec');

        $sponsoredProfiles = Profile::with(['specs', 'user', 'ratings', 'reviews', 'sponsors'])
            ->whereHas('specs', function ($query) use ($specId) {
                $query->where('specs.id', $specId);
            })
            ->whereHas('sponsors', function ($query) {
                $query->where('expiration_date', '>=', now());
            })
            ->get();


        return response()->json($sponsoredProfiles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function backup(Request $request)
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
            // ->whereHas('reviews', function ($query) use ($reviewFilter) {
            //     $query->select('profile_id')
            //         ->groupBy('profile_id')
            //         ->havingRaw('COUNT(*) >= ?', [$reviewFilter]);
            // })
            // ->select('profiles.*', DB::raw('AVG(ratings.vote) as avg_rating'))
            // ->join('profile_rating', 'profiles.id', '=', 'profile_rating.profile_id')
            // ->join('ratings', 'profile_rating.rating_id', '=', 'ratings.id')
            // ->groupBy('profiles.id')
            // ->havingRaw('AVG(ratings.vote) >= ?', [$ratingFilter])
            ->get();


        return response()->json($profiles);

        //fine della funzione di ricerca filtrata


        // $sponsoredProfiles = Profile::with(['specs', 'user', 'ratings', 'reviews', 'sponsors'])
        //     ->whereHas('specs', function ($query) use ($specId) {
        //         $query->where('specs.id', $specId);
        //     })
        //     ->whereHas('sponsors', function ($query) {
        //         $query->where('expiration_date', '>=', now());
        //     })
        //     ->get();

        // $specs = Spec::all();

        // $data = [
        //     'profiles' => $profiles,
        //     'sponsoredProfiles' => $sponsoredProfiles,
        //     'specs' => $specs,

        // ];

        // // Step 7
        // // A questo punto senza dover fare un'altra chiamata get dal nostro componente vue, approfittiamo della response
        // // della chiamata post per passare il json dei profili che abbiamo cercato con quei vincoli.

        // return response()->json($data);
    }
}
