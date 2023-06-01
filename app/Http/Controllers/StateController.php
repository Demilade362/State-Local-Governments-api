<?php

namespace App\Http\Controllers;

use App\Http\Resources\StateResource;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StateResource::collection(State::paginate()->loadCount('local'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        return new StateResource($state->loadCount('local')->loadMorph('local', 'localables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        //
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        return State::where('name', 'like', '%' . $name . '%')->get();
    }
}
