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
        $position=Position::create(['position' => $request->position,'image' => $request->image]);
        }
        return response()->json($position);
    }

    public function update(Request $request, Position $positon)
    {
        $image = $request->image;
        $imageName= $image->getClientOriginalName();
        $imagePath=public_path('uploads');
        $trial = $image->move($imagePath,$imageName);
        if($trial){
            $position->update(['position' => $request->position,'image' => $request->image]);
        }
        return response()->json($position);
    }
}
