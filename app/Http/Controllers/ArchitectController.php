<?php

namespace App\Http\Controllers;

use App\Models\Architect;
use App\Http\Resources\ArchitectResource;
use Illuminate\Http\Request;
use Response;

class ArchitectController extends Controller
{

    public function index()
    {
        return Response::json(
            [
                'architects' => ArchitectResource::collection(Architect::all()),
            ]
        );
    }

    public function create()
    {
        return Response::json(
            [
                'success' => 'success',
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Architect  $architect
     * @return \Illuminate\Http\Response
     */
    public function show(Architect $architect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Architect  $architect
     * @return \Illuminate\Http\Response
     */
    public function edit(Architect $architect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Architect  $architect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Architect $architect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Architect  $architect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Architect $architect)
    {
        //
    }
}
