<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocalResource;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LocalResource::collection(Local::paginate(6));
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
    public function show(Local $local)
    {
        return new LocalResource($local);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        //
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        return Local::where('name', 'like', '%' . $name . '%')->get();
    }
}
