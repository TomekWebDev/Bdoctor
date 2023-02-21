<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Spec;
use Illuminate\Http\Request;

class ProfileControllerGuest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specs = Spec::all();
        return response()->json($specs);
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

        //Questo codice esegue una query per recuperare tutti i profili che hanno una determinata specializzazione. In particolare, estrae il parametro spec dalla richiesta in ingresso ($request->input('spec')) e quindi utilizza questo parametro per filtrare i profili attraverso il metodo whereHas() di Laravel.

        // Il metodo whereHas() viene utilizzato per aggiungere una clausola "has" alla query, in modo da filtrare i risultati in base all'esistenza di relazioni con altre tabelle. In questo caso, la clausola "has" viene applicata alla relazione specs del modello Profile, e viene usata per cercare tutti i profili che hanno almeno una specializzazione con un ID corrispondente al valore di $specId.

        // Il metodo with() invece viene utilizzato per caricare in anticipo le relazioni specs e user dei profili recuperati, in modo da evitare il problema dell'N+1, dove per ogni profilo recuperato verrebbe eseguita una query separata per recuperare le sue relazioni.

        // In sintesi, questo codice recupera tutti i profili che hanno una determinata specializzazione, e per ciascun profilo recuperato carica in anticipo le sue relazioni specs e user

        $specId = $request->input('spec');

        $profiles = Profile::with('specs', 'user')
            ->whereHas('specs', function ($query) use ($specId) {
                $query->where('specs.id', $specId);
            })
            ->get();

        // $specs = Spec::all();

        $data = [
            'profiles' => $profiles,
            // 'specs' => $specs,

        ];

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
