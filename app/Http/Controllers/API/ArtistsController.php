<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artists;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index()
    {
        $artists = Artists::all()->toArray();
        return array_reverse($artists);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $imageName = NULL;
        if ($image = $request->file('file')) {
            $destinationPath = 'img/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $imageName;
        }

        Artists::create($input);

        return response()->json(['success'=> 'artist created successfully']);

    }

    public function edit($id)
    {
        $artist = Artists::find($id);
        return response()->json($artist);
    }

    public function update($id, Request $request)
    {
        $artist = Artists::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();
        $imageName = NULL;
        if ($image = $request->file('file')) {
            $destinationPath = 'img/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $imageName;
            unlink('img/'.$artist->image);
        }
        
        $artist->update($input);

        return response()->json(['success'=> 'artist update successfully']);
    }

    public function delete($id)
    {
        $artist = Artists::find($id);
        $artist->delete();
        unlink('img/'.$artist->image);
        return response()->json(['success'=> 'artist deleted successfully']);

    }
}
