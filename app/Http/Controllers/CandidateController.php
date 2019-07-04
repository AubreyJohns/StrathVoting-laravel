<?php

namespace App\Http\Controllers;
use App\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// include composer autoload
//require 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

class CandidateController extends Controller
{
    public function index()
    {
        return Candidate::all();
    }

    public function candidatesImages()
    {
        $candidate=Candidate::select('image')->get();
        return response()->json($candidate);
    }

    public function show(Candidate $candidate)
    {
        return $candidate;
    }

    public function store(Request $request)
    {
        $image = $request->image;
        $imageName= $image->getClientOriginalName();
        $imagePath=public_path('uploads');
        $trial = $image->move($imagePath,$imageName);
        //$image = Image::make($image)->encode('png');
        //Storage::disk('public')->put($imageName, $image);
        //$image ->save( '..'.$imagePath . $imageName );
        if($trial){
        $candidate=Candidate::create(['name' => $request->name,'position' => $request->position,'manifesto' => $request->manifesto,'image' => $imageName]);
        }
        return response()->json($candidate);
    }

    public function update(Request $request, Candidate $candidate)
    {
        $image = $request->image;
        $imageName= $image->getClientOriginalName();
        $imagePath=public_path('uploads');
        $trial = $image->move($imagePath,$imageName);
        //$image = Image::make($image)->encode('png');
        //Storage::disk('public')->put($imageName, $image);
        //$image ->save( '..'.$imagePath . $imageName );
        if($trial){
        $candidate=Candidate::create(['name' => $request->name,'position' => $request->position,'manifesto' => $request->manifesto,'image' => $imageName]);
        }
        $candidate->update(['name' => $request->name,'position' => $request->position,'manifesto' => $request->manifesto,'image' => $imageName]);

        return response()->json($candidate);
    }

    public function delete(Candidate $candidate)
    {
        $candidate->delete();

        return response()->json(null, 204);
    }
}
