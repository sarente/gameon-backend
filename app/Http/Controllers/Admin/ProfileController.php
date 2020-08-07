<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $profiles = Profile::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $profiles = Profile::with('user')->orderBy('id', 'ASC')->paginate($perPage);
        }
        return view('admin.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

        return view('admin.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $profile = new Profile($request->all());
        $profile->user()->associate($user);
        $profile->save();


        return redirect('admin/profiles')->with('flash_message', 'profile added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);

        return view('admin.profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);

        return view('admin.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();

        $profile = Profile::findOrFail($id);
        $profile->update($data);


        return redirect('admin/profiles')->with('flash_message', 'Profile updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Profile::destroy($id);

        return redirect('admin/profiles')->with('flash_message', 'Profile deleted!');
    }
}
