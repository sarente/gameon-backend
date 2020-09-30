<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;
use App\Models\Image;
use Intervention;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewards = Reward::with('image')->get();

		if (!$rewards) {
			return response()->error('error.not-found');
		}
		return response()->success($rewards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$data= $request->json()->all();
        $model = new Reward($data);
        $model->save();

		$input = json_decode($request->getContent());
		if (property_exists($input, "image")) {
			$encodedImage = str_replace(' ','+',$input->image);
			$decodedImage = base64_decode($encodedImage);

			$model->image()->save(new Image([
				'image' => Intervention::make($decodedImage),
			]));
		}


        return response()->success($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reward = Reward::with('image')->find($id);

		if (!$reward) {
			return response()->error('error.not-found');
		}
		return response()->success($reward);
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
		$data= $request->json()->all();
        $model = Reward::find($id);
		if (!$model) {
			return response()->error('error.not-found');
		}
        $model->update($data);

		$input = json_decode($request->getContent());
		if (property_exists($input, "image")) {
			$model->image()->delete();
			$encodedImage = str_replace(' ','+',$input->image);
			$decodedImage = base64_decode($encodedImage);

			$model->image()->save(new Image([
				'image' => Intervention::make($decodedImage),
			]));
		}

        return response()->success($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reward::destroy($id);

		return response()->success('common.success');
    }
}
