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
                'project' => $project,
                'error' => $error
            ]
        );
    }

    public function edit(Request $request)
    {

        $project = Project::find($request['id']);
        $error = null;
        $architect = Architect::find($request['architect_id']);
        
        if (null != $project) {
            if (isset($request['name']) && '' != $request['name'] && !preg_match('/<script>/', $request['name']) && !preg_match('/onerror/', $request['name']) && 60 > mb_strlen($request['name'])) {
                $project['name'] = $request['name'];
            } else {
                $error['name'] = 'invalid name, name has been refreshed';
            }
    
            if (isset($request['location']) && '' != $request['location'] && !preg_match('/<script>/', $request['location']) && !preg_match('/onerror/', $request['location']) && 60 > mb_strlen($request['location'])) {
                $project['location'] = $request['location'];
            } else {
                $error['location'] = 'invalid location, location has been refreshed';
            }
    
            if (isset($request['about']) && '' != $request['about'] && !preg_match('/<script>/', $request['about']) && !preg_match('/onerror/', $request['about']) && 1000 > mb_strlen($request['about'])) {
                $project['about'] = $request['about'];
            } else {
                $error['about'] = 'invalid about section, about section has been refreshed';
            }
    
            if (null != $architect) {
                $project['architect_id'] = $request['architect_id'];
            } else {
                $error['architect_id'] = 'corrupted architect';
            }

            if(null === $error) {
                $project->save();
                return Response::json(
                    [
                        'success' => $project['name'],
                        'projects' => Project::all()
                    ]
                );
            }
            
            return Response::json(
                [
                    'project' => $project,
                    'error' => $error
                ]
            );

        } else {
            return Response::json(
                [
                    'corruption' => 'corrupted id'
                ]
            );
        }
    
    }

    public function delete(Request $request)
    {
        $project = Project::find($request['id']);

        if (null === $project) {
            return Response::json(
                [
                    'error' => 'corrupted id',
                ]
            );
        } else {
            $project->delete();
            return Response::json(
                [
                    'deletedProject' => $project,
                    'projects' => Project::all()
                ]
            );
        }

    }

}
