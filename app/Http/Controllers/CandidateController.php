<?php

namespace App\Http\Controllers;
use App\Candidate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function show(Candidate $candidate)
    {
        return $candidate;
    }

    public function candidatePosition(Request $request)
    {
        $candidate=Candidate::where('position',$request->position)->get();
        return response()->json($candidate);
    }

    public function candidateDetails(Request $request)
    {
        $candidate=Candidate::where('name',$request->name)->get();
        return response()->json($candidate);
    }

    public function store(Request $request)
    {
        $image = $request->image;
        $imageName= $image->getClientOriginalName();
        $imagePath=public_path('uploads');
        $trial = $image->move($imagePath,$imageName);
        if($trial){
        $candidate=Candidate::create(['name' => $request->name,'position' => $request->position,'manifesto' => $request->manifesto,'image' => $imageName]);
        }
        return response()->json($candidate);
    }

    public function update(Request $request, Candidate $candidate)
    {
        $newVote=$request->votes;

        $currentVotes=Candidate::where('name',$request->name)->get(['votes']);
        $currentVote=$currentVotes->pluck('votes');
        $votes=$newVote+$currentVote[0];
/*
        $image = $request->image;
        $imageName= $image->getClientOriginalName();
        $imagePath=public_path('uploads');
        $trial = $image->move($imagePath,$imageName);
        //if($trial){}
            */
            $candidate->update([
                'name' => $request('name'),
                'position' => $request('position'),
                'manifesto' => $request('manifesto'),
                'votes' =>$votes 
                ]);
            
        return $candidate;
    }

    public function delete(Candidate $candidate)
    {
        $candidate->delete();

        return response()->json(null, 204);
    }
}
