<?php

namespace App\Http\Controllers;
use App\Candidate;
use Illuminate\Http\Request;
// include composer autoload
//require 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

class CandidateController extends Controller
{
    public function index()
    {
        return Candidate::all();
    }

    public function candidatesName()
    {
        $candidate=Candidate::select(['name','position'])->get();
        return response()->json($candidate);
    }

    public function show(Candidate $candidate)
    {
        return $candidate;
    }

    public function store(Request $request)
    {
        if($request->hasFile('image')){
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $image = Image::make($avatar)->encode('png');
            $image ->resize(268, 249)->save(  '/uploads/images/candidates_images/' . $filename );
        }
        $candidate = Candidate::create(['name' => $request->name,'position' => $request->position,'manifesto' => $request->manifesto,'image' => $request->image]);

        return response()->json($candidate);
    }

    public function update(Request $request, Candidate $candidate)
    {
        $candidate->update($request->all());

        return response()->json($candidate);
    }

    public function delete(Candidate $candidate)
    {
        $candidate->delete();

        return response()->json(null, 204);
    }
}
