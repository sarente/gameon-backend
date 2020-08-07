<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Rosette;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

class RosetteController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $rosettes = Rosette::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $rosettes = Rosette::orderBy('id', 'ASC')->paginate($perPage);
        }

        return view('admin.rosettes.index', compact('rosettes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

        return view('admin.rosettes.create');
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

        $rosette = new Rosette($request->all());
        $rosette->save();

        if ($request->hasFile('image')) {
            $rosette->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }

        return redirect('admin/rosettes')->with('flash_message', 'Rosette added!');
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
        $rosette = Rosette::findOrFail($id);

        return view('admin.rosettes.show', compact('rosette'));
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
        $rosette = Rosette::findOrFail($id);

        $rosette->name = $rosette->translate('en')->name;
        $rosette->description = $rosette->translate('en')->description;

        return view('admin.rosettes.edit', compact('rosette'));
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

        $rosette = Rosette::findOrFail($id);
        $rosette->update($data);

        if ($request->hasFile('image')) {
            $rosette->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }
        if ($request->input('image_url')) {
            $rosette->image()->save(new Image([
                'image' => ImageManager::make($request->input('image_url')),
            ]));
        }

        return redirect('admin/rosettes')->with('flash_message', 'rosette updated!');
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
        Rosette::destroy($id);

        return redirect('admin/rosettes')->with('flash_message', 'rosette deleted!');
    }
}
