<?php

namespace App\Http\Controllers;
use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return Position::all();
    }

    public function store(Request $request)
    {
        $image = $request->image;
        $imageName= $image->getClientOriginalName();
        $imagePath=public_path('uploads');
        $trial = $image->move($imagePath,$imageName);
        if($trial){
        $position=Position::create(['position' => $request->position,'image' => $imageName]);
        }
        return response()->json($position);
    }

    public function update(Request $request, Position $position)
    {
        $image = $request->image;
        $imageName= $image->getClientOriginalName();
        $imagePath=public_path('uploads');
        $trial = $image->move($imagePath,$imageName);
        if($trial){
        $position->update(['position' => $request->position,'image' => $imageName]);
        }
        return response()->json($position);
    }

    public function delete(Position $position)
    {
        $position->delete();

        return response()->json(null, 204);
    }
}
