<?php

namespace App\Http\Controllers\Admin;

use App\Models\Club;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

class ClubController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $clubs = Club::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $clubs = Club::orderBy('id', 'ASC')->paginate($perPage);
        }

        return view('admin.clubs.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

        return view('admin.clubs.create');
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

        $club = new Club($request->all());
        $club->user()->associate($user);
        $club->save();


        return redirect('admin/clubs')->with('flash_message', 'Club added!');
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
        $club = Club::findOrFail($id);

        return view('admin.clubs.show', compact('club'));
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
        $club = Club::findOrFail($id);
        $club->name = $club->translate('en')->name;
        $club->description = $club->translate('en')->description;

        return view('admin.clubs.edit', compact('club'));
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

        $club = Club::findOrFail($id);
        $club->update($request->all());

        if ($request->hasFile('image')) {
            $club->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }
        if ($request->input('image_url')) {
            $club->image()->save(new Image([
                'image' => ImageManager::make($request->input('image_url')),
            ]));
        }

        return redirect('admin/clubs')->with('flash_message', 'Club updated!');
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
        Club::destroy($id);

        return redirect('admin/clubs')->with('flash_message', 'Club deleted!');
    }
}
