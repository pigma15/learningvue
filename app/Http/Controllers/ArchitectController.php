<?php

namespace App\Http\Controllers;

use App\Models\Architect;
use App\Models\Project;
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

    public function create(Request $request)
    {
        $architect = null;
        $error = null;
        
        if (isset($request['name']) && '' != $request['name'] && !preg_match('/<script>/', $request['name']) && !preg_match('/onerror/', $request['name']) && 30 > mb_strlen($request['name'])) {
            $architect['name'] = $request['name'];
        } else {
            $error['name'] = 'invalid name';
        }

        if (isset($request['surname']) && '' != $request['surname'] && !preg_match('/<script>/', $request['surname']) && !preg_match('/onerror/', $request['surname']) && 30 > mb_strlen($request['surname'])) {
            $architect['surname'] = $request['surname'];
        } else {
            $error['surname'] = 'invalid surname';
        }

        if (isset($request['about']) && '' != $request['about'] && !preg_match('/<script>/', $request['about']) && !preg_match('/onerror/', $request['about']) && 1000 > mb_strlen($request['about'])) {
            $architect['about'] = $request['about'];
        } else {
            $error['about'] = 'invalid about section';
        }

        if(null === $error) {
            Architect::create($architect);
            return Response::json(
                [
                    'success' => ['name' => $architect['name'], 'surname' => $architect['surname']],
                    'architects' => Architect::all()
                ]
            );
        }
        
        return Response::json(
            [
                'architect' => $architect,
                'error' => $error
            ]
        );
    }

    public function edit(Request $request)
    {
        $architect = Architect::find($request['id']);
        $error = null;

        if (null != $architect) {
            if (isset($request['name']) && '' != $request['name'] && !preg_match('/<script>/', $request['name']) && !preg_match('/onerror/', $request['name']) && 30 > mb_strlen($request['name'])) {
                $architect['name'] = $request['name'];
            } else {
                $error['name'] = 'invalid name, name has been refreshed';
            }
    
            if (isset($request['surname']) && '' != $request['surname'] && !preg_match('/<script>/', $request['surname']) && !preg_match('/onerror/', $request['surname']) && 30 > mb_strlen($request['surname'])) {
                $architect['surname'] = $request['surname'];
            } else {
                $error['surname'] = 'invalid surname, surname has been refreshed';
            }
    
            if (isset($request['about']) && '' != $request['about'] && !preg_match('/<script>/', $request['about']) && !preg_match('/onerror/', $request['about']) && 1000 > mb_strlen($request['about'])) {
                $architect['about'] = $request['about'];
            } else {
                $error['about'] = 'invalid about section, surname has been refreshed';
            }
    
            if(null === $error) {
                $architect->save();
                return Response::json(
                    [
                        'success' => ['name' => $architect['name'], 'surname' => $architect['surname']],
                        'architects' => Architect::all()
                    ]
                );
            } else {
                $architect = Architect::find($request['id']);
                return Response::json(
                    [
                        'architect' => $architect,
                        'error' => $error
                    ]
                );

            }
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
        $architect = Architect::find($request['id']);
        $project = null;
        $projects = Project::all();

        foreach($projects as $proj) {
            if ($proj['architect_id'] === $architect['id']) $project = $proj;
        }

        if (null != $project) {
            return Response::json(
                [
                    'error' => 'can not delete architect with existing projects',
                ]
            );
        } else {
            if (null === $architect) {
                return Response::json(
                    [
                        'error' => 'corrupted id',
                    ]
                );
            } else {
                $architect->delete();
                return Response::json(
                    [
                        'deletedArchitect' => $architect,
                        'architects' => Architect::all()
                    ]
                );
            }
        }

    }
    
}
