<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Spec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $specs = Spec::All();
        $userId = Auth::user()->id;

        return view('admin.profile.create', compact('userId', 'specs'));

        // if (!Auth::user()->id) {
        //     return view('Admin.profile.create', compact('specs', 'userId'));
        // } else {
        //     return redirect()->route('admin.home', compact('userId'))->with('alreadyCreated', 'Hai già creato il tuo profilo!');
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                'city' => 'required|max:50',
                'address' => 'required|max:100'
            ]

        );

        $new_profile = new Profile();
        $new_profile->user_id = Auth::user()->id;

        if (array_key_exists('image', $data)) { // qui check se esiste input (che si chiama image)
            $image_url = Storage::put('profile_images', $data['image']); //salvo url in variabile e dichiaro di eseguire put nella cartella che ho scelto in public/storage
            $data['image'] = $image_url; // image è il nome della colonna, gli assegno l'url salvato prima
        }

        // stessa cosa delle image per il resume
        if (array_key_exists('resume', $data)) {
            $resume_url = Storage::put('resumes', $data['resume']);
            $data['resume'] = $resume_url;
        }

        $new_profile->fill($data);

        $new_profile->save();

        if (array_key_exists('specs', $data)) {
            $new_profile->specs()->sync($data['specs']);
        }

        return redirect()->route('admin.profile.show', ['profile' => $new_profile->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);

        return redirect()->route('admin.index', ['profile' => $profile->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $profile_to_edit = Profile::findOrFail($id);
        $user = Auth::user();

        if ($profile_to_edit->user_id !== auth()->user()->id) {
            abort(403, 'Non puoi modificare il profilo altrui.');
        }

        $specs = Spec::All();

        return view('admin.profile.edit', compact('profile_to_edit', 'specs', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {

        $request->validate(
            [
                'city' => 'required|max:50',
                'address' => 'required|max:100',
                'specs' => 'required|min:1',
            ]
        );

        $data = $request->all();

        if (!isset($data['specs'])) {
            $data['specs'] = "Nessuna specializzazione selezionata!";
        }

        if (isset($data['image'])) {
            //condizione per rimuovere l'immagine vecchia se presente
            if ($profile->image) {
                Storage::delete($profile->image);
            }

            $image_url = Storage::put('profile_images', $data['image']);
            $data['image'] = $image_url;

        }

        if (isset($data['resume'])) {
            //condizione per rimuovere l'immagine vecchia se presente
            if ($profile->resume) {
                Storage::delete($profile->resume);
            }

            $resume_url = Storage::put('resumes', $data['resume']);
            $data['resume'] = $resume_url;

        }

        $profile->update($data);
        $profile->save();

        if (isset($data['specs'])) {
            $profile->specs()->sync($data['specs']);
        }


        return redirect()->route('admin.index', ['profile' => $profile->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profiloUtente = Profile::findOrFail($id);
        $profiloUser = Auth::user();
        $profiloUtente->specs()->sync([]);
        $profiloUtente->ratings()->sync([]);
        $profiloUtente->sponsors()->sync([]);
        $profiloUser -> delete();
        $profiloUtente->delete();
        

        return redirect()->route('guest.home');
    }
}
