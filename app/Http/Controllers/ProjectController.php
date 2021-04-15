<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Architect;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Response;

class ProjectController extends Controller
{

    public function index()
    {
        return Response::json(
            [
                'projects' => ProjectResource::collection(Project::all()),
            ]
        );
    }

    public function create(Request $request)
    {
        $project = null;
        $error = null;
        $architect = Architect::find($request['architect_id']);
        
        if (isset($request['name']) && '' != $request['name'] && !preg_match('/<script>/', $request['name']) && !preg_match('/onerror/', $request['name']) && 60 > mb_strlen($request['name'])) {
            $project['name'] = $request['name'];
        } else {
            $error['name'] = 'invalid name';
        }

        if (isset($request['location']) && '' != $request['location'] && !preg_match('/<script>/', $request['location']) && !preg_match('/onerror/', $request['location']) && 60 > mb_strlen($request['location'])) {
            $project['location'] = $request['location'];
        } else {
            $error['location'] = 'invalid location';
        }

        if (isset($request['about']) && '' != $request['about'] && !preg_match('/<script>/', $request['about']) && !preg_match('/onerror/', $request['about']) && 1000 > mb_strlen($request['about'])) {
            $project['about'] = $request['about'];
        } else {
            $error['about'] = 'invalid about section';
        }

        if (null != $architect) {
            $project['architect_id'] = $request['architect_id'];
        } else {
            $error['architect_id'] = 'invalid architect';
        }


        if(null === $error) {
            Project::create($project);
            return Response::json(
                [
                    'success' => $project['name'],
                    'projects' => Project::all()
                ]
            );
        }
        
        return Response::json(
            [
                'architect' => $project,
                'error' => $error
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
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
