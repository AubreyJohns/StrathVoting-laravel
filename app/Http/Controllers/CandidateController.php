<?php

namespace App\Http\Controllers;
use App\Candidate;
use Illuminate\Http\Request;

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
        $candidate = Candidate::create(['name' => $request->name,'position' => $request->position,'manifesto' => $request->manifesto]);

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
